<?php

/**
 * Order resource model
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Resource_Order extends Mage_Core_Model_Resource_Db_Abstract
{
	
	protected function _construct()
	{
		$this->_init('abp_cwserenade/order', 'increment_id');
		$this->_isPkAutoIncrement = false;
	}
	
}

