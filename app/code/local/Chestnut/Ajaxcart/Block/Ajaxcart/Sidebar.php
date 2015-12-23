<?php

class Chestnut_Ajaxcart_Block_Ajaxcart_Sidebar extends Mage_Checkout_Block_Cart_Sidebar
{
	public function getConfig($path, $store = NULL)
    {
        return $this->helper('chestnut_ajaxcart')->getConfig($path, $store);
    }
	
	public function getItemRenderer($type)
	{
		if (!isset($this->_itemRenders[$type])) {
			$type = 'default';
		}
		if (is_null($this->_itemRenders[$type]['blockInstance'])) {
			$this->_itemRenders[$type]['blockInstance'] = $this->getLayout()
			->createBlock($this->_itemRenders[$type]['block'])
			->setTemplate('chestnut/ajaxcart/checkout/cart/sidebar/default.phtml')
			->setRenderedBlock($this);
		}

		return $this->_itemRenders[$type]['blockInstance'];
	}
}