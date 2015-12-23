<?php

class Chestnut_Optionswatch_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getConfig($path, $store = NULL) 
	{
		return Mage::getStoreConfig('chestnut_optionswatch/' . $path, $store);
	}
}