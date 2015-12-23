<?php

class Chestnut_Blog_Helper_Data extends Chestnut_Blog_Helper_Config
{
    const XML_PATH_ENABLED = 'blog/blog/enabled';
    const XML_PATH_BLOG_ROUTE = 'blog/blog/route';
    const XML_PATH_FOOTER_ENABLED = 'blog/blog/footerEnabled';
    const XML_CRUMBS_ENABLED = 'blog/blog/blogcrumbs';
    const XML_COMMENTS_PER_PAGE = 'blog/comments/page_count';
    const XML_COMMENTS_ENABLED = 'blog/comments/enabled';
    const XML_POSTS_PER_PAGE = 'blog/blog/perpage';
    const XML_BOOKMARKS = 'blog/blog/bookmarks';
    const XML_TAGCLOUD_SIZE = 'blog/menu/tagcloud_size';
    const XML_BLOG_READMORE = 'blog/blog/readmore';
    const XML_BLOG_PARSE_CMS = 'blog/blog/parse_cms';
    const XML_BLOG_USESHORTCONTENT = 'blog/blog/useshortcontent';
    const XML_PATH_DATE_FORMAT = 'blog/blog/dateformat';
    const XML_DEFAULT_POST_SORT = "blog/blog/sorter";

    const XML_PATH_LAYOUT = 'blog/blog/layout';  
    const XML_RECENT_SIZE = 'blog/menu/recent';
    
    const XML_PATH_TITLE = 'blog/blog/title';
    const XML_PATH_KEYWORDS = 'blog/blog/keywords';
    const XML_PATH_DESCRIPTION = 'blog/blog/description';
    const DEFAULT_PAGE_COUNT = 10;
    const DEFAULT_ROOT = 'blog';
    
    const CATEGORY_URI_PARAM = 'category';
    const POST_URI_PARAM = 'post';
    const TAG_URI_PARAM = 'tag';

    public function getConfig($path, $store = null)
    {
        return Mage::getStoreConfig($path, $store);
    }

    public function isCrumbs($store = null)
    {
        return $this->getConfig(self::XML_CRUMBS_ENABLED, $store);
    }

    public function isEnabled($store = null)
    {
        return $this->getConfig(self::XML_PATH_ENABLED, $store);
    }

    public function isTitle($store = null)
    {
        return $this->getConfig(self::XML_PATH_TITLE, $store);
    }
    
    public function getTitle($store = null)
    {
        return $this->isTitle($store);
    }

    public function getRoute($store = null)
    {
        return ($this->getConfig(self::XML_PATH_BLOG_ROUTE, $store)) ? $this->getConfig(self::XML_PATH_BLOG_ROUTE, $store) : 'blog';
    }

    public function getMetaKeywords($store = null)
    {
        return $this->getConfig(self::XML_PATH_KEYWORDS, $store);
    }

    public function getMetaDescription($store = null)
    {
        return $this->getConfig(self::XML_PATH_DESCRIPTION, $store);
    }

    public function isMenuLeft($store = null)
    {
        return $this->getConfig(self::XML_PATH_MENU_LEFT, $store);
    }
    
    public function isBookmarksPost($store = null)
    {
        return $this->getConfig(self::XML_BOOKMARKS, $store);
    }

    public function useShortContent($store = null)
    {
        return $this->getConfig(self::XML_BLOG_USESHORTCONTENT, $store);
    }

    public function readMoreCount($store = null)
    {
        return $this->getConfig(self::XML_BLOG_READMORE, $store);
    }

    public function getDateFormat($store = null)
    {
        return $this->getConfig(self::XML_PATH_DATE_FORMAT, $store);
    }

    public function isMenuRight($store = null)
    {
        return $this->getConfig(self::XML_PATH_MENU_RIGHT, $store);
    }

    public function isFooterEnabled($store = null)
    {
        return $this->getConfig(self::XML_PATH_FOOTER_ENABLED, $store);
    }

    public function getLayout($store = null)
    {
        return $this->getConfig(self::XML_PATH_LAYOUT, $store);
    }

    public function commentsEnabled($store = null)
    {
        return $this->getConfig(self::XML_COMMENTS_ENABLED, $store);
    }

    public function defaultPostSort($store = null)
    {
        return $this->getConfig(self::XML_DEFAULT_POST_SORT, $store);
    }

    public function commentsPerPage($store = null)
    {
        $count = trim($this->getConfig(self::XML_COMMENTS_PER_PAGE, $store));

        if (!$count) {
            return self::DEFAULT_PAGE_COUNT;
        }

        return $count;
    }

    public function postsPerPage($store = null)
    {
        $count = trim($this->getConfig(self::XML_POSTS_PER_PAGE, $store));

        if (!$count) {
            return self::DEFAULT_PAGE_COUNT;
        }

        return $count;
    }
    
    public function getRecentPage($store = null)
    {
        $count = trim($this->getConfig(self::XML_RECENT_SIZE, $store));

        if (!$count) {
            return self::DEFAULT_PAGE_COUNT;
        }

        return $count;
    }


    public function getUserName()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return trim("{$customer->getFirstname()} {$customer->getLastname()}");
    }
    
    public function getRouteUrl($store = null) 
    {        
        return Mage::getUrl($this->getRoute($store), array('_store' => $store));         
    }

    public function getStoreIdByCode($storeCode)
    {
        foreach (Mage::app()->getStore()->getCollection() as $store) {
            if ($storeCode == $store->getCode()) {
                return $store->getId();
            }
        }
        return false;
    }

    public function getEnabled()
    {
        return Mage::getStoreConfig('blog/blog/enabled') && $this->extensionEnabled('Chestnut_Blog');
    }

    public function getUserEmail()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        return $customer->getEmail();
    }

    public function recursiveReplace($search, $replace, $subject)
    {
        if (!is_array($subject))
            return $subject;

        foreach ($subject as $key => $value)
            if (is_string($value))
                $subject[$key] = str_replace($search, $replace, $value);
            elseif (is_array($value))
                $subject[$key] = self::recursiveReplace($search, $replace, $value);

        return $subject;
    }

    public function extensionEnabled($extension_name)
    {
        $modules = (array) Mage::getConfig()->getNode('modules')->children();
        if (!isset($modules[$extension_name])
                || $modules[$extension_name]->descend('active')->asArray() == 'false'
                || Mage::getStoreConfig('advanced/modules_disable_output/' . $extension_name)
        )
            return false;
        return true;
    }

    public function addRss($head, $path)
    {
        if ($head instanceof Mage_Page_Block_Html_Head)
            $head->addItem("rss", $path, 'title="' . Mage::getStoreConfig(self::XML_PATH_TITLE) . '"');
    }

    public function getRssEnabled()
    {
        return (Mage::getStoreConfigFlag('blog/rss/enable') && Mage::getStoreConfigFlag('rss/config/active'));
    }

    public function convertSlashes($tag, $direction = 'back')
    {
        if ($direction == 'forward') {
            $tag = preg_replace("#/#is", "&#47;", $tag);
            $tag = preg_replace("#\\\#is", "&#92;", $tag);
            return $tag;
        }

        $tag = str_replace("&#47;", "/", $tag);
        $tag = str_replace("&#92;", "\\", $tag);

        return $tag;
    }

    public function filterWYS($text)
    {
        $processorModelName = version_compare(Mage::getVersion(), '1.3.3.0', '>') ? 'widget/template_filter' : 'core/email_template_filter';
        $processor = Mage::getModel($processorModelName);
        if ($processor instanceof Mage_Core_Model_Email_Template_Filter) {
            return $processor->filter($text);
        }
        return $text;
    }

    public function magentoLess14()
    {
        return version_compare(Mage::getVersion(), '1.4', '<');
    }

    public static function escapeSpecialChars($post)
    {
        $post->setTitle(htmlspecialchars($post->getTitle()));
    }

    public function ifStoreChangedRedirect()
    {
        $path = Mage::app()->getRequest()->getPathInfo();
        $currentRoute = $this->getRoute();

        $fromStore = Mage::app()->getRequest()->getParam('___from_store');
        if ($fromStore) {

            $fromStoreId = $this->getStoreIdByCode($fromStore);
            $fromRoute = $this->getRoute($fromStoreId);

            $url = preg_replace("#$fromRoute#si", $currentRoute, $path, 1);
            $url = Mage::getBaseUrl() . ltrim($url, '/');

            Mage::app()->getFrontController()->getResponse()
                    ->setRedirect($url)
                    ->sendResponse();
            exit;
        }
    }
}