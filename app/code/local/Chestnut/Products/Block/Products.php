<?php

class Chestnut_Products_Block_Products extends Mage_Catalog_Block_Product_List
{
    protected $_type = 'cproduct';
    protected $_helper;

	protected function _construct()
    {
        parent::_construct();

    	if (is_null($this->_helper))
        	$this->_helper = $this->helper('fengo');

        $this->setPriceBlock();
    }

    protected function _beforeToHtml()
    {
        return $this;
    }

    protected function setPriceBlock()
    {        
        $this->addPriceBlockType($this->_type, $this->_block, $this->_helper->getPriceBlockTemplate());
    }

	public function getConfig($path, $store = NULL)
	{
		return $this->helper('chestnut_products')->getConfig($path, $store);
	}

	public function getPageLimit() 
	{
		return (int)Mage::app()->getRequest()->getParam($this->getToolbarBlock()->getLimitVarName());
	}

	public function getCurrentPage() 
	{
		return (int)Mage::app()->getRequest()->getParam($this->getToolbarBlock()->getPageVarName());
	}
}