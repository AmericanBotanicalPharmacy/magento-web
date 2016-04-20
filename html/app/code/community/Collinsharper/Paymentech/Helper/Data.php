<?php

/**
 *  data helper
 */
class Collinsharper_Paymentech_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getFieldValidation($payment) {

        $order = $payment->getOrder();
        $billing = $order->getBillingAddress();

        return
            $fields = array(

                //TODO: add in a madatory field indicator.
                // Change regex regexp_eclude to be single regex.
                // Requires 1 number in the value
                'orbitalConnectionUsername' => array (
                    'data' => Mage::getStoreConfig('payment/chpaymentech/login'),
                    'field' => 'Merchant Username',
                    'min' => 8,
                    'max' => 32,
                    'type' => 'A',
                    'regex_messge' => 'Only A-z 0-9 Characters',
                    'regex' => '/[a-z0-9]+/i',
                ),

                // Requires 1 number in the value
                'orbitalConnectionPassword' => array (
                    'data' => Mage::getStoreConfig('payment/chpaymentech/password'),
                    'field' => 'Merchant Password',
                    'min' => 8,
                    'max' => 32,
                    'type' => 'A',
                    'regex_messge' => 'Only A-z 0-9 Characters',
                    'regex' => '/[a-z0-9]+/i',
                ),

                'bin' => array (
                    'data' => Mage::getStoreConfig('payment/chpaymentech/bin'),
                    'field' => 'Merchant Bin',
                    'min' => 5,
                    'max' => 6,
                    'type' => 'N',
                    'regex_messge' => 'Only 0-9 Characters',
                    'regex' => '/[\d]+/i',
                ),

                'merchantID' => array (
                    'data' => Mage::getStoreConfig('payment/chpaymentech/merchant_id'),
                    'field' => 'Merchant ID',
                    'min' => 6,
                    'max' => 15,
                    'type' => 'N',
                    'regex_messge' => 'Only 0-9 Characters',
                    'regex' => '/[\d]+/i',
                ),

                'terminalID' => array (
                    'data' => Mage::getStoreConfig('payment/chpaymentech/terminal_id'),
                    'field' => 'Merchant Terminal ID',
                    'min' => 1,
                    'max' => 3,
                    'type' => 'N',
                    'regex_messge' => 'Only 0-9 Characters',
                    'regex' => '/[\d]+/i',
                ),


                'ccAccountNum' => array (
                    'data' => $payment->getCcNumber() ,
                    'field' => 'Credit Card Number',
                    'min' => 1,
                    'max' => 19,
                    'type' => 'N',
                    'regex_messge' => 'Only 0-9 Characters',
                    'regex' => '/[\d]+/i',
                ),

                // Format = YYYYMM
                'ccExp' => array (
                    'data' =>  $payment->getCcExpYear() . sprintf('%02d',  $payment->getCcExpMonth())  ,
                    'field' => 'Credit Card Expiration',
                    'min' => 6,
                    'max' => 6,
                    'type' => 'N',
                    'regex_messge' => 'Only 0-9 Characters',
                    'regex' => '/[\d]+/i',
                ),

                //TODO: this needs a stronger regex. dash should only be allwed when ddddd-dddd
                //TODO: Canadian postal codes should always be ADADAD no space or hyphen
                'avsZip' => array (
                    'data' =>  preg_replace('/[^a-z0-9\-]+/i', '', $billing->getPostcode()) ,
                    'field' => 'Billing Postal code',
                    'min' => 5,
                    'max' => 10,
                    'type' => 'A'
                ),

                // Should not include : % | ^ \ /
                'avsAddress1' => array (
                    'data' =>   $billing->getStreet(1) ,
                    'field' => 'Billing Address Line 1',
                    'min' => 1,
                    'max' => 30,
                    'type' => 'A',
                    'regex_messge' => 'Only a-z 0-9 Characters and not including any of  % | ^ \ / ',
                    'regex_exclude' => ';[^:|\^\\/]+;i',
                    'regex' => '/[\w\d\s]+/i',
                ),

                // Should not include : % | ^ \ /
                'avsAddress2' => array (
                    'data' =>    $billing->getStreet(2) ,
                    'field' => 'Billing Address Line 2',
                    'min' => 1,
                    'max' => 30,
                    'type' => 'A',
                    'regex_messge' => 'Only a-z 0-9 Characters and not including any of  % | ^ \ / ',
                    'regex_exclude' => ';[^:|\^\\/]+;i',
                    'regex' => '/[\w\d\s]+/i',
                ),

                // Should not include : % | ^ \ /
                'avsCity' => array (
                    'data' =>    $billing->getCity() ,
                    'field' => 'Billing City',
                    'min' => 1,
                    'max' => 20,
                    'type' => 'A',
                    'regex_messge' => 'Only a-z 0-9 Characters and not including any of  % | ^ \ / ',
                    'regex_exclude' => ';[^:|\^\\/]+;i',
                    'regex' => '/[\w\d\s]+/i',

                ),

                // Should not include : % | ^ \ /
                'avsState' => array (
                    'data' =>     $billing->getRegionCode() ,
                    'field' => 'Billing State',
                    'min' => 1,
                    'max' => 2,
                    'regex_messge' => 'Only a-z 0-9 Characters and not including any of  % | ^ \ / ',
                    'regex_exclude' => ';[^:|\^\\/]+;i',
                    'regex' => '/[\w\d\s]+/i',
                ),

                'avsName' => array (
                    'data' =>    $billing->getFirstname() . " " .$billing->getLastname() ,
                    'field' => 'Billing Firstname and Billing Lastname',
                    'min' => 1,
                    'max' => 30,
                    'type' => 'A',
                    'regex_messge' => 'Only a-z 0-9 Characters   ',
                    'regex' => '/[\w\d\s]+/i',
                ),

                // Only accepted values == US, CA, GB, UK == usa, canada, great brit, UK
                // Other countries should be left blank
                'avsCountryCode' => array (
                    'data' =>    $billing->getCountry() ,
                    'field' => 'Billing Country',
                    'min' => 2,
                    'max' => 2,
                    'type' => 'A',
                    'regex_messge' => 'Only a-z Characters',
                    'regex' => '/[a-z]+/i',
                ),


//
//                'comments' => array (
//                    'data' =>    $billing->getStreet(2) ,
//                    'field' => 'Billing Address Line 1',
//                    'min' => 1,
//                    'max' => 64,
//                    'type' => 'A'
//                ),



            );

    }

    public function validateFields($payment) {
        $fields = $this->getFieldValidation($payment);

        /*
         *                    'avsCity' => array (
                    'data' =>    $billing->getCity() ,
                    'field' => 'Billing City',
                    'min' => 1,
                    'max' => 20,
                    'type' => 'A',
                    'regex_exclude' => '/[^:|^\\\/]+/i',
                    'regex' => '/[\w\d\s]+/i',

                ),
                ),
         */
        $errors = array();
           foreach($fields as $f => $vdata) {
               if($vdata['data']) {

                   if(isset($vdata['max']) && strlen($vdata['data']) > $vdata['max']) {
                       $errors[] = $this->__('%s Exceeds max length of %s', $vdata['field'] ,  $vdata['max']);
                   }

                   if(isset($vdata['min']) && strlen($vdata['data']) < $vdata['min']) {
                       $errors[] = $this->__('%s Must meet minimum character requirements of %s' , $vdata['field'] , $vdata['min']);
                   }

                   if((isset($vdata['regex']) &&
                       preg_match($vdata['regex'], $vdata['data']) === false) || (
                       isset($vdata['regex_exclude']) &&
                       (preg_match($vdata['regex_exclude'], $vdata['data']) === false))) {
                       $errors[] = $this->__('%s Must meet input requirements of %s' , $vdata['field'] , $vdata['regex_messge']);
                   }

               }
           }
        if(!count($errors)){
            return false;
        }
        return implode("\n",$errors);
    }


	public function getSession() {
		return Mage::getSingleton('customer/session');
	}

	public function getReciept() {
        $session = $this->getSession();
        $order = Mage::getModel('sales/order');
        $order->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        if('paymentech' != (string)$order->getPayment()->getMethod()) {
            return false;
        }

        if(Mage::getSingleton('customer/session')->getPaymentechData()) {
            $bits = Mage::getSingleton('customer/session')->getPaymentechData(true);
            $this->saveReceipt($bits);
            return $bits;
        }
    }
	
		public function saveReceipt($_d) {
	
			$session = $this->getSession();
		$order = Mage::getModel('sales/order');
        $order->load(Mage::getSingleton('checkout/session')->getLastOrderId());

		
		 $order->addStatusToHistory(
                    $order->getStatus(),//continue setting current order status
                    Mage::helper('chpaymentech')->__('Paymentech Payment results, '.$_d)
                );
                $order->save();
	
	}
	
}