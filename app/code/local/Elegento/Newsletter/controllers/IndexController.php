<?php

class Elegento_Newsletter_IndexController extends Mage_Core_Controller_Front_Action
{
	public function hidePopupAction()
	{
	    $expire = Mage::helper('egnewsletter')->getPopupExpire();
        
        Mage::getModel('core/cookie')->set('eghide', time(), (time() + $expire));
        $this->getResponse()->setHeader('Content-type', 'application/json');
		$this->getResponse()->setBody('1');
	}

	public function disablePopupAction()
	{
	    $expire = time() + 31536000;
        
        Mage::getModel('core/cookie')->set('eghide', $expire, $expire);
        $this->getResponse()->setHeader('Content-type', 'application/json');
		$this->getResponse()->setBody('1');
	}
}
