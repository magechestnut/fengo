<?php

class Chestnut_Slideshow_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($path, $store = NULL) 
	{
		return Mage::getStoreConfig('slideshow/' . $path, $store);
	}
}