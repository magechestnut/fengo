<?php

$installer = $this;

$installer->startSetup();

try {
	$installer->run("CREATE TABLE IF NOT EXISTS {$this->getTable('egmenu/egmenu')} (
		`block_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
		`cat_id` int(11) unsigned NOT NULL DEFAULT 2,
		`top_block` text NOT NULL DEFAULT '',
		`bottom_block` text NOT NULL DEFAULT '',
		`right_block` text NOT NULL DEFAULT '',
		`right_block_width` smallint(6) NOT NULL DEFAULT 0,
		`left_block` text NOT NULL DEFAULT '',
		`left_block_width` smallint(6) NOT NULL DEFAULT 0,
		`category_label` varchar(255) DEFAULT NULL,
		`created_time` datetime DEFAULT NULL,
		`update_time` datetime DEFAULT NULL,
		PRIMARY KEY (`block_id`),
        UNIQUE KEY `cat_id` (`cat_id`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
	");
} catch (Exception $e) {
    
}

$installer->endSetup();