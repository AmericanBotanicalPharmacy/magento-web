<?php
/**
 * This file used to quick test for magento runtime.
 * ENABLE default set false.
 */

define('MAGENTO_ROOT', getcwd());
define('ABP_TEST_ENABLE', false);

if(!ABP_TEST_ENABLE) exit;

require_once MAGENTO_ROOT . '/app/Mage.php';
Mage::app();

if (!function_exists('abp_dump')) {
    function abp_dump($param) {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    }
}

$order  = Mage::getModel('sales/order')->load(14577);
$orders = Mage::getModel('sales/order')->getCollection()
    ->setOrder('created_at','DESC')
    ->setPageSize(1)
    ->setCurPage(1);
$orderId = $orders->getFirstItem()->getEntityId();
//abp_dump($order->getData());
//abp_dump($orderId);


$apiKey1 = Mage::getStoreConfig('mailchimp/general/api_key', Mage::app()->getStore());
$apiKey2 = Mage::helper('mailchimp')->apiKey();
//abp_dump($apiKey1);
//abp_dump($apiKey2);


$customer = Mage::getModel('customer/customer')->load(43);
$email = $customer->getData('email');
//abp_dump($email);

require_once 'Lib/MailChimp/MailChimp.php';
$enabled = Mage::helper('mailchimp')->isEnabled();
$apiKey = Mage::helper('mailchimp')->apiKey();
$llistId = Mage::helper('mailchimp')->listId();
if($enabled) {
    $MailChimp = new \DrewM\MailChimp\MailChimp($apiKey);
//    $result = $MailChimp->post("lists/$llistId/members", [
//        'email_address' => $email,
//        'status'        => 'subscribed',
//    ]);
//    abp_dump($result);
}