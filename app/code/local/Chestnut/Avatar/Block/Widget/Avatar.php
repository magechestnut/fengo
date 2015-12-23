<?php

class Chestnut_Avatar_Block_Widget_Avatar extends Mage_Customer_Block_Widget_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('chestnut/avatar/widget/avatar.phtml');
    }

    public function isEnabled()
    {
        return (bool)$this->_getAttribute('avatar_valid')->getIsVisible();
    }

    public function isRequired()
    {
        return (bool)$this->_getAttribute('avatar_valid')->getIsRequired();
    }

    public function getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}
