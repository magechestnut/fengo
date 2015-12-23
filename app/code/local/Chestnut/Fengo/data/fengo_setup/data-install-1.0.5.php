<?php
/**
 * @author		Chestnut
 * @copyright	Copyright 2013 - 2015 Chestnut
 */
$installer = $this;
$installer->startSetup();

Mage::getConfig()->saveConfig('cms/wysiwyg/enabled', 'hidden');

Mage::getConfig()->saveConfig('design/package/name', 'fengo');
Mage::getConfig()->saveConfig('web/default/cms_home_page', 'fengo-home-page');
Mage::helper('fengo/css')->generate('design', null, null);

$installer->endSetup();