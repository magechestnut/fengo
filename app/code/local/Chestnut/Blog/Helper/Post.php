<?php

class Chestnut_Blog_Helper_Post extends Mage_Core_Helper_Abstract 
{

    public function renderPage(Mage_Core_Controller_Front_Action $action, $identifier=null) {

        $page = Mage::getModel('blog/post');
        if (!is_null($identifier) && $identifier !== $page->getId()) {
            $page->setStoreId(Mage::app()->getStore()->getId());
            if (!$page->load($identifier)) {
                return false;
            }
        }

        if (!$page->getId()) {
            return false;
        }
        if ($page->getStatus() == 2) {
            return false;
        }
        $page_title = Mage::getSingleton('blog/post')->load($identifier)->getTitle();
        $blog_title = Mage::getStoreConfig('blog/blog/title') . " - ";

        $action->loadLayout();
        if ($storage = Mage::getSingleton('customer/session')) {
            $action->getLayout()->getMessagesBlock()->addMessages($storage->getMessages(true));
        }
        
        $action->getLayout()->getBlock('head')->setTitle($blog_title . $page_title);
        $action->getLayout()->getBlock('root')->setTemplate(Mage::getStoreConfig('blog/blog/layout'));
        $action->renderLayout();

        return true;
    }
 
}
