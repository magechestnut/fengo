<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Layer_Filter_Attribute extends Mage_Catalog_Block_Layer_Filter_Attribute 
{
    public function __construct() 
    {
        if ($this->helper('chestnut_layerednav')->getConfig('general/enable')) {
            parent::__construct();
            $this->setTemplate('chestnut/layerednav/layer_attribute.phtml');
            $this->_filterModelName = 'chestnut_layerednav/layer_filter_attribute';
        }
    }

    public function getRequestVar() 
    {
        return $this->_filter->getRequestVar();
    }

    public function isSelected($item) 
    {
        $ids = (array) $this->_filter->getActiveState();
        return in_array($item->getValueString(), $ids);
    }
}
