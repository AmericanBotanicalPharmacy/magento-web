<?php

/**
 * Cwserenade push states
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

class Abp_Cwserenade_Model_Order_State 
{
	const FAILED = -1;
	const PENDING = 0;
	const PROCESSING = 1;	
	const COMPLETED = 2;
}