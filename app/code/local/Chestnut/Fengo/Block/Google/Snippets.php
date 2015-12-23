<?php
 
class Chestnut_Fengo_Block_Google_Snippets extends Mage_Catalog_Block_Product_View
{
	public function getSetting($path = '', $store = NULL)
	{
		return $this->helper('fengo')->getSetting($path, $store);
	}
	
	public function isEnabled() {
		return $this->getSetting('snippets/enabled');
	}

	public function showProductImage() {
		return $this->getSetting('snippets/product_image');
	}

	public function enableDescription() {
		return $this->getSetting('snippets/product_description');
	}

	public function enableRatings() {
		return $this->getSetting('snippets/product_ratings');
	}

	public function enablePrice() {
		return $this->getSetting('snippets/product_price');
	}

	public function enableAvailability() {
		return $this->getSetting('snippets/product_availability');
	}

	public function enableSku() {
		return $this->getSetting('snippets/product_sku');
	}
}
