<?php

class Aydus_AjaxCms_BlockController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {

        $html = '';

        try {
            $identifier = $this->getRequest()->getParam('identifier');
            if (strlen($identifier) > 0) {
                $html = $this->getLayout()->createBlock('cms/block')->setBlockId($identifier)->toHtml();
            }
        }
        catch(Exception $e) {}

        $this->getResponse()->setBody($html);
    }
}