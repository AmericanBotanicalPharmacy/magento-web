<?php

class Aydus_JData_Block_Main
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected $_serializer = null;
    
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }

    /**
     * Create jdata html element and data attributes.
     * jQuery usage: window.aydus.jdata.storeUrl;
     */
    protected function _toHtml()
    {
        $url = parse_url(Mage::getBaseUrl());
        $html = '<script type="text/javascript">';
        $html .= sprintf('window.aydus = window.aydus || {};');
        $html .= sprintf('aydus.jdata = aydus.jdata || {};');

        $html .= sprintf('aydus.jdata.shortUrl = "%s";', $url["host"]);
        $html .= sprintf('aydus.jdata.storeUrl = "%s";', Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB));
        $html .= sprintf('aydus.jdata.mediaUrl = "%s";', Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA));
        $html .= sprintf('aydus.jdata.skinUrl = "%s";', $this->getSkinUrl());
        $html .= sprintf('aydus.jdata.currentCategoryId = "%s";', $this->getCurrentCategoryId());
        $html .= sprintf('aydus.jdata.isDeveloperMode = %s;', (Mage::getIsDeveloperMode() ? 'true' : 'false'));
        $html .= sprintf('aydus.jdata.isLoggedIn = %s;', (Mage::helper('customer')->isLoggedIn() ? 'true' : 'false'));
        $html .= '</script>';
        
        return $html;
    }

    protected function getCurrentCategoryId() {
        $currentCategoryId = 0;
        if (Mage::registry('current_category'))
        {
            $currentCategoryId = Mage::registry('current_category')->getId();
        }
        return $currentCategoryId;
    }
}