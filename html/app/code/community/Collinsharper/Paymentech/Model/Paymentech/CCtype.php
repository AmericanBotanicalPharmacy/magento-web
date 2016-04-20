<?php
class Collinsharper_Paymentech_Model_Paymentech_CCtype extends Mage_Payment_Model_Source_Cctype
{
    public function getAllowedTypes()
    {
        return array('VI', 'MC', 'AE', 'DI', 'JCB');
    }
}
