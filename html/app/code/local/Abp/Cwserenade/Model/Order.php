<?php

/**
 * Order model
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order extends Mage_Core_Model_Abstract
{

	/**
	 * Init resource
	 */
	protected function _construct()
	{
		parent::_construct();
		
		$this->_init('abp_cwserenade/order');
	}
	
	/**
	 * 
	 * @param int $state
	 * @see Abp_Cwserenade_Model_Order_State
	 * @return Abp_Cwserenade_Model_Order
	 */
	public function setState($state)
	{
		$updatedAt = date('Y-m-d H:i:s');
		
		$this->setData('updated_at', $updatedAt);
		$this->setData('state', $state);
		
		return $this;
	}
		

    
}