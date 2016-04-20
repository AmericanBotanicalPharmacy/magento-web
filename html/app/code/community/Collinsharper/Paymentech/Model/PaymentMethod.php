<?php
//require_once "lib/Zend/Log.php";
/**
* Our test CC module adapter
*/
class Collinsharper_Paymentech_Model_PaymentMethod extends Mage_Payment_Model_Method_Cc
{
    /**
    * unique internal payment method identifier
    *
    * @var string [a-z0-9_]
    */
    protected $_code = 'chpaymentech';
    protected $_isGateway               = true;
    protected $_canAuthorize            = true;
    protected $_canCapture              = true;
    protected $_canCapturePartial       = true;
    protected $_canRefund               = true;
	protected $_canRefundInvoicePartial = true;
    protected $_canVoid                 = true;
    protected $_canUseInternal          = true;
    protected $_canUseCheckout          = true;
    protected $_canUseForMultishipping  = true;
    protected $_canSaveCc 				= false;

    protected $_infoBlockType           = 'chpaymentech/info_paymentech';
    protected $_formBlockType           = 'chpaymentech/form_paymentech';

	protected $_payment;
	protected $_amount;
    public $_soapResponse;
	
	public function canRefund()
    {
        return $this->_canRefund;  
    }
   
    public function canVoid(Varien_Object $payment)
    {
        return $this->_canVoid;
    }
  
    public function canCapturePartial()
    {
        return $this->_canCapturePartial;
    }

	public function canAuthorize()
    {
        return $this->_canAuthorize;
    }

    public function canCapture()
    {
        return $this->_canCapture;
    }   
    
	private function getAccount()
	{
		return Mage::getStoreConfig('payment/chpaymentech/merchant_id');
	}
	
	private function getTest()
	{
		return Mage::getStoreConfig('payment/chpaymentech/test');
	}
	
	private function getpaymentAction()
	{
		return Mage::getStoreConfig('payment/chpaymentech/payment_action');
	}

    protected function getAddressMismatchDisable()
    {
        return Mage::getStoreConfig('payment/chpaymentech/address_mismatch_disable');
    }

    protected function getAddressCheckFields()
    {
        return Mage::getStoreConfig('payment/chpaymentech/address_check_fields');
    }

    public function log($x, $force = false)
    {
        if($force || Mage::getStoreConfig('payment/chpaymentech/test') || Mage::getStoreConfig('payment/chpaymentech/debug')) {
            mage::log($x);
        }
    }

    /**
     * Checks that the billing and shipping addresses are the same.
     * If not, returns false. Else, checks the parent's function.
     *
     * @param string $country
     * @return bool
     */
    public function canUseForCountry($country)
    {
        $quote = Mage::getSingleton('checkout/session')->getQuote();

        if (!$this->getAddressMismatchDisable() || !$quote) {
            return parent::canUseForCountry($country);
        }

        $fields = explode(',', $this->getAddressCheckFields());

        $billingAddress = $quote->getBillingAddress();
        $shippingAddress = $quote->getShippingAddress();

        if (in_array('address', $fields)) {
            if ($billingAddress->getStreet() != $shippingAddress->getStreet()) {
                return false;
            }
            if ($billingAddress->getCity() != $shippingAddress->getCity()) {
                return false;
            }
            if ($billingAddress->getRegionId() != $shippingAddress->getRegionId()) {
                return false;
            }
            if ($billingAddress->getCountryId() != $shippingAddress->getCountryId()) {
                return false;
            }
            if ($billingAddress->getPostcode() != $shippingAddress->getPostcode()) {
                return false;
            }
        }

        if (in_array('name', $fields)) {
            if ($billingAddress->getName() != $shippingAddress->getName()) {
                return false;
            }
        }

        if (in_array('phone', $fields)) {
            if ($billingAddress->getTelephone() != $shippingAddress->getTelephone()) {
                return false;
            }
        }

        return parent::canUseForCountry($country);
    }

	public function authorize(Varien_Object $payment, $amount)
    {
    	$error = false;
        if($amount<=0) {
            $error = Mage::helper('chpaymentech')->__('Invalid amount for authorization.');
            Mage::throwException($error);
        }

			$txMode = "A"; // pre auth
			$txRefid = 0;
			$this->_amount = $amount;
			$this->_payment = $payment;
			$this->log(__METHOD__ . "before helper call");
			$txnRequest = mage::helper('chpaymentech/processor')->_buildNewOrderSoapRequest($payment, $txMode, 0, $amount);
			$this->log(__METHOD__ . 'txnRequest : ' . print_r($txnRequest,true));
			$txnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
			$this->log(__METHOD__ . 'txnResponse: ' . print_r($txnResponse, true));

			//Begin parsing response with simpleXml
			$this->_soapResponse = mage::helper('chpaymentech/processor')->_parseXMLResponse($txnResponse);
			
			$txnErrors = mage::helper('chpaymentech/processor')->parseNewOrderForErrors($this->_soapResponse, $txMode);

        $this->log(__METHOD__ . __LINE__ );

        if(count($txnErrors) > 0) {
            foreach ($txnErrors as $txnError) {
                $error .= $txnError . "\n";
            }

            try {
                $this->log(__METHOD__ . __LINE__ );
                $returnNode = &$this->_soapResponse->SOAPBody->NewOrderResponse->return;
                $vtxnRequest = mage::helper('chpaymentech/processor')->_buildVoidSoapRequest($payment, $txMode, $returnNode->txRefNum, $amount);
                $this->log(__METHOD__ . __LINE__ .  'VOID txnRequest : ' . print_r($vtxnRequest,true));
                $vtxnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $vtxnRequest);
                $this->log(__METHOD__ . __LINE__ .  'VOID txnResponse : ' . print_r($vtxnResponse ,true));

            } catch(Exception $e) {
                $this->log(__METHOD__ . 'VOID failed : ' . $e->getMessage());
            }

        } else {
            $returnNode = &$this->_soapResponse->SOAPBody->NewOrderResponse->return;
            $payment->setCcApproval($returnNode->respCode)
                ->setLastTransId($returnNode->txRefIdx)
                ->setCcTransId($returnNode->txRefNum)
                ->setCcAvsStatus($returnNode->avsRespCode)
                ->setCcCidStatus($returnNode->cvvRespCode)
            ;

            $payment->setStatus('APPROVED');
        }

        if ($error !== false) {
            Mage::throwException($error);
        }

        return $this;
    }

	public function capture(Varien_Object $payment, $amount)
    {
    	$error = false;
        $txMode = "";
        if($amount<= 0) {
            $error = Mage::helper('paygate')->__('Invalid amount for capture.');
            Mage::throwException($error);
        }


        	$txRefid = 0;

        	if ($payment->getCcTransId())  {
				$txRefid = $payment->getCcTransId();
	            $txMode = "MFC";
        	    $this->_amount = $amount;
				$this->_payment = $payment;
				$txnRequest = mage::helper('chpaymentech/processor')->_buildMFCSoapRequest($payment, $txMode, $txRefid, $amount);
				$this->log(__METHOD__ . 'txnRequest : ' . print_r($txnRequest,true));
				$txnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
				$this->log(__METHOD__ . 'txnResponse: ' . print_r($txnResponse, true));
	
				//Begin parsing response with simpleXml
				$this->_soapResponse = mage::helper('chpaymentech/processor')->_parseXMLResponse($txnResponse);
	
				$txnErrors = mage::helper('chpaymentech/processor')->parseMFCForErrors($this->_soapResponse);	            
        	} else {
            	$txMode = "AC";
        		$this->_amount = $amount;
				$this->_payment = $payment;
				$txnRequest = mage::helper('chpaymentech/processor')->_buildNewOrderSoapRequest($payment, $txMode, 0, $amount);
				$this->log(__METHOD__ . 'txnRequest : ' . print_r($txnRequest,true));
				$txnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
				$this->log(__METHOD__ . 'txnResponse: ' . print_r($txnResponse, true));
	
				//Begin parsing response with simpleXml
				$this->_soapResponse = mage::helper('chpaymentech/processor')->_parseXMLResponse($txnResponse);
	
				$txnErrors = mage::helper('chpaymentech/processor')->parseNewOrderForErrors($this->_soapResponse, $txMode);
			}

            if(count($txnErrors) > 0) {
                try {
                    $txnRequest = mage::helper('chpaymentech/processor')->_buildVoidSoapRequest($payment, $txMode, $txRefid, $amount);
                    $this->log(__METHOD__ . 'VOID txnRequest : ' . print_r($txnRequest,true));
                    $vtxnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
                    $this->log(__METHOD__ . 'VOID txnRequest : ' . print_r($vtxnResponse ,true));

                } catch(Exception $e) {
                    $this->log(__METHOD__ . 'VOID failed : ' . $e->getMessage());
                }


            foreach ($txnErrors as $txnError) {
					$error .= $txnError . "\n";
				}

			} else {
				$returnNode = &$this->_soapResponse->SOAPBody->NewOrderResponse->return;
				if($txMode == "MFC") {

					$payment->setCcApproval($returnNode->respCode)
						->setLastTransId($returnNode->txRefIdx)
						->setCcTransId($returnNode->txRefNum)
                    // 20130731 - We dont set these here as they came from authorize.
					//	->setCcAvsStatus($returnNode->avsRespCode)
					//	->setCcCidStatus($returnNode->cvvRespCode)
                    ;

					$payment->setStatus('APPROVED');
				} else {
					$payment->setLastTransId($returnNode->txRefIdx)
							->setCcTransId($returnNode->txRefNum)
                        ->setCcAvsStatus($returnNode->avsRespCode)
                        ->setCcCidStatus($returnNode->cvvRespCode)
                    ;

					$payment->setStatus('APPROVED');
				}
			}


        if ($error !== false) {
            Mage::throwException($error);
        }
        return $this;
    }

	public function void(Varien_Object $payment)
    {
        $this->log(__METHOD__ . __LINE__ );
        try {
            $txRefid = $payment->getCcTransId();
            $txMode = 'V';
            $txnRequest = mage::helper('chpaymentech/processor')->_buildVoidSoapRequest($payment, $txMode, $txRefid, 0);
            $this->log(__METHOD__ . 'VOID txnRequest : ' . print_r($txnRequest,true));
            $vtxnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
            $this->log(__METHOD__ . 'VOID txnRequest : ' . print_r($vtxnResponse ,true));

        } catch(Exception $e) {
            $this->log(__METHOD__ . 'VOID failed : ' . $e->getMessage());
        }
    }


	public function refund(Varien_Object $payment, $amount)
    {
    	$error = false;
        if($amount>0) {
			$txMode = "R"; // pre auth
			$txRefid = $payment->getCcTransId();
			$this->_amount = $amount;
			$this->_payment = $payment;
			$txnRequest = mage::helper('chpaymentech/processor')->_buildNewOrderSoapRequest($payment, $txMode, $txRefid, $amount);
			$this->log(__METHOD__ . 'txnRequest : ' . print_r($txnRequest,true));
			$txnResponse = mage::helper('chpaymentech/processor')->_postXMLRequest($txMode, $txnRequest);
			$this->log(__METHOD__ . 'txnResponse: ' . print_r($txnResponse, true));

			//Begin parsing response with simpleXml
			$this->_soapResponse = mage::helper('chpaymentech/processor')->_parseXMLResponse($txnResponse);;

			$txnErrors = mage::helper('chpaymentech/processor')->parseNewOrderForErrors($this->_soapResponse, $txMode);
			
			if(count($txnErrors) > 0) {
				foreach ($txnErrors as $txnError) {
					$error .= $txnError . "\n";
				}
			} else  {
				$returnNode = &$this->_soapResponse->SOAPBody->NewOrderResponse->return;
				$payment->setCcApproval($returnNode->respCode)
						->setLastTransId($returnNode->txRefIdx)
						->setCcTransId($returnNode->txRefNum)
						->setCcAvsStatus($returnNode->avsRespCode)
						->setCcCidStatus($returnNode->cvvRespCode);	

				$payment->setStatus('APPROVED');	
			}					
        } else {
            $error = Mage::helper('paygate')->__('Invalid amount for authorization.');
        }

        if ($error !== false) {
            Mage::throwException($error);
        }

        return $this;
    }
}
