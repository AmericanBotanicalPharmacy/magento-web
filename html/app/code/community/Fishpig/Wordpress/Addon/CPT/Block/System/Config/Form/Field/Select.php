<?php
/**
 * @category  Fishpig
 * @package  Fishpig_Wordpress
 * @license    http://fishpig.co.uk/license.txt
 * @author    Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_CPT_Block_System_Config_Form_Field_Select extends Mage_Core_Block_Html_Select
{
	/**
	 * Set the input name
	 *
	 * @param string $name
	 * @return $this
	 */
	public function setInputName($name)
	{
		return $this->setName($name);
	}

    /**
     * Render block HTML
     *
     * @return string
     */
    public function _toHtml()
    {
        if (!$this->getOptions()) {
        	$this->setOptions(
				Mage::getSingleton('wordpress/system_config_source_post_type')->toOptionArray()
			);
        }
        
        return parent::_toHtml();
    }
}
