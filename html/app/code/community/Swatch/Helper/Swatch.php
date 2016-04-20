<?php

class Aydus_Swatch_Helper_Swatch extends Mage_Core_Helper_Abstract
{
    public function makeSafe($name)
    {
        if ($name) {
            $name = strtolower($name);
            $name = str_replace(' ', '-', $name);
        }
        return $name;
    }
}