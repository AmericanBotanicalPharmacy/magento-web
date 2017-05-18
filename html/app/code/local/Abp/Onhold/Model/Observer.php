<?php

class Abp_Onhold_Model_Observer
{   
    public function holdOrder(Varien_Event_Observer $observer)
    {
        $orderIds = $observer->getEvent()->getOrderIds();
        if (empty($orderIds) || !is_array($orderIds)) {
            return;
        }
        // loop order ids, as normal there's ONLY one order id.
        foreach($orderIds as $value) {
            $order = Mage::getModel('sales/order')->load($value);
            $total = $order->getGrandTotal();
            $email = $order->getCustomerEmail();
            $s_zip = $order->getShippingAddress()->getData('postcode');
            $country_id = $order->getShippingAddress()->getData('country_id');
            $b_zip = $order->getBillingAddress()->getData('postcode');
            $s_region_id = $order->getShippingAddress()->getData('region_id');
            $enable = Mage::getStoreConfig('onhold/settings/active', Mage::app()->getStore());
            $amount = intval(Mage::getStoreConfig('onhold/settings/amount', Mage::app()->getStore()));
            $states = Mage::getStoreConfig('onhold/settings/specificstates', Mage::app()->getStore());
            $states_arr = explode(",", $states);
            $single_item_with_large_quantity = false;
            foreach ($order->getAllItems() as $item) {
              // Check if there are single items with large quantity, you can change it to any value.
              if ($item->getQtyOrdered() > 4) {
                $single_item_with_large_quantity = true;
                break;
              }
            }
            // Abp_Onhold module is active.
            // shipping address zip is NOT same as billing address zip
            // shipping address country_id is US.
            // shipping address region is IN onhold/settings/specificstates.
            // order's grand total is greater than onhold/settings/amount.
            // then change order's status to ON HOLD.
            //if($enable == '1' && $s_zip != $b_zip && $country_id == 'US' && in_array($s_region_id, $states_arr) && $total > $amount) {
            //05/17 remove the $s_zip != $b_zip conditioin as of new cases shows this is no longer true.
            //if($enable == '1' && $s_zip != $b_zip && $country_id == 'US' && in_array($s_region_id, $states_arr) && $total > $amount)
            if ($enable == '1' && $country_id == 'US' && $total > $amount) {
                if ($this->_endsWith($email, '@mail.com') || $single_item_with_large_quantity) {
                    $this->_processOrderStatus($order);
                }
            }
        }
        return $this;
    }

     private function _endsWith($haystack, $needle)
     {
    	$length = strlen($needle);
    	if ($length == 0) {
            return true;
    	}
    	return (substr($haystack, -$length) === $needle);
    }

    private function _processOrderStatus($order)
    {
        $this->_changeOrderStatus($order);
        return true;
    }

    private function _changeOrderStatus($order)
    {
        $statusMessage = '#SYSTEM HOLD THIS ORDER!';
        $order->addStatusHistoryComment($statusMessage);
        // do NOT notify customer...
        $order->setCustomerNoteNotify(false);
        $order->hold();       
        $order->save();
    }
}
