<?php

/**
 * Capture payment details and stage for push to CW
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Observer 
{
    /**
     * Stage order
     * 
     * @param Varien_Event_Observer $observer
     * 
     * @return Abp_Cwserenade_Model_Observer
     */
    public function stageOrderForPush(Varien_Event_Observer $observer)
    {
    	$order = $observer->getOrder();
    	
    	try {
    		
			$incrementId = $order->getIncrementId();
    		$payment = $order->getPayment();
    		
    		if (!$payment->getId()){
    			
    			Mage::log("No payment on order no. $incrementId", null, 'abp_cwserenade.log');
    			 
    			return $this;
    		}
    		
    		$paymentMethod = strtolower($payment->getMethod());
    		$method = Mage::getModel('abp_cwserenade/order_payment_'.$paymentMethod);
			$data = $method->getStageData($order);
    		
			$stageOrder = Mage::getModel('abp_cwserenade/order');
			$stageOrder->setData($data);
    		$stageOrder->save();
    		
    	} catch(Exception $e){
    		Mage::log($e->getMessage(), null, 'abp_cwserenade.log');
    	}
    	
        return $this;
    }
}