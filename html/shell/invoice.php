<?php      
include "../app/Mage.php";
Mage::app();    
$orders = Mage::getModel('sales/order')->getCollection()
                                       ->addFieldToFilter('status', 'pending')
                                       ->addAttributeToFilter('created_at', array('from'=>'2015-12-26', 'to'=>'2015-12-29'));
foreach ($orders as $order){
$payment_method = $order->getPayment()->getMethodInstance()->getTitle();
$order_id = $order->getId();

if($payment_method=="Debit Card"){


try {
if(!$order->canInvoice())
{
Mage::throwException(Mage::helper('core')->__('Cannot create an invoice.'));
}
 
$invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice();
 
if (!$invoice->getTotalQty()) {
Mage::throwException(Mage::helper('core')->__('Cannot create an invoice without products.'));
}
 
$invoice->setRequestedCaptureCase(Mage_Sales_Model_Order_Invoice::CAPTURE_ONLINE);
$invoice->register();
$transactionSave = Mage::getModel('core/resource_transaction')
->addObject($invoice)
->addObject($invoice->getOrder());
 
$transactionSave->save();
 $order->setState(Mage_Sales_Model_Order::STATE_PROCESSING)
        ->setStatus(Mage_Sales_Model_Order::STATE_PROCESSING)
        ->save();
}
catch (Mage_Core_Exception $e) {
 
}

}
}
?>
