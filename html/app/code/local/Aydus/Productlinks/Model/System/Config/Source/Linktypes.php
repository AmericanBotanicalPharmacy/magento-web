<?php

/**
 * Link types for system config (upsell, related, cross-sell)
 *
 * @category    Aydus
 * @package     Aydus_Productlinks
 * @author		Aydus <davidt@aydus.com>
 */

class Aydus_Productlinks_Model_System_Config_Source_Linktypes  
{
	protected $_options;
	
	public function toOptionArray($isMultiselect=false)
	{
		if (!$this->_options) {
			$this->_options = array(
				array('value' => 'r', 'label'=>Mage::helper('aydus_productlinks')->__('Related Products')),
				array('value' => 'u', 'label'=>Mage::helper('aydus_productlinks')->__('Upsell Products')),
				array('value' => 'c', 'label'=>Mage::helper('aydus_productlinks')->__('CrossSell Products')),
			);
		}
	
		$options = $this->_options;
		if(!$isMultiselect){
			array_unshift($options, array('value'=>'', 'label'=> Mage::helper('adminhtml')->__('--Please Select--')));
		}
	
		return $options;
	}

}