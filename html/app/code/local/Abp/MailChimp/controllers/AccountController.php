<?php

/**
 * Abp_Mailchimp overriding AccountController
 *
 * @category    Abp
 * @package     Abp_Mailchimp
 * @author      Edward Yang <yushine999@gmail.com>
 */
require_once 'Mage/Customer/controllers/AccountController.php';
require_once 'Lib/MailChimp/MailChimp.php';

class Abp_Mailchimp_AccountController extends Mage_Customer_AccountController
{
    /**
     * Create customer account action
     */
    public function createPostAction(){
        $errUrl = $this->_getUrl('*/*/create', array('_secure' => true));

        if (!$this->_validateFormKey()) {
            $this->_redirectError($errUrl);
            return;
        }

        /** @var $session Mage_Customer_Model_Session */
        $session = $this->_getSession();
        if ($session->isLoggedIn()) {
            $this->_redirect('*/*/');
            return;
        }

        if (!$this->getRequest()->isPost()) {
            $this->_redirectError($errUrl);
            return;
        }

        $customer = $this->_getCustomer();

        try {
            $errors = $this->_getCustomerErrors($customer);

            if (empty($errors)) {
                $customer->save();
                if ($customer->getEntityId()) {
                    $this->addedToMailChimpList($customer);
                }
                $this->_dispatchRegisterSuccess($customer);
                $this->_successProcessRegistration($customer);
                return;
            } else {
                $this->_addSessionError($errors);
            }
        } catch (Mage_Core_Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            if ($e->getCode() === Mage_Customer_Model_Customer::EXCEPTION_EMAIL_EXISTS) {
                $url = $this->_getUrl('customer/account/forgotpassword');
                $message = $this->__('There is already an account with this email address. If you are sure that it is your email address, <a href="%s">click here</a> to get your password and access your account.', $url);
            } else {
                $message = $this->_escapeHtml($e->getMessage());
            }
            $session->addError($message);
        } catch (Exception $e) {
            $session->setCustomerFormData($this->getRequest()->getPost());
            $session->addException($e, $this->__('Cannot save the customer.'));
        }

        $this->_redirectError($errUrl);
    }

    /**
     * @param $customer
     * @return array|false
     */
    private function addedToMailChimpList($customer)
    {
        $enabled = Mage::helper('mailchimp')->isEnabled();
        $apiKey = Mage::helper('mailchimp')->apiKey();
        $llistId = Mage::helper('mailchimp')->listId();

        $result = 'Mailchimp disabled.';
        if($enabled) {
            $MailChimp = new \DrewM\MailChimp\MailChimp($apiKey);
            $result = $MailChimp->post("lists/$llistId/members", [
                'email_address' => $customer->getData('email'),
                'status'        => 'subscribed',
            ]);
        }
        Mage::log($result);
        return $result;
    }
}
