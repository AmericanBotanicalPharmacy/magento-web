<?php



class Collinsharper_Paymentech_Helper_Processor extends Mage_Core_Helper_Abstract
{ 

    public function log($x)
    {
        if(Mage::getStoreConfig('payment/chpaymentech/test') || Mage::getStoreConfig('payment/chpaymentech/debug')) {
            mage::log($x);
        }
    }

    public function _buildNewOrderSoapRequest(Varien_Object $payment, $txMode, $txRefid = 0, $amount)
    {
    	$this->log(__METHOD__ . "reached helper");
    	$order = $payment->getOrder();
    	$billing = $order->getBillingAddress();
        $configData = $this->_buildRequestConfigData();
    	if($txMode == "A" || $txMode == "R" || $txMode == "AC") 
    	{
    		$this->log(__METHOD__ . "In helper if " . $txMode);
			$xmlString = 
			'
			<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pay="urn:ws.paymentech.net/PaymentechGateway">
			   <soapenv:Header/>
			   <soapenv:Body>
			      <pay:NewOrder>
			         <pay:newOrderRequest>       
			            <pay:orbitalConnectionUsername>' . $configData['username'] . '</pay:orbitalConnectionUsername>
			            <pay:orbitalConnectionPassword>' . $configData['password'] . '</pay:orbitalConnectionPassword>
			            <pay:version>2.4</pay:version>
			            <pay:industryType>EC</pay:industryType>
			            <pay:transType>' . $txMode . '</pay:transType>
			            <pay:bin>' . $configData['bin'] . '</pay:bin>
			            <pay:merchantID>' . $configData['merchant_id'] . '</pay:merchantID>
			            <pay:terminalID>' . $configData['terminal_id'] . '</pay:terminalID>';		            
			            if($txMode != "R") {
                            $cardVerifyPresenceInd = $payment->getCcType() == 'VI' || $payment->getCcType() == 'DI'
                                ? '<pay:ccCardVerifyPresenceInd>1</pay:ccCardVerifyPresenceInd>' : '';
                            $avs_countries = array('CA', 'US', 'GB', 'UK');
                            $avsCountry = in_array($billing->getCountry(), $avs_countries) ?
                                '<pay:avsCountryCode>' . $billing->getCountry() . '</pay:avsCountryCode>' : '';
                            
			            	$xmlString .=
			            	'
				            <pay:cardBrand></pay:cardBrand>
				            <pay:ccAccountNum>' . $payment->getCcNumber() . '</pay:ccAccountNum>			            			            
				            <pay:ccExp>' . $payment->getCcExpYear() . sprintf('%02d',  $payment->getCcExpMonth()) . '</pay:ccExp>			            		
			            	' . $cardVerifyPresenceInd . '
			            	<pay:ccCardVerifyNum>' . $payment->getCcCid() . '</pay:ccCardVerifyNum>

                            <pay:avsZip>' . substr(preg_replace('/[^a-z0-9]+/i', '', $billing->getPostcode()),0,10) . '</pay:avsZip>
                            <pay:avsAddress1>' . substr($billing->getStreet(1),0,30) . '</pay:avsAddress1>
                            <pay:avsAddress2>' . substr($billing->getStreet(2),0,30) . '</pay:avsAddress2>
                            <pay:avsCity>' . substr($billing->getCity(),0,20) . '</pay:avsCity>
                            <pay:avsState>' . substr($billing->getRegionCode(),0,2) . '</pay:avsState>
                            <pay:avsName>' . substr($billing->getFirstname() . " " .$billing->getLastname(),0,30) . '</pay:avsName>
                            ' . $avsCountry . '
                            <pay:avsPhone></pay:avsPhone>
			            	';
			            } else {
                            $xmlString .=
                                "\n".'<pay:txRefNum>' . $txRefid . '</pay:txRefNum>';
                        }

            $xmlString .=
                '
			            <pay:orderID>' . $order->getIncrement_id() . '</pay:orderID>
			            <pay:amount>' . floatval(sprintf("%01.2f",$amount * 100)) . '</pay:amount>
			            <pay:comments></pay:comments>
			         </pay:newOrderRequest>
			      </pay:NewOrder>
			   </soapenv:Body>
			</soapenv:Envelope>
			';
            // for new orders we are not to send this
            // <pay:txRefNum>' . $txRefid . '</pay:txRefNum>
    	} else {
    		//error request type not found
    		$this->log("Error: Transaction Type \"" . $txMode . "\" Not Found");
    		return;
    	}
    	return $xmlString;
    }

    public function _buildMFCSoapRequest(Varien_Object $payment, $txMode, $txRefid, $amount)
    {
        $configData = $this->_buildRequestConfigData();
        //ReversalElement
    	$xmlString = 
    	'
    	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pay="urn:ws.paymentech.net/PaymentechGateway">
   			<soapenv:Header/>
   				<soapenv:Body>
					<pay:MFC>
						<pay:mfcRequest>
			            <pay:orbitalConnectionUsername>' . $configData['username'] . '</pay:orbitalConnectionUsername>
			            <pay:orbitalConnectionPassword>' . $configData['password'] . '</pay:orbitalConnectionPassword>
			            <pay:version>2.4</pay:version>
			            <pay:orderID>' . $payment->getOrder()->getIncrement_id() . '</pay:orderID>
			            <pay:amount>' . floatval(sprintf("%01.2f",$amount * 100)) . '</pay:amount>
			            <pay:taxAmount></pay:taxAmount>
			            <pay:bin>' . $configData['bin'] . '</pay:bin>
			            <pay:merchantID>' . $configData['merchant_id'] . '</pay:merchantID>
			            <pay:terminalID>' . $configData['terminal_id'] . '</pay:terminalID>
			            <pay:txRefNum>' . $txRefid . '</pay:txRefNum>
			         </pay:mfcRequest>
				      </pay:MFC>
				   </soapenv:Body>
				</soapenv:Envelope>
    	';
        // we are not to send this since we are not sending full data
        //<pay:taxInd>0</pay:taxInd>
    	return $xmlString;
    }

    public function _buildVoidSoapRequest(Varien_Object $payment, $txMode, $txRefid, $amount)
    {
        $configData = $this->_buildRequestConfigData();
        //ReversalElement
    	$xmlString =
    	'
    	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pay="urn:ws.paymentech.net/PaymentechGateway">
   			<soapenv:Header/>
   				<soapenv:Body>
					<pay:Reversal>
						<pay:reversalRequest>
			            <pay:orbitalConnectionUsername>' . $configData['username'] . '</pay:orbitalConnectionUsername>
			            <pay:orbitalConnectionPassword>' . $configData['password'] . '</pay:orbitalConnectionPassword>
			            <pay:version>2.4</pay:version>
			            <pay:orderID>' . $payment->getOrder()->getIncrement_id() . '</pay:orderID>
			            <pay:bin>' . $configData['bin'] . '</pay:bin>
			            <pay:merchantID>' . $configData['merchant_id'] . '</pay:merchantID>
			            <pay:terminalID>' . $configData['terminal_id'] . '</pay:terminalID>
			            <pay:txRefIdx>NULL</pay:txRefIdx>
			            <pay:txRefNum>' . $txRefid . '</pay:txRefNum>
			         </pay:reversalRequest>
				      </pay:Reversal>
				   </soapenv:Body>
				</soapenv:Envelope>
    	';
        // we are not to send this since we are not sending full data
        //<pay:taxInd>0</pay:taxInd>
    	return $xmlString;
    }

    protected function _buildRequestConfigData()
    {
        return array(
            'username' => $this->_truncateString(Mage::getStoreConfig('payment/chpaymentech/login'), 32),
            'password' => $this->_truncateString(Mage::getStoreConfig('payment/chpaymentech/password'), 32),
            'bin' => $this->_truncateString(Mage::getStoreConfig('payment/chpaymentech/bin'), 6),
            'merchant_id' => $this->_truncateString(Mage::getStoreConfig('payment/chpaymentech/merchant_id'), 15),
            'terminal_id' => $this->_truncateString(Mage::getStoreConfig('payment/chpaymentech/terminal_id'), 3),
        );
    }

    protected function _truncateString($string, $len)
    {
        return substr($string, 0, $len);
    }

    public function _postXMLRequest($txMode, $txnRequest)
	{
		$client = new SoapClient(Mage::getStoreConfig('payment/chpaymentech/wsdl'));
		$location = Mage::getStoreConfig('payment/chpaymentech/gateway');
		try {
		    $result = $client->__doRequest($txnRequest, $location, "POST", "1.2");
		    return $result;
		} catch (SoapFault $sf) {
		    //this code was not reached    
		    $exception = $sf;
		    $this->log("IN Catch sf, client: " . print_r($client, true)); 
		    return $exception;
		} catch (Exception $e) {
		    //nor was this code reached either 
		    $exception = $e;
		    $this->log("IN catch exception, client: " . print_r($client, true));  
		    return $exception;
		} 
		$this->log(__METHOD__ . "No Connectivity " . __FILE__ . " " . __CLASS__ . " " . __LINE__);
	}

    public function _parseXMLResponse($txnResponse)
	{
		/* SimpleXML does not like the SOAP-ENV: namespace. If we construct with the soap namespace we have to do a lot more work.
		 * So we are hacking it to treat this as the default namespace, and making life more pleasant for everyone <-- (read Jonathan)!
		 */
		$xmlString = str_replace("SOAP-ENV", "SOAP", $txnResponse);
		$xmlString = str_replace("SOAP:", "SOAP", $xmlString);
		return new SimpleXMLElement($xmlString);
	}

    public function parseNewOrderForErrors($soapResponse, $txMode)
	{
		$txnErrors = array();
		
		if($returnNode = $soapResponse->SOAPBody->NewOrderResponse->return) {
			//check procStatus and approvalStatus
			if($returnNode->procStatus != 0) {
				$txnErrors[] = "Transaction refused with proc status: " . $returnNode->procStatus;
			}

			if($returnNode->approvalStatus != 1) {
				$txnErrors[] = "Transaction refused with approval status: " . $returnNode->approvalStatus;
			}	

			if($txMode != "R") {
				//check resp code
				$respAppCodes = explode(',', Mage::getStoreConfig('payment/chpaymentech/respsuccess'));
				foreach($respAppCodes as &$t) {
					$t = trim($t);
				}			

				if(!in_array(trim($returnNode->respCode), $respAppCodes)) {
					$txnErrors[] = "Transaction refused with error code: " . $returnNode->respCode;
				}
			}
		}

		if($fault = $soapResponse->SOAPBody->SOAPFault) {
			$txnErrors[] = "Services unavailable at this time";
			$this->log("SoapFault Error Found. Faultcode: " . $fault->faultcode . ". FaultString: " . $fault->faultstring);
		}

		return $txnErrors;
	}

    public function parseMFCForErrors($soapResponse)
	{
		$txnErrors = array();
		
		if($returnNode = $soapResponse->SOAPBody->mfcResponse->return)
		{	
			//check procStatus and approvalStatus
			if($returnNode->procStatus != 0)
			{
				$txnErrors[] = "Transaction refused with proc status: " . $returnNode->procStatus;
			}
			if($returnNode->approvalStatus != 1)
			{
				$txnErrors[] = "Transaction refused with approval status: " . $returnNode->approvalStatus;
			}					
			
			//check resp code
			$respAppCodes = explode(',', Mage::getStoreConfig('payment/chpaymentech/respsuccess'));
			foreach($respAppCodes as &$t)
			{
				$t = trim($t);
			}			
			if(!in_array(trim($returnNode->respCode), $respAppCodes))
			{
				$txnErrors[] = "Transaction refused with error code: " . $returnNode->respCode;
			}
		}
		if($fault = $soapResponse->SOAPBody->SOAPFault)
		{
			$txnErrors[] = "Services unavailable at this time";
			$this->log(__METHOD__ . "SoapFault Error Found. Faultcode: " . $fault->faultcode . ". FaultString: " . $fault->faultstring);
		}
		return $txnErrors;		
	}
}
