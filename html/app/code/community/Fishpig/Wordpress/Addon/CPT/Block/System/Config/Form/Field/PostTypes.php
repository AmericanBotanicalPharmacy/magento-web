<?php
/**
 * @category  Fishpig
 * @package  Fishpig_Wordpress
 * @license    http://fishpig.co.uk/license.txt
 * @author    Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Addon_CPT_Block_System_Config_Form_Field_PostTypes extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
	/**
	 * Retrieve the rendering block class for the type field
	 *
	 * @return Mage_Core_Block_Abstract
	 */
	public function getTypeRenderer()
	{
		if (!$this->hasTypeRenderer()) {
			$this->setTypeRenderer(
				$this->getLayout()->createBlock('wp_addon_cpt/system_config_form_field_select', '', array('is_render_to_js_template' => true))
					->setClass('select')
					->setExtraParams('min-width:120px;width:96%;')
			);
		}
		
		return $this->_getData('type_renderer');
	}
	
	/**
	 * Prepare to render
	 *
	 * @return void
	*/
	protected function _prepareToRender()
	{
		$this->addColumn('type', array(
			'label' => $this->__('Type'),
			'renderer' => $this->getTypeRenderer(),
		));
		
		$this->addColumn('name', array(
			'label' => $this->__('Name'),
			'style' => 'min-width: 120px; width: 96%;',
		));
		
		$this->addColumn('slug', array(
			'label' => $this->__('Rewrite Slug'),
			'style' => 'min-width: 120px; width: 96%;',
		));
		
		$this->addColumn('template_list', array(
			'label' => $this->__('Template (List)'),
			'style' => 'min-width: 120px; width: 96%;',
		));
		
		$this->addColumn('template_view', array(
			'label' => $this->__('Template (View)'),
			'style' => 'min-width: 120px;width: 96%;',
		));

		$this->_addAfter = false;
		$this->_addButtonLabel = $this->__('Add');
	}
    
    
    /**
     * Prepare existing row data object
     *
     * @param Varien_Object
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
			'option_extra_attr_' . $this->getTypeRenderer()->calcOptionHash($row->getData('type')),
            'selected="selected"'
        );
    }
}
