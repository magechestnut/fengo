<?php

class Chestnut_Brands_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($path, $store = NULL) 
	{
		return Mage::getStoreConfig('chestnut_brands/' . $path, $store);
	}
}