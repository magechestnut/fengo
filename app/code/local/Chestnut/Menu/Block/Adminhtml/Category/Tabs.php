<?php

class Chestnut_Menu_Block_Adminhtml_Category_Tabs extends Mage_Adminhtml_Block_Catalog_Category_Tabs
{
    protected function _prepareLayout()
    {
        $categoryAttributes = $this->getCategory()->getAttributes();
        if (!$this->getCategory()->getId()) {
            foreach ($categoryAttributes as $attribute) {
                $default = $attribute->getDefaultValue();
                if ($default != '') {
                    $this->getCategory()->setData($attribute->getAttributeCode(), $default);
                }
            }
        }

        $attributeSetId     = $this->getCategory()->getDefaultAttributeSetId();
        /** @var $groupCollection Mage_Eav_Model_Resource_Entity_Attribute_Group_Collection */
        $groupCollection    = Mage::getResourceModel('eav/entity_attribute_group_collection')
            ->setAttributeSetFilter($attributeSetId)
            ->setSortOrder()
            ->load();
        $defaultGroupId = 0;
        foreach ($groupCollection as $group) {
            /* @var $group Mage_Eav_Model_Entity_Attribute_Group */
            if ($defaultGroupId == 0 or $group->getIsDefault()) {
                $defaultGroupId = $group->getId();
            }
        }

        foreach ($groupCollection as $group) {
            /* @var $group Mage_Eav_Model_Entity_Attribute_Group */
            $attributes = array();
            foreach ($categoryAttributes as $attribute) {
                /* @var $attribute Mage_Eav_Model_Entity_Attribute */
                if ($attribute->isInGroup($attributeSetId, $group->getId())) {
                    $attributes[] = $attribute;
                }
            }

            // do not add grops without attributes
            if (!$attributes) {
                continue;
            }

            $active  = $defaultGroupId == $group->getId();
            $block = $this->getLayout()->createBlock($this->getAttributeTabBlock(), '')
                ->setGroup($group)
                ->setAttributes($attributes)
                ->setAddHiddenFields($active)
                ->toHtml();
            $this->addTab('group_' . $group->getId(), array(
                'label'     => Mage::helper('catalog')->__($group->getAttributeGroupName()),
                'content'   => $block,
                'active'    => $active
            ));
        }

        $this->addTab('products', array(
            'label'     => Mage::helper('catalog')->__('Category Products'),
            'content'   => $this->getLayout()->createBlock(
                'adminhtml/catalog_category_tab_product',
                'category.product.grid'
            )->toHtml(),
        ));

        // dispatch event add custom tabs
        Mage::dispatchEvent('adminhtml_catalog_category_tabs', array(
            'tabs'  => $this
        ));
        
        if (!Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        if ($this->getCategory()->getId() && ($this->getCategory()->getLevel() <= 2)) {
            $this->addTab('egmenu', array(
                'label'     => Mage::helper('catalog')->__('Menu'),
                'content'   => $this->getLayout()->createBlock(
                    'egmenu/adminhtml_category_tab_menu',
                    'elegento_menu'
                )->toHtml()
            ));
        }

        return parent::_prepareLayout();
    }
}