<?php
class Emizen_Postlayoutupdate_Model_Observer
{

			public function UpdateLayout(Varien_Event_Observer $observer)
			{
				if(Mage::app()->getRequest()->getControllerName() == "post" && Mage::app()->getRequest()->getActionName() == "view" &&  Mage::app()->getRequest()->getRouteName() == "wordpress")
                                {
                                    $collection = Mage::getResourceModel('wordpress/post_collection')->setOrderByPostDate("DESC");

                                    if (Mage::getSingleton('customer/session')->isLoggedIn() && Mage::helper('wordpress')->isAddonInstalled('CS')) {
                                            $collection->addStatusFilter(array('publish', 'private'));
                                    }
                                    else {
                                            $collection->addStatusFilter('publish');
                                    }
	

                                $tag = "Books";
				$collection->addTermFilter($tag, 'bookcategory', 'name');

                                

                            $collection->addPostTypeFilter('book');
                            $bookIds = array();
                                foreach($collection->getData() as $dataIds)
                                {
                                    
                                    $bookIds[] = $dataIds['ID'] ;
                                }
			
                                    $id = Mage::app()->getRequest()->getParam('id');
                                    if(in_array($id,$bookIds))
                                    {
                                       
                                        $layout = $observer->getEvent()->getLayout()->getBlock('root')->setTemplate('page/1column.phtml');;
                                        
                                        return $this;
                                        
                                    }
                                }

			}
		
}
