<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Grid input inline column renderer
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author     Dbond <dbond@herbdoc.com>
 */
/*
class Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Inline
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Input
{
    public function render(Varien_Object $row)
    {
     
        $html = parent::render($row);
 
        $html .= '<button onclick="updateField(this, '. $row->getId() .'); return false">' . Mage::helper('catalog')->__('Update') . '</button>';
 
        return $html;
    }
 
}
*/

class Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Inline
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Input
{
	public function render(Varien_Object $row)
    {
    /*
        $html = '<input type="text" ';
        $html .= 'name="' . $this->getColumn()->getId() . '" ';
        $html .= 'value="' . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'class="validate-number input-text ' . $this->getColumn()->getInlineCss() . '" onblur="updateField(this, '. $row->getId() .'); return false"/>';
    */
        $html = parent::render($row);
        $html .= '<button onclick="updateField(this, '. $row->getId() .'); return false">' . Mage::helper('catalog')->__('Update') . '</button>';
 
        return $html;
    }

    public function updateFieldAction()
    {
        $fieldId = (int) $this->getRequest()->getParam('id');
        $title = $this->getRequest()->getParam('bestseller');
        if ($fieldId) {
            $model = Mage::getModel('modulename/model')->load($fieldId);
            $model->setTitle($title);
            $model->save();
        }
    }

}    