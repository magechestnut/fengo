<?php

class Chestnut_Blog_TagController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('root')->setTemplate(Mage::helper('blog')->getLayout());
        $this->getLayout()->getBlock('tagged_posts')->setTagName($this->getRequest()->getParam('name'));

        $this->renderLayout();
    }
}