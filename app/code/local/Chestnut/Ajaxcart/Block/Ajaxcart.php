<?php
class Chestnut_Ajaxcart_Block_Ajaxcart extends Mage_Core_Block_Template
{
    public function getConfig($path, $store = NULL)
    {
        return $this->helper('chestnut_ajaxcart')->getConfig($path, $store);
    }
    
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getAjax()     
     { 
        if (!$this->hasData('ajax')) {
            $this->setData('ajax', Mage::registry('ajax'));
        }
        return $this->getData('ajax');
        
    }
}