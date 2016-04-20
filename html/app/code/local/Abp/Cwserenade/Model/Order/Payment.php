<?php

/**
 * Abp/CW payment
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Payment extends Mage_Core_Model_Abstract
{
	/**
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return array
	 */
	public function getMessageData($order)
	{
		$data = array();
		$data['paymentsStr'] = '';

		$payment = $order->getPayment();
		$method = strtolower($payment->getMethod());
		$paymentsStr = Mage::getModel('abp_cwserenade/order_payment_'.$method)->getPaymentsString($order);
				
		$data['paymentsStr'] = $paymentsStr;
		
		return $data;
		
	}

}