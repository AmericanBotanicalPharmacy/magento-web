<?php

/**
 * Cw server
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Resource_Cwserenade extends Mage_Core_Model_Resource_Db_Abstract
{
	
	// CWOrderIn components
	private $_source = "ABPPROD";
	private $_target = "RDC";
	private $_type = "CWORDERIN";
	private $_respQmgr = "CWIAS400";
	private $_respQ = "CWDIRECT.PROMOTION.OUT.10.Q";
	
	// header vars
	//private $_sourceCode = "WOMC1";
	
	/**
	 * Cw config
	 */
	protected $_cwOrderInUrl;
	protected $_cwMessageInurl;
	protected $_retries;
	protected $_rescheduleAfter;
	protected $_maintenanceWindowFrom;
	protected $_maintenanceWindowTo;

	/**
	 * @see Mage_Core_Model_Resource_Abstract::_construct()
	 */
	protected function _construct()
	{
		$this->_cwOrderInUrl = Mage::getStoreConfig('abp_cwserenade/configuration/cworderin_url');
		$this->_cwMessageInurl = Mage::getStoreConfig('abp_cwserenade/configuration/cwmessagein_url');
		$this->_retries = Mage::getStoreConfig('abp_cwserenade/configuration/retries');
		$this->_rescheduleAfter = Mage::getStoreConfig('abp_cwserenade/configuration/reschedule_after');
		$maintenanceWindowFrom = Mage::getStoreConfig('abp_cwserenade/configuration/maintenance_window_from');
        $maintenanceWindowTo = Mage::getStoreConfig('abp_cwserenade/configuration/maintenance_window_to');

        $pattern = '/^(?:0[1-9]|1[0-2]):[0-5][0-9] (am|pm|AM|PM)$/';
        $matches = array();
        $this->_maintenanceWindowFrom = (preg_match($pattern,$maintenanceWindowFrom, $matches)) ? $maintenanceWindowFrom : '4:00 AM';
        $this->_maintenanceWindowTo = (preg_match($pattern,$maintenanceWindowTo, $matches)) ? $maintenanceWindowTo : '6:00 AM';
	}
	
	/**
	 * Null out cc data
	 */
	protected function _resetCompletedOrders()
	{
		$completedState = Abp_Cwserenade_Model_Order_State::COMPLETED;
		$completedOrders = Mage::getModel('abp_cwserenade/order')->getCollection();
		$completedOrders->addFieldToFilter('state', $completedState);
		$completedOrders->addFieldToFilter(
		    array('cc_type', 'cc_number_enc', 'cc_cid_enc', 'cc_exp_month', 'cc_exp_year'),
		        array(
		            array('neq'=>''), array('neq'=>''), array('neq'=>''), array('neq'=>'0'), array('neq'=>'0'),
		        )
		);
		$size = $completedOrders->getSize();
		
		if ($size > 0){
				
			foreach ($completedOrders as $completedOrder){
		
				try {
										
					$completedOrder->setCcType('')->setCcNumberEnc('')->setCcCidEnc('')->setCcExpMonth(0)->setCcExpYear(0);
					$completedOrder->save();
						
				}catch(Exception $e){
					Mage::log($e->getMessage(), null, 'abp_cwserenade.log');
				}
		
			}
				
		}		
		
	}
	
	/**
	 * Reset processing orders
	 * 
	 * @param Mage_Cron_Model_Schedule $schedule Current schedule
	 * @return array $rescheduleOrders Rescheduled increment ids
	 */
	protected function _resetProcessingOrders($schedule)
	{
		$rescheduleOrders = array();
		
		$scheduleId = $schedule->getId();//current schedule id
		$pendingState = Abp_Cwserenade_Model_Order_State::PENDING;
		$processingState = Abp_Cwserenade_Model_Order_State::PROCESSING;
		$rescheduleAfter = $this->_rescheduleAfter * 60;
		
		//check for hung jobs
		$processingOrders = Mage::getModel('abp_cwserenade/order')->getCollection();
		$processingOrders->addFieldToFilter('state', $processingState);
		$size = $processingOrders->getSize();
			
		if ($size > 0){
			
			foreach ($processingOrders as $processingOrder){
				
				$processingIncrementId = $processingOrder->getIncrementId();
				$processingOrderScheduleId = $processingOrder->getScheduleId();
				
				$scheduleModel = Mage::getModel('cron/schedule');
				$scheduleModel->load($processingOrderScheduleId);
				$status = $scheduleModel->getStatus();
				$scheduledAt = $scheduleModel->getScheduledAt();
				$scheduledAtTime = strtotime($scheduledAt);
				$executedAt = $scheduleModel->getExecutedAt();
				$rescheduleAfterTime = strtotime(date('Y-m-d H:i:s')) - $rescheduleAfter;
				
				//reset if scheduled more than configured minutes ago
				if ($scheduledAtTime < $rescheduleAfterTime){
					
					try {
						$log = "Order $processingIncrementId from schedule $processingOrderScheduleId reset to pending";
						Mage::log($log, null, 'abp_cwserenade.log');
						
						$processingOrder->setState($pendingState)->setScheduleId(0)->save();
						$rescheduleOrders[] = $processingOrder->getId();
					
					}catch(Exception $e){
						Mage::log($e->getMessage(), null, 'abp_cwserenade.log');
					}				
						
				}
				
			}
			
		}		
						
		return $rescheduleOrders;
	}
	
	protected function _ping()
	{
		$parsed = parse_url($this->_cwOrderInUrl);
		$host = $parsed['host'];
		$port = $parsed['port'];
		$waitTimeoutInSeconds = 5;
				
		if ($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){
			return true;
		} 
		
		return false;
	}
	
	protected function _isMaintenance()
    {
        $timezone = new DateTimeZone('America/New_York');

        $currentDate = new DateTime("now", $timezone);
        $windowFrom = DateTime::createFromFormat('H:i a', $this->_maintenanceWindowFrom, $timezone);
        $windowTo = DateTime::createFromFormat('H:i a', $this->_maintenanceWindowTo, $timezone);

        if ($currentDate > $windowFrom && $currentDate < $windowTo) {
           return true;
        }

        return false;
    }
	
	/**
	 * Push staged orders
	 *
	 * @return Abp_Cwserenade_Model_Order
	 */
	public function pushStagedOrders($schedule)
	{
		if (!$this->_ping()){
			
			$message = "Ping failed";
			Mage::log($message, null, 'abp_cwserenade.log');
		
			return $message;
		}
		
		if ($this->_isMaintenance()){

            return;
        }
		
		$scheduleId = $schedule->getId();
		$this->_resetCompletedOrders();
		$rescheduleOrders = $this->_resetProcessingOrders($schedule);
		
		//cron result
		$numberPushed = 0;
		$numberToRetry = 0;
		$numberFailed = 0;
		
		try {
	
			//push staged orders
			$pendingState = Abp_Cwserenade_Model_Order_State::PENDING;
			$processingState = Abp_Cwserenade_Model_Order_State::PROCESSING;
			$failedState = Abp_Cwserenade_Model_Order_State::FAILED;
			$completedState = Abp_Cwserenade_Model_Order_State::COMPLETED;
	
			$pendingOrders = Mage::getModel('abp_cwserenade/order')->getCollection();
			$pendingOrders->addFieldToFilter('state', $pendingState);
	
			$size = $pendingOrders->getSize();
		$message = "Found Pending orders: ".$size;
		Mage::log($message, null, 'abp_cwserenade.log');
	
			if ($pendingOrders->getSize()>0){
				 
				foreach ($pendingOrders as $pendingOrder){
						
					$incrementId = $pendingOrder->getIncrementId();
					$pendingOrder->setState($processingState)->setScheduleId($scheduleId)->save();
						
					$cwOrderOut = $this->_pushStagedOrder($pendingOrder);
	
					if ($cwOrderOut){
						
						$cwOrderOutResponseXml = simplexml_load_string($cwOrderOut);
						$cwOrderOutResponseJson = json_encode($cwOrderOutResponseXml);
						$cwOrderOutObj = json_decode($cwOrderOutResponseJson, true);
						
						$cwOrderId = $cwOrderOutObj['Header']['@attributes']['order_id'];
						$cwCustomerNumber = $cwOrderOutObj['Header']['@attributes']['customer_number'];
						
						if ($cwOrderId && $cwCustomerNumber){
							
							$pendingOrder->setCwOrderId($cwOrderId)
							->setCwCustomerNumber($cwCustomerNumber)
							->setCwOrderOut($cwOrderOut)
							->setState($completedState);
								
							$numberPushed++;
							Mage::log("Order {$pendingOrder->getIncrementId()} pushed; Customer number: $cwCustomerNumber; CW Order Id: $cwOrderId", null, 'abp_cwserenade.log');
							
							$order = Mage::getModel('sales/order')->loadByIncrementId($incrementId);
							$comment = "CW pushed. CW customer number: $cwCustomerNumber, CW order Id: $cwOrderId";
								
							$order->addStatusHistoryComment($comment)
							->setIsVisibleOnFront(false)
							->setIsCustomerNotified(false)
							->save();
														
						} else {

							$pendingOrder->setCwOrderOut($cwOrderOut)
							->setState($failedState);
							
							$numberFailed++;
							Mage::log("Order {$pendingOrder->getIncrementId()} failed", null, 'abp_cwserenade.log');							
						}
						
					} else {
						 
						$numRetries = $pendingOrder->getNumRetries();
						
						if ($numRetries >= $this->_retries - 1){
							
							$numberFailed++;
							$pendingOrder->setState($failedState);
							
							Mage::log("Order {$pendingOrder->getIncrementId()} failed after {$this->_retries} tries", null, 'abp_cwserenade.log');
								
						} else {
							
							$numberToRetry++;
							$numRetries++;
							$pendingOrder->setNumRetries($numRetries);
							
							Mage::log("Order {$pendingOrder->getIncrementId()} set to retry $numRetries", null, 'abp_cwserenade.log');
						}
						
					}
					
					//save the staged order
					$pendingOrder->save();
				}
			}
	
		} catch (Exception $e){
	
			Mage::log("Unknown Exception: :" . $e->getMessage(), null, 'abp_cwserenade.log');
		}
		 
		$message = "Cron ran. Pushed: ".$numberPushed." Retries: $numberToRetry Failed: ".$numberFailed;
		Mage::log($message, null, 'abp_cwserenade.log');
	
		return $message;
		 
	}
	
	/**
	 * Push the order
	 *
	 * @todo not implemented
	 * @param Abp_Cwserenade_Model_Order $pendingOrder
	 * @return boolean|object
	 */
	protected function _pushStagedOrder($pendingOrder)
	{
		$response = false;
		
	    try {
        	$incrementId = $pendingOrder->getIncrementId();

            $messageData =  $this->_getOrderInMessageData($incrementId);
            $message = $this->_getOrderInMessage($messageData);

            $client = new SoapClient($this->_cwOrderInUrl);
            ini_set('default_socket_timeout', 120);
            $response = $client->performAction($message);
        } catch(Exception $e){
            Mage::log($e->getMessage(), null, 'abp_cwserenade.log');
            Mage::log('_pushStagdOrdr', null, 'abp_cwserenade.log');
            //Mage::log($message, null, 'abp_cwserenade2.log');
        }
									
		return $response;
	}
	
	/**
	 * Get variables for message
	 *
	 * @param string $incrementId
	 * @return array
	 */
	protected function _getOrderInMessageData($incrementId)
	{	 
		$order = Mage::getModel('sales/order')->loadByIncrementId($incrementId);
		
		$messageData = array('incrementId' => $incrementId);
		
		$customerId = $order->getCustomerId();
		
		$customerData = array('customerId' => $customerId);
		
		$items = $order->getAllItems();
		foreach ($items as $item){
			//Product based source code override
			$attribute = Mage::getModel('catalog/product')->load($item->getProductId())->getData('source_code');
			if ($attribute)
			{
				$sourceCode = $attribute;
			//Mage::log($attribute, null, 'tmp.log');
			} else {
							//Default source code for CW
							//$sourceCode = "WOLK1";
							$sourceCode = "WOMD1"; // for April 1st
							
							//Mage::log($sourceCode, null, 'tmp.log');
					}
			}
			//Coupon based source code overridesales/order
			$coupon_code = $order->getCouponCode();
				if (!is_null($coupon_code)) {
				$sourceCode = $order->getCouponCode(); 
							
							//Mage::log($sourceCode, null, 'tmp.log');
			}
			
			//$discount = Mage::helper('sales')->__('Discount (%s)', $order->getDiscountDescription());
			//if ($discount) {
				//Mage::log($discount, null, 'tmp.log');
			//}
									
		$salesData = array('sourceCode' => $sourceCode);
						
		//billing address
		$billingData = Mage::getModel('abp_cwserenade/order_billing')->getMessageData($order);
		 
		//shipping address
		$shippingData = Mage::getModel('abp_cwserenade/order_shipping')->getMessageData($order);
		 
		//payment
		$paymentData = Mage::getModel('abp_cwserenade/order_payment')->getMessageData($order);
	
		//shipping method
		$shippingMethodData = Mage::getModel('abp_cwserenade/order_shippingmethod')->getMessageData($order);
	
		$messageData = array_merge($customerData, $salesData, $messageData, $billingData, $shippingData, $paymentData, $shippingMethodData);
		 
		//items
	    $items = $order->getAllItems();
        $itemsAr = array();
        foreach ($items as $item) {
            if ($item->getParentItemId()){
                $parentItemId = $item->getParentItemId();
                $parentItem = $order->getItemById($parentItemId);
                if ($parentItem->getProductType()=='configurable'){
                    continue;
                }
            }
                
            $itemsAr[] .= '<Item actual_price="' . $item->getPrice() . 
            '" item_id="' . $item->getSku() .   
            '" line_source_code="" no_charge="N" prc_ovr_rsn="P" quantity="' . (int) $item->getQtyOrdered() .
            '" tax_override="Y" tax_amount="' .  $item->getData('tax_amount') . '" />';
        }
		
		$messageData['itemsStr'] = implode("\n\t\t\t\t\t\t\t",$itemsAr);
	
		return $messageData;
	}
	
	/**
	 * Get message xml
	 *
	 * @param array $messageData
	 * @return string
	 */
	protected function _getOrderInMessage($messageData)
	{
		
		//$order = Mage::getModel('sales/order')->loadByIncrementId($incrementId);
		
		//$customerId = $order->getCustomerId();
		//$coupon_code = $order->getCouponCode();
		
		extract($messageData);
		 
		$message = '<?xml version="1.0" encoding="UTF-8" ?>
    	<Message
    		source="'.$this->_source.'"
    		target="'.$this->_target.'"
    		type="'.$this->_type.'"
    		resp_qmgr="'.$this->_respQmgr.'"
    		resp_q="'.$this->_respQ.'">
    		<Header
    			company_code="001"
    			order_number="'.$incrementId.'"
    			alternate_sold_to_id=""
    			payment_only="N"
    			source_code="'.$sourceCode.'"
    			response_type="D"
    			order_channel="I"
    			sold_to_fname="'.$soldToFname.'"
    			sold_to_lname="'.$soldToLname.'"
    			sold_to_address1="'.$soldToAddress1.'"
    			sold_to_apartment="'.$soldToApartment.'"
    			sold_to_city="'.$soldToCity.'"
    			sold_to_state="'.$soldToState.'"
    			sold_to_zip="'.$soldToZip.'"
    			sold_to_country="'.$soldToCountry.'"
    			sold_to_email="'.$soldToEmail.'"
    			sold_to_day_phone="'.$soldToDayPhone.'"
    			sold_to_address_update="Y"
    			sold_to_email_update="Y"
    			sold_to_company="'.$soldToCompany.'"
    			pay_incl="Y"
    			order_type="W">
    			<Payments>
					'.$paymentsStr.'
    			</Payments>
    			<ShipTos>
    				<ShipTo
    					calc_frt="N"
    					freight="'.$freight.'"
    					ship_complete="Y"
    					shipping_method="'.$shippingMethod.'"
    					ship_to_type="1"
    					ship_to_fname="'.$shipToFname.'"
    					ship_to_lname="'.$shipToLname.'"
    					ship_to_address1="'.$shipToAddress1.'"
    					ship_to_apartment="'.$shipToApartment.'"
    					ship_to_city="'.$shipToCity.'"
    					ship_to_state="'.$shipToState.'"
    					ship_to_zip="'.$shipToZip.'"
    					ship_to_country="'.$shipToCountry.'"
    					ship_to_company = "'.$shipToCompany.'">
    					<Items>
							'.$itemsStr.'
    					</Items>
    				</ShipTo>
    			</ShipTos>
    		</Header>
    	</Message>';
		//Mage::log($message, null, 'message.log');
		return $message;
	}	
	
}
