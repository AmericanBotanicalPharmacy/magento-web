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
 * @package     Mage_CatalogSearch
 * @copyright   Copyright (c) 2014 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

/**
 * Autocomplete queries list
 */
class Mage_CatalogSearch_Block_Autocomplete extends Mage_Core_Block_Abstract
{
    protected $_suggestData = null;
    protected $_resultData = null;

    protected function _toHtml()
    {
        $html = '';

        if (!$this->_beforeToHtml()) {
            return $html;
        }

        $resultData = $this->getSearchResultData();
        if (!($count = count($resultData))) {
            return $html;
        }

        $count--;

        $html = '<ul><li style="display:none"></li>';
        foreach ($resultData as $index => $item) {
            if ($index == 0) {
                $item['row_class'] .= ' first';
            }

            if ($index == $count) {
                $item['row_class'] .= ' last';
            }

            $html .= '<li title="'.$this->escapeHtml($item['name']).'" class="'.$item['row_class'].'">'
                .'<a href="'.$this->escapeHtml($item['url']).'" style="display: block; padding: 4px 6px;">'.'<span>'.$this->escapeHtml($item['name']).'</span>'
                .'<span style="'.'float: right;">'.$this->escapeHtml($item['price']).'</span>'.'</a>'.'</li>';
        }

        $html.= '</ul>';

        return $html;
    }

    public function getSuggestData()
    {
        if (!$this->_suggestData) {
            $collection = $this->helper('catalogsearch')->getSuggestCollection();
            $query = $this->helper('catalogsearch')->getQueryText();
            $counter = 0;
            $data = array();
            foreach ($collection as $item) {
                $_data = array(
                    'title' => $item->getQueryText(),
                    'row_class' => (++$counter)%2?'odd':'even',
                    'num_of_results' => $item->getNumResults()
                );

                if ($item->getQueryText() == $query) {
                    array_unshift($data, $_data);
                }
                else {
                    $data[] = $_data;
                }
            }
            $this->_suggestData = array_slice($data, 0, 10);
        }
        return $this->_suggestData;
    }

    public function getSearchResultData()
    {
        if (!$this->_resultData) {
            $searchText = Mage::helper('catalogsearch')->getQueryText();
            $searchEngine = Mage::getResourceModel( Mage::getStoreConfig('catalog/search/engine') );
            $collection = $searchEngine->getResultCollection();
            $collection->addSearchFilter($searchText);
            $collection->addAttributeToSelect('*');
            $collection->setPageSize(10);
            $collection->load();
            $counter = 0;
            $data = array();
            foreach ($collection as $item) {
                $_data = array(
                    'name' => $item->getName(),
                    'price' => number_format($item->getPrice(), 2),
                    'url' => $item->getProductUrl(),
                    'row_class' => (++$counter)%2?'odd':'even'
                );

                $data[] = $_data;
            }
            $this->_resultData = $data;
        }
        return $this->_resultData;
    }
/*
 *
*/
}
