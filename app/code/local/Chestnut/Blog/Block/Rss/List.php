<?php

class Chestnut_Blog_Block_Rss_List extends Mage_Rss_Block_List 
{
    public function getRssMiscFeeds() 
    {
        parent::getRssMiscFeeds();
        $this->ChestnutBlogFeed();
        return $this->getRssFeeds();
    }

    public function ChestnutBlogFeed() 
    {
        $route = Mage::helper('blog')->getRoute() . '/rss';
        $title = Mage::getStoreConfig('blog/blog/title');
        $this->addRssFeed($route, $title);
        return $this;
    }
}