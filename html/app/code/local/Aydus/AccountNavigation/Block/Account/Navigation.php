<?php

/**
 * adds removeLinkByName function to Navigation class, for use from a layout.xml file
 */
class Aydus_AccountNavigation_Block_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
	protected $_linkOrders;
	
	
    /**
     * Removes link by name
     *
     * @param string $name
     * @return Mage_Page_Block_Template_Links
     */
    public function removeLinkByName($name)
    {
        foreach ($this->_links as $k => $v) {
            if ($v->getName() == $name) {
                unset($this->_links[$k]);
            }
        }

        return $this;
    }
    
    public function setLinkOrder($link, $order)
    {
    	$this->_linkOrders[$link] = $order;
    	
        return $this;
    }
    
    public function _toHtml()
    {
    	if (is_array($this->_linkOrders) && count($this->_linkOrders)>0){
    		
    		$reorderedLinks;
    		
    		foreach ($this->_linkOrders as $link=>$order){
    			$reorderedLinks[$order] = $this->_links[$link];
    		}
    		
    		$this->_links = $reorderedLinks;
    	}

    	return parent::_toHtml();
    }
}