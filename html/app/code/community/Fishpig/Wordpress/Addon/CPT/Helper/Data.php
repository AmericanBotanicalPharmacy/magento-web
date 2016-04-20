<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
 
class Fishpig_Wordpress_Addon_CPT_Helper_Data extends Fishpig_Wordpress_Helper_Abstract
{
	/**
	 * Preload the post type
	 *
	 * @return void
	 */
	public function __construct()
	{
		if (!$this->_isCached('post_types')) {
			$items = (array)unserialize(Mage::getStoreConfig('wordpress/custom_post_types/types'));
			$types = array();

			foreach($items as $item) {
				$types[$item['type']] = Mage::getModel('wp_addon_cpt/type')->setData($item);
			}
			
			$this->_cache('post_types', $types);
		}
		
		return $this->_cached('post_types');
	}
	
	/**
	 * Retrieve an array of post type models
	 *
	 * @return array
	 */
	public function getPostTypes()
	{
		if (false) {
			$tunnel = Mage::helper('wordpress/tunnel');
			
			if ($tunnel->isTunnelActive()) {
				return $tunnel->getPostTypes(array(
					'public' => true,
					'_builtin' => false
				));
			}
		}

		return $this->_cached('post_types');
	}
	
	/**
	 * Retrieve a single post type
	 *
	 * @param string $postType
	 * @return Fishpig_Wordpress_Addon_CPT_Model_Type
	 */
	public function getPostType($postType)
	{
		foreach($this->getPostTypes() as $type) {
			if ($type->getPostType() === $postType) {
				return $type;
			}
		}
		
		return false;
	}
	
	/**
	 * Retrieve a single post type by it's slug
	 *
	 * @param string $postType
	 * @return Fishpig_Wordpress_Addon_CPT_Model_Type
	 */
	public function getPostTypeBySlug($slug)
	{
		foreach($this->getPostTypes() as $type) {
			if ($type->getSlug() === $slug) {
				return $type;
			}
		}

		return false;
	}

	/**
	 * Get a post based on it's URI
	 *
	 * @param string $uri
	 * @return false|Fishpig_Wordpress_Model_Post
	 */
	public function getPostByUri($uri)
	{
		if (strpos($uri, '/') === false) {
			return false;
		}

		$uriParts = explode('/', $uri);
		
		if (count($uriParts) !== 2) {
			return false;
		}
		
		if (($type = $this->getPostTypeBySlug($uriParts[0])) === false) {
			return false;
		}

		$posts = Mage::getResourceModel('wordpress/post_collection')
			->addIsPublishedFilter()
			->addPostTypeFilter($type['type'])
			->setPageSize(1)
			->addFieldToFilter('post_name', $uriParts[1])
			->load();

		if (count($posts) > 0) {
			return $posts->getFirstItem();
		}
		
		return false;
	}
}
