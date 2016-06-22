<?php
/**
 * ABP Cwserenade
 *
 * @category    Abp
 * @package     Abp_Cwserenade
 * @author      Edward Yang <yushine999@gmail.com>
 */

$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('abp_cwserenade_orders'),
    'auth_amount',
    "INT(11) NOT NULL DEFAULT 0 AFTER `cw_order_out`"
);
$installer->getConnection()->addColumn(
    $installer->getTable('abp_cwserenade_orders'),
    'order_total',
    "INT(11) NOT NULL DEFAULT 0 AFTER `auth_amount`"
);

$installer->endSetup();
