<?php

class Chestnut_Menu_Model_Blocks extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('egmenu/blocks');
    }
}