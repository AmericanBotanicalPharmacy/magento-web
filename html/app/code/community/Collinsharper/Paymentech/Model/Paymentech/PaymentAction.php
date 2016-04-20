<?php


class Collinsharper_Paymentech_Model_Paymentech_PaymentAction
{
	public function toOptionArray()
	{
		return array(
			array(
				'value' => Mage_Paygate_Model_Authorizenet::ACTION_AUTHORIZE_CAPTURE, 
				'label' => Mage::helper('paygate')->__('Authorise and Capture')
			),
			array(
				'value' => Mage_Paygate_Model_Authorizenet::ACTION_AUTHORIZE, 
				'label' => Mage::helper('paygate')->__('Authorise')
			)
		);
	}
}