<?php

class Chestnut_Blog_Block_Rss extends Mage_Rss_Block_Abstract 
{
    protected function _construct() 
    {
        $this->setCacheKey('rss_catalog_category_'
                . Mage::app()->getStore()->getId() . '_'
                . $this->getRequest()->getParam('cid') . '_'
                . $this->getRequest()->getParam('sid')
        );
        $this->setCacheLifetime(600);
    }

    protected function _toHtml() 
    {
        $rssObj = Mage::getModel('rss/rss');

        $route = Mage::helper('blog')->getRoute();

        $url = $this->getUrl($route);
        $title = Mage::getStoreConfig('blog/blog/title');
        $data = array(
            'title' => $title,
            'description' => $title,
            'link' => $url,
            'charset' => 'UTF-8'
        );

        if (Mage::getStoreConfig('blog/rss/image') != "") {
            $data['image'] = $this->getSkinUrl(Mage::getStoreConfig('blog/rss/image'));
        }

        $rssObj->_addHeader($data);

        $collection = Mage::getModel('blog/blog')->getCollection()
                ->addPresentFilter()
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->setOrder('created_time', 'desc');

        $catIdentifier = $this->getRequest()->getParam('category');

        if ($cat_id = Mage::getSingleton('blog/category')->load($catIdentifier)->getcatId()) {
            Mage::getSingleton('blog/status')->addCatFilterToCollection($collection, $cat_id);
        }

        $tag = $this->getRequest()->getParam('tag');
        if ($tag) {
            $collection->addTagFilter(urldecode($tag));
        }

        Mage::getSingleton('blog/status')->addEnabledFilterToCollection($collection);

        $collection->setPageSize((int) Mage::getStoreConfig('blog/rss/posts'));
        $collection->setCurPage(1);

        if ($collection->getSize()) {
            $processor = Mage::helper('cms')->getBlockTemplateProcessor();

            $className = Mage::getConfig()->getBlockClassName('blog/post');
            $block = new $className();
            foreach ($collection as $post) {
                $data = array(
                    'title' => $post->getTitle(),
                    'link' => $block->getBlogUrl($post->getIdentifier()),
                    'description' => $processor->filter(utf8_encode($post->getPostContent())),
                    'lastUpdate' => strtotime($post->getCreatedTime()),
                );
                $rssObj->_addEntry($data);
            }
        }

        return $rssObj->createRssXml();
    }
}