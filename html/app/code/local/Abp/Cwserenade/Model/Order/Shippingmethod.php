<?php

/**
 * Abp/CW shipping method
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Shippingmethod
{

	/**
	 * Get shipping address data for CW message
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return array
	 */
	public function getMessageData($order)
	{
		$data = array();
		
	    $freight = $order->getBaseShippingAmount();
	    $data['freight'] = $freight;
	    
    	$shippingDescription = $order->getShippingDescription();
	    $data['shippingMethod'] = '';
	     
    	if (is_numeric(strpos($shippingDescription,'USPS'))){
    		$data['shippingMethod'] = 1;
    	
    	}else if (is_numeric(strpos($shippingDescription,'Ground'))) {
    		$data['shippingMethod'] = 2;
    		 
    	}else if(is_numeric(strpos($shippingDescription,'Overnight'))){
    		$data['shippingMethod'] = 5;
    		 
    	}else if(is_numeric(strpos($shippingDescription,'Express'))){
    		$data['shippingMethod'] = 7;
    		
    	}else if (is_numeric(strpos($shippingDescription,'Pickup'))){
    		
    		$data['shippingMethod'] = 35;
    	}
    	
		return $data;
	}

}