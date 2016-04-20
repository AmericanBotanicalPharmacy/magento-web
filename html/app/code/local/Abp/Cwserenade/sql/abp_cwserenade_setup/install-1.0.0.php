<?php
/**
 * Install database
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author		Aydus <davidt@aydus.com>
 */

$this->startSetup();
echo 'Started Abp_Cwserenade Setup...<br />';

$this->run("CREATE TABLE IF NOT EXISTS {$this->getTable('abp_cwserenade_orders')} (
`increment_id` INT(11) NOT NULL,
`state` TINYINT(1) NOT NULL,
`schedule_id` INT(11) NOT NULL,
`num_retries` TINYINT(1) NOT NULL,
`payment_method` VARCHAR(25) NOT NULL,
`cc_type` VARCHAR(10) NOT NULL,
`cc_number_enc` VARCHAR(255) NOT NULL,
`cc_cid_enc` VARCHAR(255) NOT NULL,
`cc_exp_month` smallint(5) NOT NULL,
`cc_exp_year` smallint(5) NOT NULL,
`cw_order_id` INT(11) NOT NULL,
`cw_customer_number` INT(11) NOT NULL,
`cw_order_out` TEXT NOT NULL,
`created_at` DATETIME NOT NULL,
`updated_at` DATETIME NOT NULL,
PRIMARY KEY ( `increment_id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

echo 'Ended Abp_Cwserenade Setup';

$this->endSetup();