<?php

class Chestnut_Blog_Block_Adminhtml_Category extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = 'adminhtml_category';
        $this->_blockGroup = 'blog';
        $this->_headerText = Mage::helper('blog')->__('Category Comment Manager');
        parent::__construct();
        $this->setTemplate('chestnut/blog/cats.phtml');
    }

    protected function _prepareLayout() {
        $this->setChild('add_new_button', $this->getLayout()->createBlock('adminhtml/widget_button')
                        ->setData(array(
                            'label' => Mage::helper('blog')->__('Add Category'),
                            'onclick' => "setLocation('" . $this->getUrl('*/*/new') . "')",
                            'class' => 'add'
                        ))
        );
        
        if (!Mage::app()->isSingleStoreMode()) {
            $this->setChild('store_switcher', $this->getLayout()->createBlock('adminhtml/store_switcher')
                            ->setUseConfirm(false)
                            ->setSwitchUrl($this->getUrl('*/*/*', array('store' => null)))
            );
        }
        $this->setChild('grid', $this->getLayout()->createBlock('blog/adminhtml_category_grid', 'blog.grid'));
        return parent::_prepareLayout();
    }

    public function getAddNewButtonHtml() {
        return $this->getChildHtml('add_new_button');
    }

    public function getGridHtml() {
        return $this->getChildHtml('grid');
    }

    public function getStoreSwitcherHtml() {
        return $this->getChildHtml('store_switcher');
    }

}
