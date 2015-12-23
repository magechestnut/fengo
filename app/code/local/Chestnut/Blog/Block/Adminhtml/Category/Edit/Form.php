<?php

class Chestnut_Blog_Block_Adminhtml_Category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form 
{
    protected function _prepareForm() 
    {
        $form = new Varien_Data_Form(array(
                    'id' => 'edit_form',
                    'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                    'method' => 'post',
                ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('category_form', array('legend' => Mage::helper('blog')->__('Category Information')));

        $fieldset->addField('title', 'text', array(
            'label' => Mage::helper('blog')->__('Title'),
            'name' => 'title',
            'required' => true
        ));
        
        $fieldset->addField('identifier', 'text', array(
            'name' => 'identifier',
            'label' => Mage::helper('blog')->__('Identifier'),
            'title' => Mage::helper('blog')->__('Identifier'),
            'required' => true,
            'class' => 'chestnut-blog-validate-identifier validate-identifier validate-length maximum-length-254',
        ))->setRenderer($this->getLayout()->createBlock('blog/adminhtml_category_renderer_identifier'));

        $fieldset->addField('level', 'select', array(
            'name' => 'level',
            'label' => Mage::helper('blog')->__('Category Level'),
            'title' => Mage::helper('blog')->__('Category Level'),
            'required' => true,
            'values' => array(
                array(
                    'value' => 0,
                    'label' => Mage::helper('blog')->__('0'),
                ),
                array(
                    'value' => 1,
                    'label' => Mage::helper('blog')->__('1'),
                ),
                array(
                    'value' => 2,
                    'label' => Mage::helper('blog')->__('2'),
                ),
            )
        ))->setRenderer($this->getLayout()->createBlock('blog/adminhtml_category_renderer_categories'));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('blog')->__('Sort Order'),
            'name' => 'sort_order',
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('cms')->__('Store View'),
                'title' => Mage::helper('cms')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            ));
        }

        $fieldset->addField('meta_keywords', 'editor', array(
            'name' => 'meta_keywords',
            'label' => Mage::helper('blog')->__('Keywords'),
            'title' => Mage::helper('blog')->__('Meta Keywords'),
        ));

        $fieldset->addField('meta_description', 'editor', array(
            'name' => 'meta_description',
            'label' => Mage::helper('blog')->__('Description'),
            'title' => Mage::helper('blog')->__('Meta Description'),
        ));

        if (Mage::getSingleton('adminhtml/session')->getBlogData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getBlogData());
            Mage::getSingleton('adminhtml/session')->setBlogData(null);
        } elseif (Mage::registry('blog_data')) {
            $form->setValues(Mage::registry('blog_data')->getData());
        }
        return parent::_prepareForm();
    }
}
