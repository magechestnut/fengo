<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Rewrite_CategoryView extends Mage_Catalog_Block_Category_View
{
    public function isEnabled($store = NULL)
    {
        return $this->helper('chestnut_layerednav')->getConfig('general/enable', $store);
    }

    public function getProductListHtml()
    {
        $html = parent::getProductListHtml();
        if ($this->getCurrentCategory()->getIsAnchor() && $this->isEnabled()){
            $html = Mage::helper('chestnut_layerednav')->wrapProducts($html);
        }
        return $html;
    }
}