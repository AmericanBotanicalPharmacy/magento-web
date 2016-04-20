<?php
/**
 * @category    Fishpig
 * @package     Fishpig_Wordpress
 * @license     http://fishpig.co.uk/license.txt
 * @author      Ben Tideswell <help@fishpig.co.uk>
 */
 
class Fishpig_Wordpress_Addon_CPT_Model_Observer extends Varien_Object
{
	/**
	 * Retrieve the extension helper
	 *
	 * @return Fishpig_Wordpress_Addon_CPT_Helper_Data
	 */
	protected function _getHelper()
	{
		return Mage::helper('wp_addon_cpt');
	}
	
	/**
	 * Attempt to match a WP route to a custom post type
	 *
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 */
	public function matchRoutesObserver(Varien_Event_Observer $observer)
	{
		$observer->getEvent()
			->getRouter()
				->addRouteCallback(array($this, 'getRoutes'));
		
		return $this;
	}
	
	/**
	 * Generate routes based on $uri
	 *
	 * @param string $uri = ''
	 * @return $this
	 */
	public function getRoutes($uri = '')
	{
		$router = Mage::app()->getFrontController()->getRouter('wordpress');

		if ($postTypes = $this->_getHelper()->getPostTypes()) {
			foreach($postTypes as $postType) {
				if (strpos($uri, $postType->getSlug()) !== 0) {
					continue;
				}
				
				if (strlen($uri) !== strlen($postType->getSlug()) && substr($uri, strlen($postType->getSlug()), 1) !== '/') {
					continue;
				}

				$prefix = $postType->getSlug();
				$slug = trim(substr($uri, strlen($postType->getSlug())), '/');

				if (!$slug) {
					$router->addRoute(array('/^(' . preg_quote($postType->getSlug(), '/') . ')$/' => array('slug')), 'wp_addon_cpt/index/view');
				}
				else {
					$post = Mage::getModel('wordpress/post')
						->setPostType($postType->getPostType())
						->load($slug, 'post_name');
					
					if ($post->getId()) {
						Mage::register('wordpress_post', $post);

						$router->addRoute($prefix . '/' . $post->getPostName(), '*/post/view', array('id' => $post->getId()));
					}
				}
			}
		}

		return $this;
	}
	
	/**
	 * Add custom post types to the collection
	 *
	 * @param Varien_Event_Observer $observer
	 * @return void
	 */
	public function postCollectionLoadBeforeObserver(Varien_Event_Observer $observer)
	{
		$posts = $observer
			->getEvent()
				->getPosts();
		
		if ($posts->hasPostTypeFilter()) {
			return $this;
		}
		
		if ($posts->getFlag('include_all_post_types') !== true && get_class($posts->getFlag('source')) !== 'Fishpig_Wordpress_Model_Term') {
			return $this;
		}

		if ($postTypes = $this->getPostTypesArray()) {
			if (count($postTypes) > 0) {
				$posts->addPostTypeFilter(array_merge(array('post'), array_keys($postTypes)));
			}
		}
		
		return $this;
	}
	
	/**
	 * Add the URL to posts with custom post types
	 *
	 * @param Varien_Event_Observer $observer
	 * @return void
	 */
	public function addDataToPostCollectionObserver(Varien_Event_Observer $observer)
	{
		try {
			if (($types = $this->getPostTypesArray()) !== false) {
				$collection = $observer->getEvent()->getPosts();
	
				foreach($collection as $post) {
					if (($type = $this->_getHelper()->getPostType($post->getPostType())) !== false) {
						$this->prepareCustomPost($post, $type);
					}
				}
			}
		}
		catch (Exception $e) {
			Mage::helper('wordpress')->log($e);
		}
	}

	/**
	 * Add the URL to a post if it has a custom type
	 *
	 * @param Varien_Event_Observer $observer
	 * @return void
	 */
	public function addDataToPostObserver(Varien_Event_Observer $observer)
	{
		try {
			if (($types = $this->getPostTypesArray()) !== false) {
				$post = $observer->getEvent()->getPost();
				$helper = Mage::helper('wordpress');
				
				if (isset($types[$post->getPostType()])) {
					$this->prepareCustomPost($post, $types[$post->getPostType()]);
				}
			}
		}
		catch (Exception $e) {
			Mage::helper('wordpress')->log($e);
		}
	}
	
	/**
	 * Prepare a custom post
	 *
	 * @param Fishpig_Wordpress_Model_Post_Abstract
	 * @param Fishpig_Wordpress_Addon_CPT_Model_Type $type
	 * @return $this
	 */
	public function prepareCustomPost($post, $type)
	{
		if ($post->getPostType() === $type->getPostType()) {
			$post->setUrl(Mage::helper('wordpress')->getUrl($type->getSlug() . '/' . $post->getPostName() . '/'));
			$post->setPostListTemplate($type->getPostListTemplate());
			$post->setPostViewTemplate($type->getPostViewTemplate());
		}

		return $this;		
	}
	
	/**
	 * Retrieve an array of custom post types for this store
	 *
	 * @return array|false
	 */
	public function getPostTypesArray()
	{
		return $this->_getHelper()->getPostTypes();		
	}
	
	/**
	 * Add custom post types to association collections
	 *
	 * @param Varien_Event_Observer $observer
	 * @return $this
	 */
	public function wordpressAssociationPostCollectionLoadBeforeObserver(Varien_Event_Observer $observer)
	{
		$posts = $observer
			->getEvent()
				->getCollection();

		if ($posts && $postTypes = $this->getPostTypesArray()) {
			if (count($postTypes) > 0) {
				$postTypes = array_merge(array('post'), array_keys($postTypes));

				$posts->addPostTypeFilter($postTypes);

				$grid = $observer
					->getEvent()
						->getGrid();
				
				if ($grid) {
					$grid->addColumnAfter('post_type', array(
						'header'=> 'Type',
						'index' => 'post_type',
						'type' => 'options',
						'options' => array_combine($postTypes, $postTypes),
					), 'post_title');
					
					$grid->sortColumnsByOrder();
				}
			}
		}
		
		return $this;
	}
}
