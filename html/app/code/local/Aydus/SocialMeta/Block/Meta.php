<?php

/**
 * Add the following attributes to the html tag (in all main template files): itemscope itemtype="http://schema.org/Article"
 */
class Aydus_SocialMeta_Block_Meta extends Mage_Core_Block_Template
{
    protected function _toHtml()
    {
        $_routeName = Mage::app()->getFrontController()->getRequest()->getRouteName();
        $_controllerName = Mage::app()->getFrontController()->getRequest()->getControllerName();
        $_actionName = Mage::app()->getFrontController()->getRequest()->getActionName();
        $_cmsIdentifier = Mage::getSingleton('cms/page')->getIdentifier();

        $facebookAppId = Mage::getStoreConfig('aydus_socialmeta/general/facebook_app_id');
        $twitterSite = Mage::getStoreConfig('aydus_socialmeta/general/twitter_site');

        $html = '';

        // Home page.
        if ($_routeName == 'cms' && $_cmsIdentifier == 'home') {

            $_head = Mage::getBlockSingleton('Page/Html_Head');
            $_header = Mage::getBlockSingleton('Page/Html_Header');

            // Schema.org for Google
            $html .= sprintf("<meta itemprop=\"name\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_head->getTitle()));
            $html .= sprintf("<meta itemprop=\"description\" content=\"%s\"/>\n", htmlspecialchars($_head->getDescription()));
            $html .= sprintf("<meta itemprop=\"image\" content=\"%s\"/>\n", $_header->getLogoSrc());

            // Open Graph.
            $html .= sprintf("<meta property=\"og:type\" content=\"%s\"/>\n", 'website');
            $html .= sprintf("<meta property=\"og:title\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_head->getTitle()));
            $html .= sprintf("<meta property=\"og:image\" content=\"%s\"/>\n", $_header->getLogoSrc());
            $html .= sprintf("<meta property=\"og:url\" content=\"%s\"/>\n", Mage::getBaseUrl());
            $html .= sprintf("<meta property=\"og:site_name\" content=\"%s\"/>\n", htmlspecialchars(Mage::app()->getStore()->getName()));
            $html .= sprintf("<meta property=\"og:description\" content=\"%s\"/>\n", htmlspecialchars($_head->getDescription()));
            $html .= sprintf("<meta property=\"og:app_id\" content=\"%s\"/>\n", $facebookAppId);

            // Twitter Card
            $html .= sprintf("<meta name=\"twitter:card\" content=\"%s\"/>\n", 'summary');
            $html .= sprintf("<meta name=\"twitter:title\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_head->getTitle()));
            $html .= sprintf("<meta name=\"twitter:image\" content=\"%s\"/>\n", $_header->getLogoSrc());
            $html .= sprintf("<meta name=\"twitter:description\" content=\"%s\"/>\n", htmlspecialchars($_head->getDescription()));
            $html .= sprintf("<meta name=\"twitter:site\" content=\"%s\"/>\n", $twitterSite); // e.g. @nytimes @publisher_handle
        }

        // Product page.
        else if ($_routeName == 'catalog' && $_controllerName == 'product' && $_actionName == 'view') {

            $_head = Mage::getBlockSingleton('Page/Html_Head');
            $_product = Mage::registry('current_product');

            // Schema.org for Google
            $html .= sprintf("<meta itemprop=\"name\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_product->getMetaTitle()));
            $html .= sprintf("<meta itemprop=\"description\" content=\"%s\"/>\n", htmlspecialchars($_product->getShortDescription()));
            $html .= sprintf("<meta itemprop=\"image\" content=\"%s\"/>\n", Mage::helper('catalog/image')->init($_product, 'image'));

            // Open Graph.
            $html .= sprintf("<meta property=\"og:type\" content=\"%s\"/>\n", 'product');
            $html .= sprintf("<meta property=\"og:title\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_product->getMetaTitle()));
            $html .= sprintf("<meta property=\"og:image\" content=\"%s\"/>\n", Mage::helper('catalog/image')->init($_product, 'image'));
            $html .= sprintf("<meta property=\"og:url\" content=\"%s\"/>\n", Mage::helper('core/url')->getCurrentUrl());
            $html .= sprintf("<meta property=\"og:site_name\" content=\"%s\"/>\n", htmlspecialchars(Mage::app()->getStore()->getName()));
            $html .= sprintf("<meta property=\"og:description\" content=\"%s\"/>\n", htmlspecialchars($_product->getShortDescription()));
            $html .= sprintf("<meta property=\"og:app_id\" content=\"%s\"/>\n", $facebookAppId);
            $html .= sprintf("<meta property=\"og:price:amount\" content=\"%s\"/>\n", $_product->getFinalPrice());
            $html .= sprintf("<meta property=\"og:price:currency\" content=\"%s\"/>\n", 'USD');

            // Twitter Card
            $html .= sprintf("<meta name=\"twitter:card\" content=\"%s\"/>\n", 'product');
            $html .= sprintf("<meta name=\"twitter:title\" content=\"%s%s\"/>\n", htmlspecialchars($_head->getDefaultTitle()), htmlspecialchars($_product->getMetaTitle()));
            $html .= sprintf("<meta name=\"twitter:image\" content=\"%s\"/>\n", Mage::helper('catalog/image')->init($_product, 'image'));
            $html .= sprintf("<meta name=\"twitter:description\" content=\"%s\"/>\n", htmlspecialchars($_product->getShortDescription()));
            $html .= sprintf("<meta name=\"twitter:site\" content=\"%s\"/>\n", $twitterSite);
            $html .= sprintf("<meta name=\"twitter:data1\" content=\"%s\"/>\n", $_product->getFinalPrice());
            $html .= sprintf("<meta name=\"twitter:label1\" content=\"%s\"/>\n", 'Price');
        }

        return $html;
    }
}