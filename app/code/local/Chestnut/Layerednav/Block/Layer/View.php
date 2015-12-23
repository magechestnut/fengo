<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Layer_View extends Mage_Catalog_Block_Layer_View
{
    public function __construct()
    {
        if ($this->isEnabled()) {
            parent::__construct();
            $this->setTemplate('chestnut/layerednav/layer.phtml');
            $this->_filterModelName = 'chestnut_layerednav/layer_filter_price';
        }
    }

    public function isEnabled() {
        return $this->helper('chestnut_layerednav')->getConfig('general/enable');
    }

    protected function _prepareLayout() 
    {
        if ($this->isEnabled()) {
            $category = Mage::registry('current_category');

            if ($category) {
                $currentCategoryID = $category->getId();
            } else {
                $currentCategoryID = null;
            }

            $sessionObject = Mage::getSingleton('catalog/session');
            if ($sessionObject AND $lastCategoryID = $sessionObject->getLastCatgeoryID()) {
                if ($currentCategoryID != $lastCategoryID) {
                    Mage::register('new_category', true);
                }
            }
            $sessionObject->setLastCatgeoryID($currentCategoryID);
      
            if ($this->helper('chestnut_layerednav')->getConfig('general/show_categories')) {
                $categoryBlock = $this->getLayout()->createBlock('chestnut_layerednav/layer_filter_category')
                    ->setLayer($this->getLayer())
                    ->init();
                $this->setChild('category_filter', $categoryBlock);
            } else {
                $categoryBlock = $this->getLayout()->createBlock('chestnut_layerednav/navigation')
                    ->setTemplate('chestnut/layerednav/categories.phtml')
                    ->toHtml();
                $this->setCategoryBlock($categoryBlock);
            }

            $filterableAttributes = $this->_getFilterableAttributes();

            $blocks = array();
            foreach ($filterableAttributes as $attribute) {
                $blockType = 'chestnut_layerednav/layer_filter_attribute';

                if ($attribute->getFrontendInput() == 'price') {
                    $blockType = 'chestnut_layerednav/layer_filter_price';
                }

                if ($attribute->getAttributeCode() == 'size') {
                    $blockType = 'chestnut_layerednav/layer_filter_size';
                }

                $name = $attribute->getAttributeCode() . '_filter';

                $blocks[$name] = $this->getLayout()->createBlock($blockType)
                        ->setLayer($this->getLayer())
                        ->setAttributeModel($attribute);

                $this->setChild($name, $blocks[$name]);
            }

            foreach ($blocks as $name => $block) {
                $block->init();
            }
            $this->getLayer()->apply();
        }

        return Mage_Core_Block_Template::_prepareLayout();
    }

    protected function _toHtml() 
    {
        $html = parent::_toHtml();
        if (!Mage::app()->getRequest()->isXmlHttpRequest() && $this->isEnabled()) {
            $html = '<div id="chestnut_layerednav">' . $html . '</div>';
        }
        return $html;
    }
}