<?php

class Collinsharper_Paymentech_Block_Info_Paymentech extends Mage_Payment_Block_Info_Cc
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('chpaymentech/info/paymentech.phtml');
    }

    public function getAvsStatusMessage()
    {
        $avsStatus = trim($this->getInfo()->getCcAvsStatus());

        $statuses = array(
            '1' =>  'No address supplied',
            '2' =>  'Bill-to address did not pass Auth Host edit checks',
            '3' =>  'AVS not performed',
            '4' =>  'Issuer does not participate in AVS',
            '5' =>  'Edit-error - AVS data is invalid',
            '6' =>  'System unavailable or time-out',
            '7' =>  'Address information unavailable',
            '8' =>  'Transaction Ineligible for AVS',
            '9' =>  'Zip Match/Zip4 Match/Locale match',
            'A' =>  'Zip Match/Zip 4 Match/Locale no match',
            'B' =>  'Zip Match/Zip 4 no Match/Locale match',
            'C' =>  'Zip Match/Zip 4 no Match/Locale no match',
            'D' =>  'Zip No Match/Zip 4 Match/Locale match',
            'E' =>  'Zip No Match/Zip 4 Match/Locale no match',
            'F' =>  'Zip No Match/Zip 4 No Match/Locale match',
            'G' =>  'No match at all',
            'H' =>  'Zip Match/Locale match',
            'J' =>  'Issuer does not participate in Global AVS',
            'JA' => 'International street address and postal match',
            'JB' => 'International street address match. Postal code not verified.',
            'JC' => 'International street address and postal code not verified.',
            'JD' => 'International postal code match. Street address not verified.',
            'M1' => 'Cardholder name matches',
            'M2' => 'Cardholder name, billing address, and postal code matches',
            'M3' => 'Cardholder name and billing code matches',
            'M4' => 'Cardholder name and billing address match',
            'M5' => 'Cardholder name incorrect, billing address and postal code match',
            'M6' => 'Cardholder name incorrect, billing postal code matches',
            'M7' => 'Cardholder name incorrect, billing address matches',
            'M8' => 'Cardholder name, billing address and postal code are all incorrect',
            'N3' => 'Address matches, ZIP not verified.',
            'N4' => 'Address and ZIP code not verified due to incompatible formats',
            'N5' => 'Address and ZIP code match (International only)',
            'N6' => 'Address not verified (International only)',
            'N7' => 'ZIP matches, address not verified',
            'N8' => 'Address and ZIP code match (International only)',
            'N9' => 'Address and ZIP code match (UK only)',
            'R'  => 'Issuer does not participate in AVS',
            'UK' => 'Unknown',
            'X'  => 'Zip Match/Zip 4 Match/Address Match',
            'Z'  => 'Zip Match/Locale no match'
        );

        if (isset($statuses[$avsStatus])) {
            return $statuses[$avsStatus];
        }

        return 'Not applicable';
    }

    public function getCvvStatusMessage()
    {
        $cvvStatus = trim($this->getInfo()->getCcCidStatus());

        $statuses = array(
            'M' => 'Match',
            'N' => 'No match',
            'P' => 'Not processed',
            'S' => 'Should have been present',
            'U' => 'Unsupported by issuer/Issuer unable to process request',
            'I' => 'Invalid'
        );

        if (isset($statuses[$cvvStatus])) {
            return $statuses[$cvvStatus];
        }
        return 'Not applicable';
    }
}
