<?php

$installer = $this;

$installer->startSetup();

$setup = new Mage_Eav_Model_Entity_Setup('core_setup');
$setup->addAttribute('catalog_product', 'chestnut_featured', array(
        'group'             => 'General',
        'type'              => 'int',
        'backend_type'      => 'int',
        'backend'           => '',
        'frontend'          => '',
        'label'             => 'Is Featured',
        'input'             => 'boolean',
        'frontend_class'    => '',
        'source'            => 'eav/entity_attribute_source_boolean',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible'           => true,
        'required'          => false,
        'user_defined'      => true,
        'default'           => '',
        'searchable'        => false,
        'filterable'        => false,
        'comparable'        => false,
        'visible_on_front'  => false,
        'unique'            => false,
        'apply_to'          => 'simple,configurable,virtual,bundle,downloadable',
        'is_configurable'   => false
));

$setup->updateAttribute('catalog_product', 'chestnut_featured', 'used_in_product_listing', '1');

try {
     $setup->addAttributeToSet('catalog_product', 'Default', 'General', 'chestnut_featured');
} catch (Exception $e) {
    
}

$installer->endSetup();