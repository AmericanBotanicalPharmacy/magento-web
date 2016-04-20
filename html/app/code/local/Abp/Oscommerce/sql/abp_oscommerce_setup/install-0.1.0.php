<?php
/**
 * Install database
 *
 * @category    Abp
 * @package     Abp_Oscommerce
 * @author		Aydus <davidt@aydus.com>
 */

$this->startSetup();
echo 'Started Abp_Oscommerce Setup...<br />';

$this->run("CREATE TABLE IF NOT EXISTS {$this->getTable('abp_oscommerce_customers')} (
`customer_id` INT(11) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`updated` TINYINT(1) NOT NULL DEFAULT '0',
`created_at` DATETIME NOT NULL,
`updated_at` DATETIME NOT NULL,
PRIMARY KEY ( `customer_id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

echo 'Ended Abp_Oscommerce Setup';

$this->endSetup();