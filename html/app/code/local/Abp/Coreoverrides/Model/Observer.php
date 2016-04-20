<!-- LOCATION: app/code/local/Auriga/Editable/Model/Observer.php -->
 
<?php
 
class Inline_Editable_Model_Observer {
	public function core_block_abstract_prepare_layout_after_javascript_init($observer) {
		$block = $observer->getEvent()->getBlock();
		if (in_array($block->getRequest()->getControllerName(), $this->getControllerNames())) {
			if ($block instanceof Mage_Adminhtml_Block_Widget_Grid && $block->getId() == 'productGrid') {	 
				// Load required javascript grid modification.
				if ($block->getLayout()->getBlock('head')) {
					$block->getLayout()->getBlock('head')->addJs('editable/adminhtml_grid.js');
				}
			}

			if ($block instanceof Mage_Adminhtml_Block_Widget_Grid_Massaction 
			&& in_array($block->getRequest()->getControllerName(), $this->getControllerNames())){
				$block->addItem('mass_qty_update', array('label' => Mage::helper('core')->__('Update Quantity'),
				'url' => Mage::app()->getStore()->getUrl('*/editable/massQtyUpdate',
					array('actions' =>'mass_qty_update', '_secure' => $isSecure))
					));
 			}

		}
	}
 
	public function core_block_abstract_prepare_layout_after($observer) {
		$block = $observer->getEvent()->getBlock();
 
		if (in_array($block->getRequest()->getControllerName(), $this->getControllerNames())) {
			$isSecure = Mage::app()->getStore()->isCurrentlySecure() ? true : false;
 
			if ($block instanceof Mage_Adminhtml_Block_Widget_Grid && $block->getId() == 'productGrid') {
 
				// Add column to grid
 				$block->addColumn(
				'change_qty',
				array('header' => Mage::helper('editable')->__('Quantity'),
				'type' => 'text',
 				'sortable' => false,
 				'renderer' => 'Inline_Editable_Block_Adminhtml_Renderer_Quantity',
 				'filter' => 'Inline_Editable_Block_Adminhtml_Renderer_Quantity',
				'width' => 190)
				);

        $block->addColumn('bestseller',
            array(
                'header'=> Mage::helper('catalog')->__('Bestseller'),
                'width' => '80px',
                'type'  => 'input',
                'index' => 'bestseller',
                'align' => 'right',
            //  'options' => $bestseller_options,
                'renderer' => 'Inline_Editable_Block_Widget_Grid_Column_Renderer_Inline',
            //  'renderer'         => 'bestseller/adminhtml_widget_grid_column_renderer_inline',
            //  'editable' => 'true',
        ));

			}
		}
	}
 
	public function getControllerNames() {
		return array( 'adminhtml_catalog_product', 'catalog_product');
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
                'renderer' => 'Inline_Editable_Block_Widget_Grid_Column_Renderer_Inline',
            //  'renderer'         => 'bestseller/adminhtml_widget_grid_column_renderer_inline',
            //  'editable' => 'true',
        ));
}

?>