<?php
class Aydus_Paypal_Model_Config extends Mage_Paypal_Model_Config
{
 
    /**
     * BN code getter
     * override method
     *
     * @param string $countryCode ISO 3166-1
     */
    public function getBuildNotationCode($countryCode = null)
    {
        if(Mage::getEdition() == Mage::EDITION_ENTERPRISE) {
            return "AydusConsulting_SI_MagentoEE";
        } else {
            return "AydusConsulting_SI_MagentoCE";
        }
    }
 
}