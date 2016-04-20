<?php

/**
 * Chase Paymentech method
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Payment_Ccsave extends Abp_Cwserenade_Model_Order_Payment
{
	/**
	 * Get payment str for CW
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return string
	 */
	public function getPaymentsString($order)
	{
		$paymentsStr = '';
		$incrementId = $order->getIncrementId();
		$pendingOrder = Mage::getModel('abp_cwserenade/order')->load($incrementId);
		$payment = $order->getPayment();
		//a lot of the data in this array is in the $pendingOrder
		
		$paymentSequenceNumber = 1;
		    	
        //the first digit is the type
        switch ($payment->getCcType()){

            case 'AE' :
                $paymentType = 3;
                break;
            case 'VI' :
                $paymentType = 4;
                break;
            case 'MC' :
                $paymentType = 5;
                break;
            case 'DI' :
                $paymentType = 6;
                break;
        }
        	
        $ccNumberEnc = $pendingOrder->getCcNumberEnc();
        $ccNumber = Mage::helper('core')->decrypt($ccNumberEnc);
        $ccExpMonth = $payment->getCcExpMonth();
        $ccExpYear = substr($payment->getCcExpYear(),-2);;
        	
        $authNumber = $payment->getCcTransId();
        $authdate = $pendingOrder->getCreatedAt();
        $authdate = date('mdY',strtotime($authdate));
        $ordAuthString = 'auth_number="' . $authNumber . '" ' . 'auth_date="'   . $authdate . '" ';
        	
        $paymentsStr .= '<Payment payment_seq_number="'.$paymentSequenceNumber.'" payment_type="'.$paymentType.'" cc_number="'.$ccNumber.'" cc_exp_month="'.$ccExpMonth.'" cc_exp_year="'.$ccExpYear.'" '.$ordAuthString.' />';

		return $paymentsStr;
	}
	
	/**
	 * Get credit card data for staging
	 * 
	 * @return array
	 */
	public function getStageData($order)
	{
		$incrementId = $order->getIncrementId();
		$state = Abp_Cwserenade_Model_Order_State::PENDING;
		$postedPayment = Mage::app()->getRequest()->getParam('payment');
		
		$payment = new Varien_Object();
		$payment->setData($postedPayment);
		
		$paymentMethod = $payment->getMethod();
		$ccType = $payment->getCcType();
		$ccNumber = $payment->getCcNumber();
		$ccNumberEnc = Mage::helper('core')->encrypt($ccNumber);
		$ccCid = $payment->getCcCid();
		$ccCidEnc = Mage::helper('core')->encrypt($ccCid);
		$ccExpMonth = $payment->getCcExpMonth();
		$ccExpYear = $payment->getCcExpYear();
		
		$createdAt = date('Y-m-d H:i:s');
		$updatedAt = date('Y-m-d H:i:s');
		
		$stageData = array(
			'increment_id' => $incrementId,
			'state' => $state,
			'payment_method' => $paymentMethod,
			'cc_type' => $ccType,
			'cc_number_enc' => $ccNumberEnc,
			'cc_cid_enc' => $ccCidEnc,
			'cc_exp_month' => $ccExpMonth,
			'cc_exp_year' => $ccExpYear,
			'created_at' => $createdAt,
			'updated_at' => $updatedAt,
		);	

		return $stageData;
	}
	
}
