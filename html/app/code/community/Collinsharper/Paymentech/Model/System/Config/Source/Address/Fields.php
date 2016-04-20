<?php

class Collinsharper_Paymentech_Model_System_Config_Source_Address_Fields extends Varien_Object
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'address',             'label' => Mage::helper('chpaymentech')->__('Address')),
            array('value' => 'address,name',        'label' => Mage::helper('chpaymentech')->__('Address and Name')),
            array('value' => 'address,name,phone',  'label' => Mage::helper('chpaymentech')->__('Address, Name, and Phone'))
        );
    }
}
