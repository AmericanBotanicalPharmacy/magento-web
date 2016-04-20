<?php
/**
 * Class Aydus_SingleProduct_Block_Product
 *
 * Example Usage: {{block type="aydus_singleproduct/product" product_id="123456" template="path/to/your/template.phtml"}}
 */
class Aydus_SingleProduct_Block_Product
    extends Mage_Core_Block_Template
{
    /**
     * @var bool|Mage_Catalog_Model_Product Lazy loaded product object.
     */
    protected $_product = false;

    /**
     * Retrieve the product, lazy load if necessary.
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct() {
        if(!$this->_product) {
            $this->_product = Mage::getModel('catalog/product')->load($this->getProductId());
            if(!$this->_product->getId()) {
                Mage::throwException('Invalid Product');
            }
        }

        return $this->_product;
    }

    /**
     * Retrieve add to cart URL
     *
     * @return string
     */
    public function getAddToCartUrl() {
        $addUrlKey = Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED;
        $addUrlValue = Mage::getUrl('*/*/*', array('_use_rewrite' => true, '_current' => true));
        $additional[$addUrlKey] = Mage::helper('core')->urlEncode($addUrlValue);

        return $this->helper('checkout/cart')->getAddUrl($this->getProduct(), $additional);
    }
}