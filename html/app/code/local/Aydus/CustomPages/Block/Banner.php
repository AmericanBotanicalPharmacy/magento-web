<?php
class Aydus_CustomPages_Block_Banner
    extends Mage_Core_Block_Template
{
    public function getPageHeaderText() {
        return Mage::getSingleton('cms/page')->getContentHeading();
    }
}