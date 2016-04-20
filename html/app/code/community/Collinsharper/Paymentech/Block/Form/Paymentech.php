<?php

class Collinsharper_Paymentech_Block_Form_Paymentech extends Mage_Payment_Block_Form_Cc
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('chpaymentech/form/paymentech.phtml');
    }
}
