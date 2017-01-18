<?php
class Abp_Onhold_Helper_Data extends Mage_Sales_Helper_Data
{
    // check current scope is frontend or backend.
    public function isAdmin()
    {
        if(Mage::app()->getStore()->isAdmin())
        {
            return true;
        }
        if(Mage::getDesign()->getArea() == 'adminhtml')
        {
            return true;
        }
        return false;
    }
}
