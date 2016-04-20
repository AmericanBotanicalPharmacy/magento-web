<?php

/**
 * Abp_Cwserenade shell
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

require_once 'abstract.php';

class Abp_Shell_Cwserenade extends Mage_Shell_Abstract
{
    protected $_argname = array();
    
    public function __construct() 
    {
        parent::__construct();

        set_time_limit(0);

        if($this->getArg('argname')) {
            $this->_argname = array_merge(
                $this->_argname,
                array_map(
                    'trim',
                    explode(',', $this->getArg('argname'))
                )
            );
        }
    }
    
    public function run()
    {
		$action = $this->getArg('action');
		if (method_exists($this, $action)){
			try {
				
				$this->$action();
				
			} catch (Exception $e) {
				
                echo $e->getMessage() . "\n";
            } 
            
		} else {
			
			echo "No such action.\n";
			echo $this->usageHelp();
			
		}
    		 
    }
    
    public function restartVpn() 
    {
    	$result = shell_exec('sudo /etc/init.d/openconnect restart');
    	echo 'Restarted vpn\n';
    }
    
    // Usage instructions
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f cwserenade.php -- [options]
  --action <restartVpn>		Method to run	
  help                   This help

USAGE;
    }
    
}

$cwserenadeShell = new Abp_Shell_Cwserenade();

$cwserenadeShell->run();

