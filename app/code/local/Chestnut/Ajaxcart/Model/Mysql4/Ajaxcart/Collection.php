<?php

class Chestnut_Ajaxcart_Model_Mysql4_Ajaxcart_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('chestnut_ajaxcart/chestnut_ajaxcart');
    }
}