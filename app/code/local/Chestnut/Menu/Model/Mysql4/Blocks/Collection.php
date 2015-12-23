<?php

class Chestnut_Menu_Model_Mysql4_Blocks_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract 
{
    protected function _construct() 
    {
        $this->_init('egmenu/blocks');
    }

    public function addCategoryFilter($catId = null) 
    {
        if (is_null($catId)) 
            $catId = 2;
        $this->getSelect()->where('main_table.cat_id = ?', $catId);

        return $this;
    }
}