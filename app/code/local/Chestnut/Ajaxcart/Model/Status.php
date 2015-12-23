<?php

class Chestnut_Ajaxcart_Model_Status extends Varien_Object
{
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_ENABLED    => Mage::helper('chestnut_ajaxcart')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('chestnut_ajaxcart')->__('Disabled')
        );
    }
}