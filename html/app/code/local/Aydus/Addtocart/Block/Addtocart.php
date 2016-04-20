<?php

class Aydus_Addtocart_Block_Addtocart extends Mage_Core_Block_Template
{
    protected function _prepareLayout()
    {
        // Get model data (as set in controller). Important: use singleton to get single instance with data (not new blank instead with getModel).
        $this->setAddToCart(Mage::getSingleton('aydus_addtocart/addtocart'));
    }
}