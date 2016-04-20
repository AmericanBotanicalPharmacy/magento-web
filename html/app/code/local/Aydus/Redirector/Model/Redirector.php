<?php

/**
 * Aydus_Redirector
 * Author: Jared Blalock (jared@aydus.com)
 * Date: 4/3/2013
 *
 * Observe noRoute action name from dispatch controller
 * parse CSV for potential redirects, if found 301 redirect
 *
 */
class Aydus_Redirector_Model_Redirector {

    /**
     * Observer for noRoute to check CSV file for mappings
     * @param type $observer
     */
    public function observe($observer) {
        $request = $observer['controller_action']->getRequest();
        $actionName = $request->getActionName();
        $requestUrl = $request->getHttpHost() . $request->getRequestUri();

        if ($actionName == 'noRoute' || $actionName == 'index') {
        	
        	$mappingsPath = Mage::getModuleDir('etc', 'Aydus_Redirector') . '/redirects-' . $_SERVER['HTTP_HOST'] . '.csv';
            if (!file_exists($mappingsPath)) {
                $mappingsPath = Mage::getModuleDir('etc', 'Aydus_Redirector') . '/redirects.csv';
            }
            $mappings = file($mappingsPath);

            foreach ($mappings AS $mapping) {

                // Possibly use preg_split to do escaping for any URLs with
                // delimiter being used of ,
                //$pieces = preg_split('/[\,]+/i', $mapping);
                $pieces = explode(',', $mapping);

                $sourceUrl = trim($pieces[0]);

                // Defaults
                $websiteId = 1;
                $storeId = 1;
                unset($matches);
                unset($destinationUrl);

                // one to one redirect (specific URL)
                if (count($pieces) == 2) {
                    $destinationUrl = (strpos($pieces[1],'http') == 0) ? trim($pieces[1]) : Mage::getBaseUrl() . trim($pieces[1]);
                    if (strcasecmp($sourceUrl, $requestUrl) == 0) {
                        $this->performRedirect($destinationUrl);
                    }
                    continue;
                }

                // Regular expression with product attribute look up
                if (count($pieces) == 4 && $pieces[0] == "regex") {
                    preg_match($pieces[1], $requestUrl, $matches);
                    if (@$matches[1]) {

                        $attribute_name = trim($pieces[3]);

                        // Look for legacy Product ID value in attribute
                        if ($pieces[2] == "product") {
                            $product = Mage::getModel('catalog/product')->loadByAttribute($attribute_name, $matches[1]);
                            if (is_object($product)) {
                                if ($product->getEntityId()) {
                                    $destinationUrl = $this->getProductUrl($product->getEntityId(), $websiteId, $storeId);
                                }
                            } else {
                                // no attribute object located 
                                continue;
                            }
                        }

                        // Look for legacy Category ID value in attribute
                        if ($pieces[2] == "category") {
                            $category = Mage::getModel('catalog/category')->loadByAttribute($attribute_name, $matches[1]);
                            if (is_object($category)) {
                                if ($category->getEntityId()) {
                                    $destinationUrl = $this->getCategoryUrl($category->getEntityId(), $websiteId, $storeId);
                                }
                            } else {
                                // no attribute object located 
                                continue;
                            }
                        }

                        // If new location found perform the redirect
                        if ($destinationUrl) {
                            $this->performRedirect($destinationUrl);
                        }
                    }
                    continue;
                }

                // regex catch for search queries
                if (trim($pieces[2]) == "search" && $pieces[0] == "regex") {
                    preg_match($pieces[1], $requestUrl, $matches);
                    if (@$matches[1]) {
                        $destinationUrl = Mage::getBaseUrl() . "catalogsearch/result/?q=" . $matches[1];
                        $this->performRedirect($destinationUrl);
                    }
                }

                // Product and Category matching
                $type = trim(@$pieces[1]);
                $entityId = trim(@$pieces[2]);

                if (@$pieces[3])
                    $websiteId = trim($pieces[3]);
                if (@$pieces[4])
                    $storeId = trim($pieces[4]);

                if ($sourceUrl == $requestUrl) {
                    if ($type == 'product') {
                        $destinationUrl = $this->getProductUrl($entityId, $websiteId, $storeId);
                    } elseif ($type == 'category') {
                        $destinationUrl = $this->getCategoryUrl($entityId, $websiteId, $storeId);
                    }
                    $this->performRedirect($destinationUrl);
                }
            }
            Mage::log($requestUrl, null, 'redirector404s.txt');
        }
    }

    /**
     * Get Product URL from Entity ID
     * @param type $entityId
     * @param type $websiteId
     * @param type $storeId
     * @return type
     */
    public function getProductUrl($entityId, $websiteId, $storeId) {
        Mage::app()->getWebsite()->setId($websiteId);
        Mage::app()->getStore()->setId($storeId);
        $product = new Mage_Catalog_Model_Product();
        $product->load($entityId);
        return $product->getUrlPath();
    }

    /**
     * Get Category URL from Entity ID
     * @param type $entityId
     * @param type $websiteId
     * @param type $storeId
     * @return type
     */
    public function getCategoryUrl($entityId, $websiteId, $storeId) {
        Mage::app()->getWebsite()->setId($websiteId);
        Mage::app()->getStore()->setId($storeId);
        $category = new Mage_Catalog_Model_Category();
        $category->load($entityId);
        return $category->getUrlPath();
    }

    /**
     * 301 Redirect to $destination URL
     * @param type $destinationUrl
     */
    public function performRedirect($destinationUrl) {
        if ($destinationUrl) {
            $response = Mage::app()->getResponse();
            $response->setRedirect($destinationUrl, 301);
            $response->sendResponse();
            exit;
        }
    }

}