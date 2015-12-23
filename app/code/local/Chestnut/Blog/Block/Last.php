<?php

class Chestnut_Blog_Block_Last extends Chestnut_Blog_Block_Html_Sidebar implements Mage_Widget_Block_Interface
{
    protected function _toHtml()
    {
        $this->setTemplate('chestnut/blog/latest.phtml');        
        if ($this->_helper()->getEnabled()) {            
            return $this->setData('blog_widget_recent_count', $this->getBlogCount())->renderView();
        }
    }
}