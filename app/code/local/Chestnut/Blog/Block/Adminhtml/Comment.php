<?php

class Chestnut_Blog_Block_Adminhtml_Comment extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_comment';
        $this->_blockGroup = 'blog';
        $this->_headerText = Mage::helper('blog')->__('Blog Comment Manager');
        parent::__construct();
        $this->setTemplate('chestnut/blog/comments.phtml');
    }

    protected function _prepareLayout() {
        $this->_removeButton('add');
        return parent::_prepareLayout();
    }

}
