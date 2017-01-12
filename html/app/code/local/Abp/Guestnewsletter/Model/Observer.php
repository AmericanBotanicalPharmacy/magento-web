<?php
class Abp_Guestnewsletter_Model_Observer
{
    public function AddGuestToNewletter(Varien_Event_Observer $observer)
    {
        $checkoutMethod = Mage::getSingleton('checkout/type_onepage')->getQuote()->getCheckoutMethod();
        $postData = $observer->getControllerAction()->getRequest()->getPost();
        if ($checkoutMethod == Mage_Checkout_Model_Type_Onepage::METHOD_GUEST) {
            if ($postData['is_subscribed'] == '1') {
                // Always save billing.email into newsletter/subscriber...
                $status = Mage::getModel('newsletter/subscriber')->subscribe($postData['billing']['email']);    
            }
        }
        return $this;
    }

}