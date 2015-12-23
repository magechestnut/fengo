<?php

class Chestnut_Products_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($path, $store = NULL) 
	{
		return Mage::getStoreConfig('chestnut_products/' . $path, $store);
	}

	public function getBaseCurrency()
	{
		return Mage::app()->getStore()->getBaseCurrencyCode();
	}

	public function getCurrentCurrency()
	{
		return Mage::app()->getStore()->getCurrentCurrencyCode();
	}

	public function getCurrentCurrencySymbol()
	{
		return Mage::app()->getLocale()->currency($this->getCurrentCurrency())->getSymbol();
	}

	public function getFormattedPrice($price = 0, $decimals = 0)
	{
		$currencyPrice = Mage::helper('directory')->currencyConvert($price, $this->getBaseCurrency(), $this->getCurrentCurrency());
		return number_format($currencyPrice, $decimals);
	}

	public function getFormattedPriceWithSymbol($price = 0, $decimals = 0)
	{
		return $this->getCurrentCurrencySymbol() . $this->getFormattedPrice($price, $decimals);
	}
}