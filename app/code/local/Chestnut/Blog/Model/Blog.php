<?php

class Chestnut_Blog_Model_Blog extends Mage_Core_Model_Abstract 
{
    public function _construct() 
    {
        parent::_construct();
        $this->_init('blog/blog');
    }

    public function getBannerContent() 
    {
        $content = $this->getData('banner_content');
        if (Mage::getStoreConfig(Chestnut_Blog_Helper_Config::XML_BLOG_PARSE_CMS)) {
            $processor = Mage::getModel('core/email_template_filter');
            $content = $processor->filter($content);
        }
        return $content;
    }

    public function getShortContent() 
    {
        $content = $this->getData('short_content');
        if (Mage::getStoreConfig(Chestnut_Blog_Helper_Config::XML_BLOG_PARSE_CMS)) {
            $processor = Mage::getModel('core/email_template_filter');
            $content = $processor->filter($content);
        }
        return $content;
    }

    public function getPostContent() 
    {
        $content = $this->getData('post_content');
        if (Mage::getStoreConfig(Chestnut_Blog_Helper_Config::XML_BLOG_PARSE_CMS)) {
            $processor = Mage::getModel('core/email_template_filter');
            $content = $processor->filter($content);
        }
        return $content;
    }

    public function _beforeSave() 
    {
        if (is_array($this->getData('tags'))) {
            $this->setData('tags', implode(",", $this->getData('tags')));
        }
        return parent::_beforeSave();
    }

    public function refreshRewrites($route)
    {
        if (empty($route)) {
            $route = Mage::helper('blog')->getRoute();
        }

        for ($i=0;$i<=2;$i++) {
            $idPath = 'blog' . str_repeat('/index', $i);
            $requestPath = $route . str_repeat('/index', $i);
            $urlRewrite = Mage::getSingleton('core/url_rewrite')->loadByIdPath($idPath);
            $urlRewrite->setIdPath($idPath)
                ->setRequestPath($requestPath)
                ->setTargetPath($idPath)
                ->setOptions()
                ->setIsSystem(true)
                ->save();
        }
    }
}