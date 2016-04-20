<?php

/**
 * BannerEnhanced observers
 * 
 * @category    Aydus
 * @package     Aydus_BannerEnhanced
 * @author 		Aydus <davidt@aydus.com>
 */

class Aydus_BannerEnhanced_Model_Observer extends Mage_Core_Model_Abstract
{
	protected $_resource;
	protected $_read;
	protected $_write;
	
	public function _construct()
	{
		$this->_resource = Mage::getSingleton('core/resource');
		$this->_read = $this->_resource->getConnection('core_read');
		$this->_write = $this->_resource->getConnection('core_write');
	}
	
	/**
	 * Add position field to banner properties form
	 * 
     * @param Varien_Event_Observer $observer
     * @return Varien_Event_Observer
	 */
	public function addBannerPositionField($observer)
	{
		$form = $observer->getForm();
		$model = $observer->getModel();
		
		$fieldset = $form->getElement('base_fieldset');
		
		$fieldset->addField('position', 'text', array(
				'label'     => Mage::helper('bannerenhanced')->__('Banner Position'),
				'name'      => 'position',
				'required'  => false,
		));
		
		$bannerId = $model->getId();
		$query = "SELECT position FROM {$this->_resource->getTableName('aydus_bannerenhanced_position')} WHERE banner_id = '$bannerId'";
		$position = (int)$this->_read->fetchOne($query);
		
		if ($position){
				
			$data = $model->getData();
			$data['position'] = $position;
			
			$model->setData($data);
			$observer->setModel($model);
		}
		
		return $observer;
	}

	/**
	 *	Save banner position on model save 
	 *
	 * @param Varien_Event_Observer $observer
	 * @return Aydus_BannerEnhanced_Model_Observer
	 */	
	public function saveBannerPosition($observer)
	{
		$dataObject = $observer->getDataObject();
		$bannerId = (int)$dataObject->getBannerId();
		$position = (int)$dataObject->getPosition();
		
		if ($bannerId && $position){
			$query = "REPLACE INTO {$this->_resource->getTableName('aydus_bannerenhanced_position')} (banner_id, position) VALUES('$bannerId','$position')";
			$this->_write->query($query);
		}
				
		return $this;
	}
}