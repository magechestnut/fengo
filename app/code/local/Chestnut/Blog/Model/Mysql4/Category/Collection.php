<?php

class Chestnut_Blog_Model_Mysql4_Category_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract 
{
    public function _construct() 
    {
        $this->_init('blog/category');
    }

    public function toOptionArray() 
    {
        return $this->_toOptionArray('identifier', 'title');
    }
    
    public function addCatFilter($catId) 
    {
        if (!Mage::app()->isSingleStoreMode()) {
            $this->getSelect()->join(
                        array('cat_table' => $this->getTable('post_cat')), 'main_table.post_id = cat_table.post_id', array()
                    )->where('cat_table.cat_id = ?', $catId); 
        }
        return $this;
    }    
    
    public function getSize()
    {
        if (is_null($this->_totalRecords)) {
            $sql = $this->getSelectCountSql();
            $this->_totalRecords = count($this->getConnection()->fetchAll($sql, $this->_bindParams));
        }
        return $this->_totalRecords;
    }

    public function addStoreFilter($store) 
    {
        if (!Mage::app()->isSingleStoreMode()) {
            if ($store instanceof Mage_Core_Model_Store) {
                $store = array($store->getId());
            }

            $this->getSelect()->joinLeft(
                        array('store_table' => $this->getTable('cat_store')), 'main_table.cat_id = store_table.cat_id', array()
                    )
                    ->where('store_table.store_id = 0 
					OR store_table.store_id = \'' . $store . '\'
					OR store_table.store_id IS NULL
			');

            return $this;
        }

        return $this;
    }

    public function addPostFilter($postId) 
    {
        $this->getSelect()->join(
                    array('cat_table' => $this->getTable('post_cat')), 'main_table.cat_id = cat_table.cat_id', array()
                )->where('cat_table.post_id = ?', $postId);

        return $this;
    }

    public function addLevelFilter($level) 
    {
        $this->getSelect()->where('main_table.level = ?', $level);

        return $this;
    }

    public function addParentFilter($parentId) 
    {
        $this->getSelect()->joinLeft(
                    array('parent_table' => $this->getTable('cat_parent')), 'main_table.cat_id = parent_table.cat_id', array()
                )->where('parent_table.parent_id = ?', $parentId);

        return $this;
    }
}