<?php

class Chestnut_Brands_Block_Brands extends Mage_Core_Block_Template 
{
    public function getConfig($path, $store = NULL)
    {
        return $this->helper('chestnut_brands')->getConfig($path, $store);
    }

    public function getAttributeId() {
        return $this->getConfig('general/attr_id');
    }

    public function getAttributeTitle() {
        $title = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $this->getAttributeId());
        return $title->getStoreLabel();
    }

    public function getAllBrands() {
        $attributeId = $this->getAttributeId();
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeId);
        $brands = array();
        foreach ($attribute->getSource()->getAllOptions(false, true) as $option) {
            $brands[] = $option['label'];
        }
        return $brands;
    }

    public function getBrandsInUse() {
        $attributeId = $this->getAttributeId();
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeId);
        $collection = Mage::getResourceModel('catalog/product_collection')->addAttributeToSelect($attributeId)->addAttributeToFilter($attributeId, array('neq' => ''))->addAttributeToFilter($attributeId, array('notnull' => true));
        $values = array_unique($collection->getColumnValues($attributeId));
        return $attribute->getSource()->getOptionText(implode(',', $values));
    }

    public function getBrandImageDir() {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . '/chestnut/brands/';
    }

    public function getBrandImageUrl($brand) {
        $extension = trim($this->getConfig('general/image_extension'));
        return $this->getBrandImageDir() . str_replace(" ", "-", strtolower($brand)) . '.' . $extension;
    }

    public function getBrandPageUrl($brand) {
        return Mage::getUrl('catalogsearch/result/', array(
            '_query' => array('q' => $brand)
        ));
    }

}
