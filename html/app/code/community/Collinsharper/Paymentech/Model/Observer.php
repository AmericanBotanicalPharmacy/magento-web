<?php

class Collinsharper_Paymentech_Model_Observer
{
	public function license($observer)
	{
		Mage::helper('chpaymentech/processor')->validLicense();
		return $this;
	}
}