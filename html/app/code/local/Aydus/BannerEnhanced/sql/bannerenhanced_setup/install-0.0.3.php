<?php

/**
 * Add position table
 *
 * @category    Aydus
 * @package     Aydus_BannerEnhanced
 * @author 		Aydus <davidt@aydus.com>
 */

$installer = $this;
$installer->startSetup();

$installer->run("CREATE TABLE IF NOT EXISTS {$this->getTable('aydus_bannerenhanced_position')} (
`banner_id` INT(11) NOT NULL,
`position` INT(11) NOT NULL,
PRIMARY KEY ( `banner_id` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$installer->endSetup();

?>
