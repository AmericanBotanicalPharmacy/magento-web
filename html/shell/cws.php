<?php      
include "../app/Mage.php";
Mage::app();     
	
$orders = Mage::getModel('sales/order')->getCollection()
->addFieldToFilter('status', 'processing')
    ->addAttributeToFilter('created_at', array('from'=>'2015-12-26', 'to'=>'2015-12-29'));
 foreach ($orders as $order){
$payment_method = $order->getPayment()->getMethodInstance()->getTitle();

if($payment_method=="Debit Card"){

 try {

                $incrementId = $order->getIncrementId();
                $payment = $order->getPayment();

                if (!$payment->getId()){
                       print "not process";exit;

                 }

$state = Abp_Cwserenade_Model_Order_State::PENDING;


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


                        $stageOrder = Mage::getModel('abp_cwserenade/order');
                        $stageOrder->setData($stageData);
                $stageOrder->save();
        } catch(Exception $e){
                Mage::log($e->getMessage(), null, 'abp_cwserenade.log');
        }
print "hello". $incrementId;
}



}



?>
