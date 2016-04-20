<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */

class Fishpig_Wordpress_Block_Sidebar_Widget_sgrcustomtaxonomies extends Fishpig_Wordpress_Block_Sidebar_Widget_Abstract
implements Mage_Widget_Block_Interface
{
        public function getTexonomyblog(){
            $texcat = array(array('By Disease or Illness','bydisease'),array('By Herb or Herbal Product','byherb'),array('By Category','bycat'));
            return $texcat;
        }
        public function getAnswers()
	{
		
			$table = Mage::helper('wordpress/database')->getTableName('posts');
			$sql = "SELECT COUNT(ID) AS post_count, CONCAT(SUBSTRING(post_date, 1, 4), '/', SUBSTRING(post_date, 6, 2)) as archive_date 
					FROM `" . $table . "` AS `main_table` WHERE (`main_table`.`post_type`='question') AND (`main_table`.`post_status` ='publish') 
					GROUP BY archive_date ORDER BY archive_date DESC";
					
			$dates = Mage::helper('wordpress/database')->getReadAdapter()->fetchAll($sql);
			$collection111  = new Varien_Data_Collection();
			
			foreach($dates as $date) {
				$obj = Mage::getModel('wordpress/archive')->load($date['archive_date']);
				$obj->setPostCount($date['post_count']);
				$collection111->addItem($obj);
				
			}

		
		return $collection111;
	}
        
        public function getCommentaries()
	{
		
			$table = Mage::helper('wordpress/database')->getTableName('posts');
			$sql = "SELECT COUNT(ID) AS post_count, CONCAT(SUBSTRING(post_date, 1, 4), '/', SUBSTRING(post_date, 6, 2)) as archive_date 
					FROM `" . $table . "` AS `main_table` WHERE (`main_table`.`post_type`='commentary') AND (`main_table`.`post_status` ='publish') 
					GROUP BY archive_date ORDER BY archive_date DESC";
					
			$dates = Mage::helper('wordpress/database')->getReadAdapter()->fetchAll($sql);
			$collection111  = new Varien_Data_Collection();
			
			foreach($dates as $date) {
				$obj = Mage::getModel('wordpress/archive')->load($date['archive_date']);
				$obj->setPostCount($date['post_count']);
				$collection111->addItem($obj);
			}

		
		return $collection111;
	}
        
        
        public function getVideos()
	{
		
			$table = Mage::helper('wordpress/database')->getTableName('posts');
			$sql = "SELECT COUNT(ID) AS post_count, CONCAT(SUBSTRING(post_date, 1, 4), '/', SUBSTRING(post_date, 6, 2)) as archive_date 
					FROM `" . $table . "` AS `main_table` WHERE (`main_table`.`post_type`='video') AND (`main_table`.`post_status` ='publish') 
					GROUP BY archive_date ORDER BY archive_date DESC";
					
			$dates = Mage::helper('wordpress/database')->getReadAdapter()->fetchAll($sql);
			$collection111  = new Varien_Data_Collection();
			
			foreach($dates as $date) {
				$obj = Mage::getModel('wordpress/archive')->load($date['archive_date']);
				$obj->setPostCount($date['post_count']);
				$collection111->addItem($obj);
			}

		
		return $collection111;
	}
        
        public function getAudio()
	{
		
			$table = Mage::helper('wordpress/database')->getTableName('posts');
			$sql = "SELECT COUNT(ID) AS post_count, CONCAT(SUBSTRING(post_date, 1, 4), '/', SUBSTRING(post_date, 6, 2)) as archive_date 
					FROM `" . $table . "` AS `main_table` WHERE (`main_table`.`post_type`='audio') AND (`main_table`.`post_status` ='publish') 
					GROUP BY archive_date ORDER BY archive_date DESC";
					
			$dates = Mage::helper('wordpress/database')->getReadAdapter()->fetchAll($sql);
			$collection111  = new Varien_Data_Collection();
			
			foreach($dates as $date) {
				$obj = Mage::getModel('wordpress/archive')->load($date['archive_date']);
				$obj->setPostCount($date['post_count']);
				$collection111->addItem($obj);
			}

		
		return $collection111;
	}
    
	public function getCategories($texname)
	{
		//if (!$this->hasCategories()) {
			//if ($this->getTaxonomy()) {
				$collection = Mage::getResourceModel('wordpress/term_collection')
					->addTaxonomyFilter($texname);

				$collection->getSelect()
					->reset('order')
					->order('name ASC');
			//}
			//else {
				//$collection = Mage::getResourceModel('wordpress/post_category_collection');
			//}
			
			$collection->addParentIdFilter($this->getParentId())
				->addHasObjectsFilter();

			$this->setCategories($collection);
		//}
		
		return $this->_getData('categories');
	}
	
	/**
	 * Returns the parent ID used to display categories
	 * If parent_id is not set, 0 will be returned and root categories displayed
	 *
	 * @return int
	 */
	public function getParentId()
	{
		return number_format($this->getData('parent_id'), 0, '', '');
	}
	
	/**
	 * Determine whether the category is the current category
	 *
	 * @param Fishpig_Wordpress_Model_Category $category
	 * @return bool
	 */
	public function isCurrentCategory($category)
	{
		if ($this->getCurrentCategory()) {
			return $category->getId() == $this->getCurrentCategory()->getId();
		}
		
		return false;
	}
	
	/**
	 * Retrieve the current category
	 *
	 * @return Fishpig_Wordpress_Model_Category
	 */
	public function getCurrentCategory()
	{
		if (!$this->hasCurrentCategory()) {
			$this->setCurrentCategory(Mage::registry('wordpress_category'));
		}
		
		return $this->getData('current_category');
	}
	
	/**
	 * Retrieve the default title
	 *
	 * @return string
	 */
	public function getDefaultTitle()
	{
		return $this->__('Blog Archives');
	}
	
	/**
	 * Set the posts collection
	 *
	 */
	protected function _beforeToHtml()
	{
		if (!$this->getTemplate()) {
			$this->setTemplate('wordpress/sidebar/widget/sgrcustomtaxonomies.phtml');
		}

		return parent::_beforeToHtml();
	}
        
        
}
