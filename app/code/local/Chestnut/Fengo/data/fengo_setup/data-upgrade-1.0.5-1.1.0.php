<?php
/**
 * @author		Chestnut
 * @copyright	Copyright 2013 - 2015 Chestnut
 */
$installer = $this;
$installer->startSetup();

Mage::getConfig()->cleanCache();

$installer->endSetup();