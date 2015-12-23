<?php

$installer = $this;

$installer->startSetup();
try {
    $installer->run("

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/blog')} (
        `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL DEFAULT '',
        `post_content` text NOT NULL,
        `status` smallint(6) NOT NULL DEFAULT '0',
        `image` varchar(255) DEFAULT NULL,
        `created_time` datetime DEFAULT NULL,
        `update_time` datetime DEFAULT NULL,
        `identifier` varchar(255) NOT NULL DEFAULT '',
        `user` varchar(255) NOT NULL DEFAULT '',
        `update_user` varchar(255) NOT NULL DEFAULT '',
        `meta_keywords` text NOT NULL,
        `meta_description` text NOT NULL,
        `comments` tinyint(11) NOT NULL,
        `tags` text NOT NULL,
        `short_content` text NOT NULL,
        `banner_content` text NOT NULL,
        `related` text NOT NULL,
        PRIMARY KEY (`post_id`),
        UNIQUE KEY `identifier` (`identifier`)
      ) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/category')} (
        `cat_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL DEFAULT '',
        `identifier` varchar(255) NOT NULL DEFAULT '',
        `level` int(11) unsigned NOT NULL DEFAULT 0,
        `parent` varchar(255) NOT NULL DEFAULT '',
        `sort_order` tinyint(6) NOT NULL,
        `meta_keywords` text NOT NULL,
        `meta_description` text NOT NULL,
        PRIMARY KEY (`cat_id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/cat_store')} (
        `cat_id` smallint(6) unsigned DEFAULT NULL,
        `store_id` smallint(6) unsigned DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/cat_parent')} (
        `cat_id` smallint(6) unsigned DEFAULT NULL,
        `parent_id` smallint(6) unsigned DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/comment')} (
        `comment_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `post_id` smallint(11) NOT NULL DEFAULT '0',
        `summary` varchar(255) NOT NULL DEFAULT '',
        `comment` text NOT NULL,
        `status` smallint(6) NOT NULL DEFAULT '0',
        `created_time` datetime DEFAULT NULL,
        `user` varchar(255) NOT NULL DEFAULT '',
        `email` varchar(255) NOT NULL DEFAULT '',
        PRIMARY KEY (`comment_id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/post_cat')} (
        `cat_id` smallint(6) unsigned DEFAULT NULL,
        `post_id` smallint(6) unsigned DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS {$this->getTable('blog/store')} (
        `post_id` smallint(6) unsigned DEFAULT NULL,
        `store_id` smallint(6) unsigned DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

      CREATE TABLE IF NOT EXISTS  {$this->getTable('blog/tag')} (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `tag` varchar(255) NOT NULL,
        `tag_count` int(11) NOT NULL DEFAULT '0',
        `store_id` tinyint(4) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `tag` (`tag`,`tag_count`,`store_id`)
      ) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

    ");
} catch (Exception $e) {
    
}

$installer->endSetup();