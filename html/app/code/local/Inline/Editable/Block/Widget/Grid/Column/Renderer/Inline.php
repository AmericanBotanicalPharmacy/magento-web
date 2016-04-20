<?php
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

class Inline_Editable_Block_Widget_Grid_Column_Renderer_Inline
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


class Inline_Editable_Block_Catalog_Product_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

        $this->addColumn('bestseller',
            array(
                'header'=> Mage::helper('catalog')->__('Bestseller'),
                'width' => '80px',
                'type'  => 'input',
                'index' => 'bestseller',
                'align' => 'right',
            //  'options' => $bestseller_options,
                'renderer' => 'editable/Inline_Editable_Block_Widget_Grid_Column_Renderer_Inline',
            //  'renderer'         => 'bestseller/adminhtml_widget_grid_column_renderer_inline',
            //  'editable' => 'true',
        ));
}
    