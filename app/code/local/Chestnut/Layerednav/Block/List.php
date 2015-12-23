<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_List extends Mage_Core_Block_Template 
{

    protected $_productCollection;

    public function setListCollection() 
    {
        $this->getChild('product_list')->setCollection($this->_getProductCollection());
        return $this;
    }

    protected function _toHtml() 
    {
        $this->setListModes();
        $this->setListCollection();

        $html = $this->getChildHtml('product_list');
        $html = Mage::helper('chestnut_layerednav')->wrapProducts($html);

        return $html;
    }

    protected function _getProductCollection() 
    {
        if (is_null($this->_productCollection)) {

            $this->_productCollection = Mage::getSingleton('catalog/layer')
                    ->getProductCollection();
        }

        return $this->_productCollection;
    }
}
