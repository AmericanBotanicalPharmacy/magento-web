<?php
class Aydus_FeaturedProducts_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        // Load and render layout html.
        $this->loadLayout()->renderLayout();
    }
}