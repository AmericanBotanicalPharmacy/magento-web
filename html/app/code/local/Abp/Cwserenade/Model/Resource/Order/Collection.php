<?php

/**
 * Order resource collection 
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */
	
class Abp_Cwserenade_Model_Resource_Order_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract 
{

	protected function _construct()
	{
        parent::_construct();
		$this->_init('abp_cwserenade/order');
	}
	
}