<?php

class Aydus_BannerEnhanced_Block_Main
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    protected $_serializer = null;
    
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }

    protected function _toHtml()
    {
        $html = '<ul class="banners">';
        
        $bannerResource = Mage::getModel('enterprise_banner/banner')->getResource();
        
        $adapter = Mage::getSingleton('core/resource')->getConnection('core_read');
        $select = $adapter->select()
            ->from(array('b'=>$bannerResource->getMainTable()), array('banner_id'))
            ->where('is_enabled = ?', 1)
            ->where('types like ?', '%enhanced%');
        
        $select->joinLeft(array("p" => Mage::getSingleton('core/resource')->getTableName('aydus_bannerenhanced_position')), "b.banner_id = p.banner_id", array("position"));
        $select->order('position');
                
        $banners = $adapter->fetchCol($select);
        
        $helper = Mage::helper('cms');
        $processor = $helper->getPageTemplateProcessor();
        
        foreach ($banners as $banner) {
            $contents = $bannerResource->getStoreContents($banner);
            foreach ($contents as $content) {
                $html .= $processor->filter($content);
            }
        }
        
        $html .= '</ul>';
        
        return $html;
    }
}
