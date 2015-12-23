<?php

class Chestnut_Blog_Helper_Category extends Mage_Core_Helper_Abstract 
{
    
    public function renderPage(Mage_Core_Controller_Front_Action $action, $identifier=null) {
        if (!$cat_id = Mage::getSingleton('blog/category')->load($identifier)->getCatId()) {
            return false;
        }

        $page_title = Mage::getSingleton('blog/category')->load($identifier)->getTitle();
        $blog_title = Mage::getStoreConfig('blog/blog/title') . " - ";

        $action->loadLayout();
        if ($storage = Mage::getSingleton('customer/session')) {
            $action->getLayout()->getMessagesBlock()->addMessages($storage->getMessages(true));
        }
        $action->getLayout()->getBlock('head')->setTitle($page_title);        
        $action->getLayout()->getBlock('root')->setTemplate(Mage::getStoreConfig('blog/blog/layout'));
        $action->renderLayout();

        return true;
    }

}
