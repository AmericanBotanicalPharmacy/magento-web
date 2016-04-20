<?php

class Aydus_AjaxError_LogController extends Mage_Core_Controller_Front_Action
{
    protected $_logFileName = 'aydus_ajaxerror.log';

    public function indexAction() {

        try {
            $success = 0;

            $file = Mage::helper('core')->jsonDecode($this->getRequest()->getParam('file'));
            $error = Mage::helper('core')->jsonDecode($this->getRequest()->getParam('error'));
            $message = sprintf('%s - %s', $file, $error);

            if (strlen($message) > 0) {
                Mage::log($message, Zend_Log::ERR, $this->_logFileName);
                $success = 1;
            }

            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($success));
        }

        catch(Exception $e) {}
    }
}