<!-- LOCATION: app/code/local/Inline/Editable/Block/Adminhtml/Renderer/Quantity.php -->
 
<?php
class Inline_Editable_Block_Adminhtml_Renderer_Quantity 
extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Select { 

	public function render(Varien_Object $row) {
		$colId = 'qty';
		$productId = $row->getEntityId();
		$product=Mage::getModel('catalog/product')->load($productId); 
		$html = '<input name="' . $colId . '-' . $row->getId() . '" rel="' . $row->getId() . '" class="input-text ' . $colId . '" 
		value="' . (int) $product->stockItem->getQty() . '" style="width:97%;" />';
		return $html; 
	}

    Public function getQty() {
        echo "1";
        $qtyies=explode(",", Mage::app()->getRequest()->getPost('qties', false));
        
        foreach ($qtyies as $rawQty) {
         
            if ($rawQty == '') { 
                continue;
            }
         
            list($productId, $qty) = explode("[|]", $rawQty);
           
            if (!empty($productId)) { 
                $qtyArray[$productId] = $qty;
            }
        }
        return $qtyArray;
    }

}
?>