<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Layer_Filter_Price extends Mage_Catalog_Block_Layer_Filter_Price
{
    public function __construct()
    {
        if ($this->helper('chestnut_layerednav')->getConfig('general/enable')) {
            parent::__construct(); 
            $this->setTemplate('chestnut/layerednav/layer_price.phtml');
            $this->_filterModelName = 'chestnut_layerednav/layer_filter_price';
        }
    }
    
    public function getRequestVar(){
        return $this->_filter->getRequestVar();
    }
    
    public function isSelected($item)
    {
        return ($item->getValueString() == $this->_filter->getActiveState());        
    }
    
    public function getSymbol()
    {
        $_symbol = $this->getData('symbol');
        if (!$_symbol){
            $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();
            $_symbol = trim(Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol());
            $this->setData('symbol', $_symbol);
        }
        return $_symbol;
    }
	
	public function getOffSet() 
    {		
		$minmaxArray = $this->_filter->getMinMaxPriceInt(); 
		$fromtoArray = explode(',', $this->_filter->getActiveState()); 
	}
} 