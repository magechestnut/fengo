<?php

class Chestnut_Menu_Model_Mysql4_Blocks extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('egmenu/egmenu', 'block_id');
    }
}