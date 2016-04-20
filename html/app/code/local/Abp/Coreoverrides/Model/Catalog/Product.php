<?php

/**
 * Catalog product model
 *
 * @category    Abp
 * @package     Abp_Coreoverrides
 * @author		Aydus <davidt@aydus.com>
 */
class Abp_Coreoverrides_Model_Catalog_Product extends Mage_Catalog_Model_Product
{
    /**
     * Get product name
     *
     * @param bool $append Append the type
     * @param bool $span Add span around the type
     * @return string
     */
    public function getName($append = true, $span = false)
    {
    	$name = $this->_getData('name');
    	
    	$id = $this->getId();
    	$storeId = Mage::app()->getStore()->getId();
    	/*
$optionId = Mage::getResourceModel('catalog/product')->getAttributeRawValue($this->getId(), 'type', $storeId);
    	
    	if ($optionId && $append){
    		
    		$typeAttr = $this->getResource()->getAttribute("type");
    		$type = $typeAttr->getSource()->getOptionText($optionId);
    		
    		$helper = Mage::helper('catalog/output');
   			$name = ($span) ? $helper->productAttribute($this, $name, 'name') : $name;
    		$type = ($span) ? '<span>'.$type.'</span>' : '('.$type.')';

    		return $name.' '.$type;
    	}
*/
    	
        return $name;
    }
	
}




