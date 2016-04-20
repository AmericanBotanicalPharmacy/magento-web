<?php

/**
 * Abp payment Paypal Express
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Payment_Paypalexpress extends Abp_Cwserenade_Model_Order_Payment
{
	/**
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return string
	 */
	public function getPaymentsString($order)
	{
		$paymentsStr = '';
		$payment = $order->getPayment();
		$authNumber = $payment->getLastTransId();
		$paymentType = '0';
			
		$authdate = $order->getUpdatedAt();
		$ordAuthString = 'auth_number="' . $authNumber . '" ' . 'auth_date="'   . $authdate . '" ';
		
		$paymentsStr = '<Payment payment_seq_number="1" payment_type="'.$paymentType.'" '.$ordAuthString.' />';

		return $paymentsStr;
	}
	
	/**
	 * Get Paypal data for staging
	 *
	 * @return array
	 */
	public function getStageData($order)
	{
		
	}	
	
}