<?php

/**
 * Customer extend
 *
 * @category    Abp
 * @package     Abp_Oscommerce
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Oscommerce_Model_Customer extends Mage_Customer_Model_Customer
{
	
	/**
	 * Match password of logging in customer with imported oscommerce password
	 *
	 * @param string $password
	 * @return boolean
	 */
	public function validatePassword($password)
	{
		$resource = Mage::getSingleton('core/resource');
		$read = $resource->getConnection('core_read');
		
		//get md5 password from import table
		$customerId = (int)$this->getId();
		$readSql = "SELECT password FROM {$resource->getTableName('abp_oscommerce_customers')} WHERE customer_id = '{$customerId}' AND updated = 0";
		$md5Password = $read->fetchOne($readSql);
		
		if ($md5Password && md5($password) == $md5Password){
						
			//update import table and customer's password
			try {
				
				$this->setPassword($password);
				$this->setConfirmation($password);
				$this->save();
				
				$write = $resource->getConnection('core_write');
				$updatedAt = date('Y-m-d H:i:s');
				$writeSql = "UPDATE {$resource->getTableName('abp_oscommerce_customers')} SET updated = 1, updated_at = '$updatedAt' WHERE customer_id = '{$customerId}'";
				$write->query($writeSql);
				
			} catch (Mage_Core_Exception $e) {
				
                Mage::getSingleton('customer/session')->setCustomerFormData(Mage::app()->getRequest()->getPost())
                    ->addError($e->getMessage());
                    
                return false;
                
            } catch (Exception $e) {
            	
                Mage::getSingleton('customer/session')->setCustomerFormData(Mage::app()->getRequest()->getPost())
                    ->addException($e, $this->__('Cannot save the customer.'));
                    
                return false;
            }
			
			return true;
			
		} else {
			
			return parent::validatePassword($password);
			
		}
	}
		
}