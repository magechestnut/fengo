<?php
/**
 * @author		Chestnut
 * @copyright	Copyright 2013 - 2015 Chestnut
 */
$installer = $this;
$installer->startSetup();

Mage::getConfig()->saveConfig('cms/wysiwyg/enabled', 'hidden');

$installer->endSetup();