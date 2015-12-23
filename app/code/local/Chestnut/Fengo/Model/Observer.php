<?php

class Chestnut_Fengo_Model_Observer
{	
	public function controllerActionPostdispatchAdminhtmlSystemConfigSave()
	{
		$section = Mage::app()->getRequest()->getParam('section');
		if ($section == 'fengo_design')
		{
			$websiteCode = Mage::app()->getRequest()->getParam('website');
			$storeCode = Mage::app()->getRequest()->getParam('store');
			
			Mage::helper('fengo/css')->generate('design', $websiteCode, $storeCode);
		}
	}
	
	public function storeEdit(Varien_Event_Observer $observer)
	{
		$store = $observer->getEvent()->getStore();
		$storeCode = $store->getCode();
		$websiteCode = $store->getWebsite()->getCode();
		
		Mage::helper('fengo/css')->generate('design', $websiteCode, $storeCode);
	}
}
