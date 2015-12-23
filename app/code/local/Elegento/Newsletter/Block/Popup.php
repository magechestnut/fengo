<?php

class Elegento_Newsletter_Block_Popup extends Mage_Newsletter_Block_Subscribe
{
    protected $_helper;

    protected function _construct()
    {
        if (is_null($this->_helper))
            $this->_helper = $this->helper('egnewsletter');
    }

    public function getConfig($path, $store = NULL)
    {
        return $this->_helper->getConfig($path, $store);
    }

    public function isEnabledPopup($store = NULL)
    {
        return $this->_helper->isEnabledPopup($store);
    }

    public function showAlreadySubscribed($store = NULL)
    {
        return $this->_helper->showAlreadySubscribed($store);
    }

    public function getPopupVisibility($store = NULL)
    {
        return $this->_helper->getPopupVisibility($store);
    }

    public function getPopupExpire($store = NULL)
    {
        return $this->_helper->getPopupExpire($store);
    }

    public function getHidePopupUrl()
    {
        return Mage::getUrl('egnewsletter/index/hidePopup', array('_forced_secure' => $this->getRequest()->isSecure()));
    }

    public function getDisablePopupUrl()
    {
        return Mage::getUrl('egnewsletter/index/disablePopup', array('_forced_secure' => $this->getRequest()->isSecure()));
    }

    protected function _toHtml()
    {
        if (!$this->isEnabledPopup()) {
            return;
        }
        
        $isLoggedIn = Mage::getSingleton('customer/session')->isLoggedIn();
        if ($this->getPopupVisibility() != 0) {
            if (($isLoggedIn && $this->getPopupVisibility() == 2) || (!$isLoggedIn && $this->getPopupVisibility() == 1)) {
                return;
            }
        }
        
        if (!$this->showAlreadySubscribed()) {
            $email = Mage::getSingleton('customer/session')->getCustomer()->getData('email');
            $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
            if($subscriber->getId()) {
                if (!Mage::getModel('core/cookie')->get('egforcehide')) {
                    Mage::getModel('core/cookie')->set('egforcehide', (time() + 31536000), (time() + 31536000));
                }
                if (time() < Mage::getModel('core/cookie')->get('egforcehide')) {
                    return;
                }
            }
        }
        
        if ($cookieTime = Mage::getModel('core/cookie')->get('eghide')) {
            $expire = $this->getPopupExpire();
            
            if (time() < $cookieTime + $expire) {
                return;
            }
        }
        
        if (!$this->getTemplate()) {
            $this->setTemplate('elegento/newsletter/popup.phtml');
        }
		
        return parent::_toHtml();
    }
}
