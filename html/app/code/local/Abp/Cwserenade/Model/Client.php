<?php

/**
 * Order model
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Client extends Mage_Core_Model_Abstract
{
	/**
	 * resources
	 */
	protected $_client;
	
	/**
	 * API url and creds
	 */
	protected $_url = '';
	protected $_username = ''; 
	protected $_password = '';
	
	/**
	 * Init connection 
	 */
	public function _construct()
	{		
		$this->_url = Mage::getStoreConfig('abp_cwserenade/configuration/url');
		$this->_username = Mage::getStoreConfig('abp_cwserenade/configuration/username');
		$this->_password = Mage::getStoreConfig('abp_cwserenade/configuration/password');
		
		$this->_connect();
	}
	    
    protected function _connect()
    {
    	$options = array(
    			"cache_wsdl" => WSDL_CACHE_NONE,
    			"soap_version" => SOAP_1_1,
    			"trace" => 1,
    			//"proxy_host" => "localhost",
    			//"proxy_port" => 8888,
    	);
    	
    	$this->_client = new SoapClient($this->_url, $options);
    	$sessionId = $this->_client->login($username, $password);    	
    }
    
}