<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Model_Layer_Filter_Price extends Mage_Catalog_Model_Layer_Filter_Price
{
    protected $baseSelect = null;
    
    protected function _getItemsData()
    {
        $data = array();
        $data[] = array(
            'label' => '',
            'value' => 0 . ',' . $this->getMaxPriceInt()+1,
            'count' => 1,
        );
        
        return $data;
    }
    
    protected function _getCacheKey()
    {
        $key = parent::_getCacheKey();
        $key .= Mage::helper('chestnut_layerednav')->getCacheKey('price');
        return $key;
    }   
    
    private function getFilterValueFromRequest()
    {
        $filter = Mage::helper('chestnut_layerednav')->getParam($this->_requestVar);
    
        if (!$filter) {
            return array(0, 0);
        }

        $filter = explode(',', $filter);
       
        if (count($filter) != 2) {
            return array(0, 0);
        }

        list($from, $to) = $filter;
        $from = sprintf("%.02f", $from);
        $to   = sprintf("%.02f", $to);
         
        return array($from, $to);
    }

    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock)
    {
        list($from, $to) = $this->getFilterValueFromRequest();        
        $this->setActiveState($from . ','. $to);
        
        $this->baseSelect = clone $this->getLayer()->getProductCollection()->getSelect();
        if ($from >= 0.01 || $to >= 0.01) {
            $this->applyFromToFilter($from, $to);            
        }

        return $this;
    }
    
    protected function applyFromToFilter($from, $to)
    {
        $attribute = $this->getAttributeModel();
        
        $tableAlias = $attribute->getAttributeCode() . '_idx';
       
        if ($attribute->getAttributeCode() == 'price')
        {
            $bIsBasePrice = true;
            $tableName = Mage::getSingleton('core/resource')->getTableName('catalogindex/price');
            $valueAlias = 'min_price';
        }
        else 
        {
            $bIsBasePrice = false;
            $tableName = Mage::getSingleton('core/resource')->getTableName('catalog/product_index_eav_decimal');
            $valueAlias = 'value';
        }
        
        $collection   = $this->getLayer()->getProductCollection();
        $websiteId    = Mage::app()->getStore()->getWebsiteId();
        $custGroupId  = Mage::getSingleton('customer/session')->getCustomerGroupId();
        
        $collection->getSelect()->distinct(true);
        
        $sOnStatement = $tableAlias . '.entity_id=e.entity_id';

        if (!$bIsBasePrice)
        {
            $sOnStatement .= ' AND ' . $tableAlias . '.attribute_id = ' .$attribute->getId() . ' AND ' . $tableAlias . '.store_id = ' . Mage::app()->getStore()->getId();                
        }
        try {
        	$collection->getSelect()->joinLeft(
            array($tableAlias => $tableName), 
            $sOnStatement,
            array()
        );            	
        } catch (Zend_No_Exception $e) {
        	return $this;
        }        

        $response = new Varien_Object();
        $response->setAdditionalCalculations(array());
        
        if ($bIsBasePrice)
        {
            $collection->getSelect()
                ->where($tableAlias . '.website_id = ?', $websiteId)   // modified line
                ;
        }   

        if ($attribute->getAttributeCode() == 'price') {
            $collection->getSelect()->where($tableAlias . '.customer_group_id = ?', $custGroupId); // modified line
            $args = array(
                'select'         => $collection->getSelect(),
                'table'          => $tableAlias,
                'store_id'       => Mage::app()->getStore()->getId(), // modified line
                'response_object'=> $response,
            );
            Mage::dispatchEvent('catalogindex_prepare_price_select', $args);
        }
        
        $rate =  $this->_getCurrencyRate();
        
        if ($from > 0.01)
            $collection->getSelect()->where("(({$tableAlias}.{$valueAlias}".implode('', $response->getAdditionalCalculations()).")*$rate) >= ?", $from);
        if ($to > 0.01)    
            $collection->getSelect()->where("(({$tableAlias}.{$valueAlias}".implode('', $response->getAdditionalCalculations()).")*$rate) <= ?", $to);

        $this->_isTableJoined = true;
        return $this;
    }  
    
    protected $_isTableJoined = null;
    
    protected function _getBaseCollectionSql()
    {
        return $this->baseSelect;
    }

    protected function _getCurrencyRate()
    {
        $rate =  Mage::app()->getStore()->convertPrice(1000000, false);
        
        $rate = $rate / 1000000;
        
        return $rate;
    }
    
    public function getMaxPriceInt() /// to do - make like minmax!!
    {        
        list($min,$max) = $this->getMinMaxPriceInt();
        return $max;
    }
    
    protected function getMinMax($filter, $bIsBasePrice)
    {
        $attribute    = $this->getAttributeModel();
        $mainCollection   = $this->getLayer()->getProductCollection();
        $websiteId    = Mage::app()->getStore()->getWebsiteId();
        $custGroupId  = Mage::getSingleton('customer/session')->getCustomerGroupId();

        $select = clone $mainCollection->getSelect();
        
        $select->setPart(Varien_Db_Select::COLUMNS, array());
        $select->setPart(Varien_Db_Select::ORDER , array());
        
        $select->distinct(false);
        
        $tableAlias = $attribute->getAttributeCode() . '_idx';
            
        if ($bIsBasePrice)
        {
            $tableName = Mage::getSingleton('core/resource')->getTableName('catalogindex/price');
            $valueAlias = 'min_price';
        }
        else 
        {
            $tableName = Mage::getSingleton('core/resource')->getTableName('catalog/product_index_eav_decimal');
            $valueAlias = 'value';
        }
        
        $select->columns(array(
            'min_value' => new Zend_Db_Expr('MIN(' . $tableAlias . '.' . $valueAlias . ')'),
            'max_value' => new Zend_Db_Expr('MAX(' . $tableAlias . '.' . $valueAlias . ')'),
        ));
        
        if ($this->_isTableJoined)
        {
            $oldWhere = $select->getPart(Varien_Db_Select::WHERE);
            
            $newWhere = array();
    
            $alias = $tableAlias . '.' . $valueAlias;
            
            foreach ($oldWhere as $cond){
               if (!strpos($cond, $alias))
               {
                   $newWhere[] = $cond;
                }
            }
      
            if ($newWhere && substr($newWhere[0], 0, 3) == 'AND')
               $newWhere[0] = substr($newWhere[0],3);        
           
            $select->setPart(Varien_Db_Select::WHERE, $newWhere);            
        }
        else 
        {
            $sOnStatement = $tableAlias . '.entity_id=e.entity_id';

            if (!$bIsBasePrice)
            {
                $sOnStatement .= ' AND ' . $tableAlias . '.attribute_id = ' .$attribute->getId() . ' AND ' . $tableAlias . '.store_id = ' . Mage::app()->getStore()->getId();                
            }
            try {
            	$select->joinLeft(
                    array($tableAlias => $tableName),
                    $sOnStatement,
                    array()
            	);                	
            } catch (Zend_Db_No_Exception $e) {
            	return $this;
            }
            
    
            $response = new Varien_Object();
            $response->setAdditionalCalculations(array());
            
            if ($bIsBasePrice)
            {
                $select
                    ->where($tableAlias . '.website_id = ?', $websiteId) 
                ;
            }                
                
            if ($bIsBasePrice) 
            {
                $select->where($tableAlias . '.customer_group_id = ?', $custGroupId);
                $args = array(
                    'select'         => $select,
                    'table'          => $tableAlias,
                    'store_id'       => Mage::app()->getStore()->getId(),
                    'response_object'=> $response,
                );
                Mage::dispatchEvent('catalogindex_prepare_price_select', $args);
            }
        }

        $adapter = Mage::getSingleton('core/resource')->getConnection('core_read');
        $result     = $adapter->fetchRow($select); 
        $rate =  $this->_getCurrencyRate();
        
        return array($result['min_value'] * $rate, ceil($result['max_value'] * $rate));
    }
    
    public function getMinMaxPriceInt()
    {
        $attribute    = $this->getAttributeModel();
        
        if ($attribute->getAttributeCode() == 'price')
        {
            list($min, $max) = $this->getMinMax($this, true);
        }
        else 
        {
            list($min, $max) = $this->getMinMax($this, false);
        }
        
        $max = floor($max);
        $min = floor($min);
        
        return array($min, $max);
    }
    
    protected function _getDecimalItemsData()
    {
        $key = $this->_getDecimalCacheKey();

        $data = $this->getLayer()->getAggregator()->getCacheData($key);
        
        if ($data === null) {
            $data       = array();
            $range      = $this->getRange();
            $dbRanges   = $this->getDecimalRangeItemCounts($range);

            foreach ($dbRanges as $index => $count) {
                $data[] = array(
                    'label' => $this->_renderItemLabel($range, $index),
                    'value' => $index . ',' . $range,
                    'count' => $count,
                );
            }


        }
        return $data;
    }
    
    const MIN_RANGE_POWER = 10;

    protected $_resource;

    protected function _getResource()
    {
        if (is_null($this->_resource)) {
            if ($this->getAttributeModel()->getAttributeCode() == 'price')
            {
                $this->_resource = Mage::getResourceModel('catalog/layer_filter_price');
            }
            else 
            {
                $this->_resource = Mage::getResourceModel('catalog/layer_filter_decimal');
            }
        }
        return $this->_resource;
    }

    protected function _getDecimalCacheKey()
    {
        $key = $this->getLayer()->getStateKey()
            . '_ATTR_' . $this->getAttributeModel()->getAttributeCode();
        return $key;
    }

    protected function _renderItemLabel($range, $value)
    {
        $from   = Mage::app()->getStore()->formatPrice(($value - 1) * $range, false);
        $to     = Mage::app()->getStore()->formatPrice($value * $range, false);
        return Mage::helper('catalog')->__('%s - %s', $from, $to);
    }

    public function getMaxValue()
    {
        $max = $this->getData('max_value');
        if (is_null($max)) {
            list($min, $max) = $this->getMinMax($this, false);
            
            $this->setData('max_value', $max);
            $this->setData('min_value', $min);
        }
        return $max;
    }

    public function getMinValue()
    {
        $min = $this->getData('min_value');
        if (is_null($min)) {
            list($min, $max) = $this->_getResource()->getMinMax($this);
            $this->setData('max_value', $max);
            $this->setData('min_value', $min);
        }
        return $min;
    }

    public function getRange()
    {
        $range = $this->getData('range');
        if (is_null($range)) {
            $max = $this->getMaxValue();
            $index = 1;
            do {
                $range = pow(10, (strlen(floor($max)) - $index));
                $items = $this->getDecimalRangeItemCounts($range);
                $index ++;
            }
            while($range > self::MIN_RANGE_POWER && count($items) < 2);

            $this->setData('range', $range);
        }
        return $range;
    }

    public function getDecimalRangeItemCounts($range)
    {
        $rangeKey = 'range_item_counts_' . $range;
        $items = $this->getData($rangeKey);
        if (is_null($items)) {
            $items = $this->_getResourceCount($this, $range);
            $this->setData($rangeKey, $items);
        }
        return $items;
    }
    
    protected function _getResourceCount($filter, $range)
    {
        $select     = $this->_getDecimalSelect($filter);
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');

        $table = 'decimal_index';
        
        $additional = '';

        $rate       = $filter->getCurrencyRate();
        $countExpr  = new Zend_Db_Expr("COUNT(*)");
        $rangeExpr  = new Zend_Db_Expr("FLOOR((({$table}.value {$additional}) * {$rate}) / {$range}) + 1");

        $select->columns(array(
            'range' => $rangeExpr,
            'count' => $countExpr
        ));
        $select->where("{$table}.value > 0");
        $select->group('range');
        return $connection->fetchPairs($select);
    }
    
    protected function _getDecimalSelect($filter)
    {
        $collection = $filter->getLayer()->getProductCollection();
        $select = clone $collection->getSelect();
        $select->reset(Zend_Db_Select::COLUMNS);
        $select->reset(Zend_Db_Select::ORDER);
        $select->reset(Zend_Db_Select::LIMIT_COUNT);
        $select->reset(Zend_Db_Select::LIMIT_OFFSET);

        $attributeId = $filter->getAttributeModel()->getId();
        $storeId     = $collection->getStoreId();

        $select->join(
            array('decimal_index' => $this->_getResource()->getMainTable()),
            "e.entity_id=decimal_index.entity_id AND decimal_index.attribute_id={$attributeId}"
                . " AND decimal_index.store_id={$storeId}",
            array()
        );

        return $select;
    }
}