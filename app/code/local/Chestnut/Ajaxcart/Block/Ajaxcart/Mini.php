<?php

class Chestnut_Ajaxcart_Block_Ajaxcart_Mini extends Mage_Checkout_Block_Cart_Sidebar
{
	public function __construct()
    {
        parent::__construct();
        $this->addItemRender('default', 'checkout/cart_item_renderer', 'checkout/cart/mini/item.phtml');
    }
}