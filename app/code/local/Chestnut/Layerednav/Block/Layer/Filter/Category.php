<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Layer_Filter_Category extends Mage_Catalog_Block_Layer_Filter_Category 
{
    public function __construct()
    {
        if ($this->getConfig('general/enable')) {
            parent::__construct();
            $this->setTemplate('chestnut/layerednav/layer_category.phtml');
            $this->_filterModelName = 'chestnut_layerednav/layer_filter_category';
        }
    }

    public function getConfig($path, $store = NULL)
    {
        return $this->helper('chestnut_layerednav')->getConfig($path, $store);
    }

    public function getRequestVar()
    {
        return $this->_filter->getRequestVar();
    }
}