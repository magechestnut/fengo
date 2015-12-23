<?php

$installer = $this;
$installer->startSetup();

$tableName = $installer->getTable('newsletter_subscriber');
$installer->getConnection()->addColumn($tableName, 'subscriber_gender', array(
    'nullable' => true,
    'length' => 1,
    'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
    'comment' => 'Elegento Newsletter'
));
$installer->getConnection()->addColumn($tableName, 'subscriber_prefix', array(
    'nullable' => true,
    'length' => 255,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Elegento Newsletter'
));
$installer->getConnection()->addColumn($tableName, 'subscriber_firstname', array(
    'nullable' => true,
    'length' => 255,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Elegento Newsletter'
));
$installer->getConnection()->addColumn($tableName, 'subscriber_lastname', array(
    'nullable' => true,
    'length' => 255,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Elegento Newsletter'
));
$installer->getConnection()->addColumn($tableName, 'subscriber_suffix', array(
    'nullable' => true,
    'length' => 255,
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'comment' => 'Elegento Newsletter'
));
$installer->getConnection()->addColumn($tableName, 'subscriber_dob', array(
    'nullable' => true,
    'type' => Varien_Db_Ddl_Table::TYPE_DATETIME,
    'comment' => 'Elegento Newsletter'
));

$installer->endSetup();