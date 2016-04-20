<?php
class Aydus_Addtocart_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        // Get ajax parameters.
        $productId = $this->getRequest()->getParam('product_id', false);
        $qty = $this->getRequest()->getParam('qty', false);
        $message = $this->getRequest()->getParam('message', false);

        // Pass parameters into model (for use in block/layout). Use singleton to preserve values.
        $addToCart = Mage::getSingleton('aydus_addtocart/addtocart');
        $addToCart->setData('product_id', $productId);
        $addToCart->setData('qty', $qty);
        $addToCart->setData('message', $message);

        // Load and render layout html.
        $this->loadLayout()->renderLayout();
    }
}