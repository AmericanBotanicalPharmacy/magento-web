<?php
/**
 * Core code for getting the featured product collection and exposing methods used by standard Magento category layout files.
 * Rendering a product to look the same as a category page product requires many properties/methods and an underlying product
 * collection with complete data/attributes.  Therefore, this block inherits from a core category class and implements core category code.
 * Mage_Catalog_Block_Product_List (the standard Magento category class) extends from Mage_Catalog_Block_Product_Abstract.  Refer
 * to this class as needed to implement the product collection.  Note that this widget class also extends Mage_Catalog_Block_Product_Abstract
 * (and not the standard Mage_Core_Block_Template).
 */
class Aydus_FeaturedProducts_Block_Featured extends Mage_Catalog_Block_Product_Abstract implements Mage_Widget_Block_Interface
{
    protected $_productCollection;

    protected function _beforeToHtml()
    {
        // Set template is required to display block from cms page design tab or local.xml.
        $this->setTemplate($this->getData('template'));

        // Dispatch event required to populate collection with rating data.
        Mage::dispatchEvent('catalog_block_product_list_collection', array(
            'collection' => $this->_getFeaturedProductCollection()
        ));

        // Explicitly load collection. However, parent _beforeToHtml will also load data if this line of code is removed.
        $this->_getFeaturedProductCollection()->load();

        parent::_beforeToHtml();
    }

    /**
     * Called by the template to get the product collection.
     */
    public function getLoadedProductCollection()
    {
        return $this->_getFeaturedProductCollection();
    }

    /**
     * Based on Mage_Catalog_Block_Product_List._getProductCollection. The category page uses this type of logic to build a product collection
     * with appropriate data to render.
     */
    protected function _getFeaturedProductCollection()
    {
        $categoryId = $this->getData('category_id');
        $categoryName = $this->getData('category_name');

        // Get category collection by name or id.
        if ($categoryId !== null || $categoryName !== null)
        {
            if (is_null($this->_productCollection)) {

                if ($categoryId !== null) {
                    $category = Mage::getModel('catalog/category')->load($categoryId);
                }
                else {
                    $category = Mage::getModel('catalog/category')->loadByAttribute('name', $categoryName);
                }

                if ($category->hasData())
                {
                    $layer = $this->getLayer();
                    $layer->setCurrentCategory($category);
                    $this->_productCollection = $layer->getProductCollection();
                    $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());
                    // Sort the product collection according to category sort by settings.
                    $this->_productCollection->setOrder($this->getSortBy(), 'ASC');
                }
            }
        }
        return $this->_productCollection;
    }

    /**
     * Copied from Mage_Catalog_Block_Product_List.
     */
    public function getLayer()
    {
        $layer = Mage::registry('current_layer');
        if ($layer) {
            return $layer;
        }
        return Mage::getSingleton('catalog/layer');
    }

    /**
     * Copied from Mage_Catalog_Block_Product_List. Returns the default category sort by e.g. position, price, etc.
     */
    public function prepareSortableFieldsByCategory($category) {
        if (!$this->getAvailableOrders()) {
            $this->setAvailableOrders($category->getAvailableSortByOptions());
        }
        $availableOrders = $this->getAvailableOrders();
        if (!$this->getSortBy()) {
            if ($categorySortBy = $category->getDefaultSortBy()) {
                if (!$availableOrders) {
                    $availableOrders = $this->_getConfig()->getAttributeUsedForSortByArray();
                }
                if (isset($availableOrders[$categorySortBy])) {
                    $this->setSortBy($categorySortBy);
                }
            }
        }

        return $this;
    }

    /**
     * Override to return widget parameter mode.
     */
    public function getMode()
    {
        return $this->getData('mode');
    }

    /**
     * Override to return widget parameter column count.
     */
    public function getColumnCount()
    {
        return $this->getData('column_count');
    }
}