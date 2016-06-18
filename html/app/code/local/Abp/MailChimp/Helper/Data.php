<?php

/**
 * Abp_Mailchimp helper
 *
 * @category    Abp
 * @package     Abp_Mailchimp
 * @author      Edward Yang <yushine999@gmail.com>
 */
class Abp_Mailchimp_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'mailchimp/general/enabled';

    const XML_PATH_API_KEY = 'mailchimp/general/api_key';

    const XML_PATH_LIST_ID = 'mailchimp/general/list_id';

    /**
     * Retrieve configuration value for enabled of catalog event
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, Mage::app()->getStore());
    }

    /**
     * Retrieve configuration value for enabled of catalog event
     *
     * @return boolean
     */
    public function apiKey()
    {
        return Mage::getStoreConfig(self::XML_PATH_API_KEY, Mage::app()->getStore());
    }

    /**
     * Retrieve configuration value for enabled of catalog event
     *
     * @return boolean
     */
    public function listId()
    {
        return Mage::getStoreConfig(self::XML_PATH_LIST_ID, Mage::app()->getStore());
    }
}
