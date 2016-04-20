<?php

/**
 * Abp/CW shipping
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_Shipping 
{

	/**
	 * Get shipping address data for CW message
	 * 
	 * @param Mage_Sales_Model_Order $order
	 * @return array
	 */
	public function getMessageData($order)
	{
		$data = array();
		$shippingAddress = $order->getShippingAddress();
		
		$data['shipToFname'] = $shippingAddress->getFirstname();
		$data['shipToLname'] = $shippingAddress->getLastname();
		$shipToAddress = $shippingAddress->getStreet();
		$data['shipToAddress1'] = $shipToAddress[0];
		$data['shipToApartment'] = $shipToAddress[1];
		$data['shipToCity'] = $shippingAddress->getCity();
		// $data['shipToState'] = $shippingAddress->getRegion();
		$region = Mage::getModel('directory/region')->load($shippingAddress->getRegionId());
        if ($region->getId()){
        	$shipToState = $region->getCode();
        } else {
        	$shipToState = $shippingAddress->getRegion();
        }
        $data['shipToState'] = $shipToState;
		$data['shipToZip'] = $shippingAddress->getPostcode();
		$country = Mage::getModel('directory/country')->loadByCode($shippingAddress->getCountry());
		$data['shipToCountry']= $country->getIso3Code();
		$data['shipToCompany'] = $shippingAddress->getCompany();	

		return $data;
	}

}