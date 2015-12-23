<?php

class Chestnut_Fengo_QuickviewController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
		$productId = $this->getRequest()->getParam('product_id');
		$viewHelper = Mage::helper('catalog/product_view');

		$params = new Varien_Object();
		$params->setCategoryId(false);
		$params->setSpecifyOptions(false);

		// Render page
		try {
			$viewHelper->prepareAndRender($productId, $this, $params);
		} catch (Exception $e) {
			if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
				$requestStore = $this->getRequest()->getParam('store');
				if (isset($requestStore) && !$this->getResponse()->isRedirect()) {
					$this->_redirect('');
				} elseif (!$this->getResponse()->isRedirect()) {
					$this->_forward('noRoute');
				}
			} else {
				Mage::logException($e);
				$this->_forward('noRoute');
			}
		}
    }
}