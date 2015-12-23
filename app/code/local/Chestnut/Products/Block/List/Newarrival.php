<?php

class Chestnut_Products_Block_List_Newarrival extends Chestnut_Products_Block_Products
{
    protected $newarrival;
    
    protected function getAlias()
    {
        $title = $this->getConfig('new_arrival/title');
        return str_replace(' ', '-', trim(strtolower($title)));
    }

    protected function getProductCollectionCustom()
    {
        if (is_null($this->newarrival))
        {
            $todayStartOfDayDate  = Mage::app()->getLocale()->date()
                ->setTime('00:00:00')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

            $todayEndOfDayDate  = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $perPage = $this->getConfig('new_arrival/products_per_page');

            $collection = Mage::getResourceModel('catalog/product_collection');
            $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());

            $collection = $this->_addProductAttributesAndPrices($collection)
                ->addStoreFilter()
                ->addAttributeToFilter('news_from_date', array('or'=> array(
                    0 => array('date' => true, 'to' => $todayEndOfDayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter('news_to_date', array('or'=> array(
                    0 => array('date' => true, 'from' => $todayStartOfDayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter(
                    array(
                        array('attribute' => 'news_from_date', 'is'=>new Zend_Db_Expr('not null')),
                        array('attribute' => 'news_to_date', 'is'=>new Zend_Db_Expr('not null'))
                        )
                  )
                ->addAttributeToSort('news_from_date', 'desc')
                ->setPageSize($perPage)
                ->setCurPage(($this->getCurrentPage()) ? $this->getCurrentPage() : 1);

            $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
            $pager->setAvailableLimit(array($perPage => $perPage));
            $pager->setCollection($collection);
            $this->setChild('pager', $pager);
            $this->setTotalPageNum($pager->getLastPageNum());

            $this->newarrival = $collection;
            return $this->newarrival;
        }
    }
}