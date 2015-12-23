<?php

class Chestnut_Blog_Model_Category extends Mage_Core_Model_Abstract 
{
    const NOROUTE_PAGE_ID = 'no-route';
    const ENTITY = 'chestnut_blog_cat';

    protected function _construct() 
    {
        $this->_init('blog/category');
    }

    public function load($id, $field=null) 
    {
        return parent::load($id, $field);
    }

    public function noRoutePage() 
    {
        $this->setData($this->load(self::NOROUTE_PAGE_ID, $this->getIdFieldName()));
        return $this;
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

    public function getUrl()
    {
        return Mage::getUrl('blog/category/view/',
            array(
                'identifier' => $this->getIdentifier(),
            )
        );
    }

    public function refreshRewrites($route)
    {
        $categories = $this->getCollection();
        foreach ($categories as $category) {
            $this->refreshUrlRewrite($route, $category->getIdentifier());
        }
    }

    protected function refreshUrlRewrite($route = null, $identifier = null)
    {
        if (is_null($identifier)) {
            $identifier = $this->getIdentifier();
        }

        if (empty($route)) {
            $route = Mage::helper('blog')->getRoute();
        }

        $idPath = "blog/category/{$identifier}";
        $requestPath = $route . "/{$identifier}.html";
        $targetPath = "blog/category/view/identifier/{$identifier}";

        $mainUrlRewrite = Mage::getModel('core/url_rewrite')->loadByIdPath($idPath);
        $oldRequestPath = $mainUrlRewrite->getRequestPath();
        $mainUrlRewrite->setIdPath($idPath)
            ->setRequestPath($requestPath)
            ->setTargetPath($targetPath)
            ->setOptions()
            ->setIsSystem(true)
            ->save();
        $this->refreshOldUrlRewrite($route, $oldRequestPath);
    }

    protected function refreshOldUrlRewrite($route, $requestPath = null)
    {
        if (is_null($requestPath)) {
            return;
        }

        $urlRewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
            ->addFilter('target_path', $requestPath)
            ->load();
        if (count($urlRewriteCollection) >= 1) {
            foreach ($urlRewriteCollection as $urlRewrite) {
                $oldRequestPath = $urlRewrite->getRequestPath();
                $oldTargetPath = $urlRewrite->getTargetPath();
                $urlRewrite->setTargetPath($this->swapUrlPath($route, $oldTargetPath))
                    ->setRequestPath($this->swapUrlPath($route, $oldRequestPath))
                    ->save();
                $this->refreshOldUrlRewrite($route, $oldRequestPath);
            }
        }
    }

    protected function swapUrlPath($target, $url)
    {
        return preg_replace("/[^\/]*\/(.*)/", "$target/$1", $url);
    }

    public function getUrlRewrite()
    {
        $idPath = "blog/category/{$this->getIdentifier()}";       
        $mainUrlRewrite = Mage::getModel('core/url_rewrite')->loadByIdPath($idPath);

        if ($mainUrlRewrite->getId()) {
            return Mage::getUrl($mainUrlRewrite->getRequestPath());
        } else {
            return $this->getUrl();
        }
    }

    protected function handleUrlRewrite()
    {
        $idPath = "blog/category/{$this->getIdentifier()}";
        $requestPath = Mage::helper('blog')->getRoute() . "/{$this->getIdentifier()}.html";
        $targetPath = "blog/category/view/identifier/{$this->getIdentifier()}";

        $mainUrlRewrite = Mage::getModel('core/url_rewrite')->loadByIdPath($idPath);
        $mainUrlRewrite->setIdPath($idPath)
            ->setRequestPath($requestPath)
            ->setTargetPath($targetPath)
            ->setOptions()
            ->setIsSystem(true)
            ->save();
         
        $createRedirect = $this->getData('identifier_create_redirect');
        if (!empty($createRedirect) && ($createRedirect != $this->getIdentifier())) {
            $permIdPath = "blog/category/{$createRedirect}";
            $permRewrite = Mage::getModel('core/url_rewrite')->loadByIdPath($permIdPath);
            $permRewrite->setIdPath($permIdPath)
                ->setRequestPath(Mage::helper('blog')->getRoute() . "/{$createRedirect}.html")
                ->setTargetPath($requestPath)
                ->setOptions('RP')
                ->setIsSystem(true)
                ->save();
        }
    }

    protected function _afterSave()
    {
        parent::_afterSave();
        $identifier = $this->getIdentifier();

        if (!empty($identifier)) {
            $this->handleUrlRewrite();
        }

        // Mage::getSingleton('index/indexer')->processEntityAction(
        //     $this, self::ENTITY, Mage_Index_Model_Event::TYPE_SAVE
        // );
    }

    protected function deleteUrlRewrites()
    {
        $idPath = "blog/category/{$this->getIdentifier()}";
        $mainUrlRewrite = Mage::getModel('core/url_rewrite')->loadByIdPath($idPath);
        
        if (!$mainUrlRewrite->isObjectNew()) {
            $urlRewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
                ->addFilter('target_path', $mainUrlRewrite->getRequestPath())
                ->addFieldToFilter('url_rewrite_id', array('neq' => $mainUrlRewrite->getUrlRewriteId()))
                ->load();
            
            foreach ($urlRewriteCollection as $urlRewrite)
            {
                $urlRewrite->delete();
            }
        }
        $mainUrlRewrite->delete();
    }

    protected function _beforeDelete()
    {
        $this->deleteUrlRewrites();
        return parent::_beforeDelete();
    }

}
