<?php
class Inline_Editable_Adminhtml_EditableController extends Mage_Adminhtml_Controller_Action {

	public function massQtyUpdateAction()

	{

		$productIds = $this->getRequest()->getParam('product');

		$qtyArray=$this->getQty();

		if (!is_array($productIds)) {

			$this->_getSession()->addError($this->__('Please select product(s).'));

		} else {

			if (!empty($productIds)) {

				try {

					foreach ($productIds as $productId) {

						if($qtyArray[$productId]){

							$product = Mage::getSingleton('catalog/product')->load($productId);

							$stockData['qty'] =$qtyArray[$productId];

							$product->setStockData($stockData);

							$product->save();

						}

					}

					$this->_getSession()->addSuccess(

						$this->__('Total of %d record(s) have been updated.', count($productIds))

					);

				} catch (Exception $e) {

					$this->_getSession()->addError($e->getMessage());

				}

			}

		}

		$this->_redirect('/catalog_product/index');

	}

	public function getQty()

	{

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