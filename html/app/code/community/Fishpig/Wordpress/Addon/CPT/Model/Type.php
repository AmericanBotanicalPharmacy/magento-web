<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
 
class Fishpig_Wordpress_Addon_CPT_Model_Type extends Mage_Core_Model_Abstract
{
	/**
	 * Retrieve the URL to the cpt page
	 *
	 * @return string
	 */
	public function getUrl()
	{
		return Mage::helper('wordpress')->getUrl($this->getSlug());
	}
	
	/**
	 * Retrieve the post type
	 *
	 * @return string
	 */
	public function getPostType()
	{
		return $this->getType();
	}
	
	/**
	 * Retrieve the post collection for this post type
	 *
	 * @return Fishpig_Wordpress_Model_Resource_Post_Collection
	 */
	public function getPostCollection()
	{
		if (!$this->hasPostCollection()) {
			$this->setPostCollection(
				Mage::getResourceModel('wordpress/post_collection')->addPostTypeFilter($this->getPostType())
			);
		}	
		
		return $this->_getData('post_collection');	
	}
	
	/**
	 * Get the post list template for this post type
	 *
	 * @return string
	 */
	public function getPostListTemplate()
	{
		return $this->getTemplateList();
	}

	/**
	 * Get the post view template for this post type
	 *
	 * @return string
	 */
	public function getPostViewTemplate()
	{
		return $this->getTemplateView();
	}
}
