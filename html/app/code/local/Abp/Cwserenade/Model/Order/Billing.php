<?php

/**
 * Abp/CW billing
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Billing 
{

	/**
	 * Get billing address data for CW message
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return array NULL
	 */
	public function getMessageData($order)
	{
		$data = array();
		
		$billingAddress = $order->getBillingAddress();
		$data['soldToFname'] = $billingAddress->getFirstname();
		$data['soldToLname'] = $billingAddress->getLastname();
		$soldToAddress = $billingAddress->getStreet();
		$data['soldToAddress1'] = $soldToAddress[0];
		$data['soldToApartment'] = $soldToAddress[1];
		$data['soldToCity'] = $billingAddress->getCity();
        $region = Mage::getModel('directory/region')->load($billingAddress->getRegionId());
        if ($region->getId()){
        	$soldToState = $region->getCode();
        } else {
        	$soldToState = $billingAddress->getRegion();
        }
        $data['soldToState'] = $soldToState;
		$data['soldToZip'] = $billingAddress->getPostcode();
		$country = Mage::getModel('directory/country')->loadByCode($billingAddress->getCountry());
		$data['soldToCountry'] = $country->getIso3Code();
		$data['soldToEmail'] = $order->getCustomerEmail();
		$data['soldToDayPhone'] = $billingAddress->getTelephone();
		$data['soldToCompany'] = $billingAddress->getCompany();

		return $data;
	}
}