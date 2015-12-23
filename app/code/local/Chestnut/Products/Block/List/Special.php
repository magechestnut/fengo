<?php

class Chestnut_Products_Block_List_Special extends Chestnut_Products_Block_Products
{
    protected $special;
    
    protected function getAlias()
    {
        $title = $this->getConfig('special/title');
        return str_replace(' ', '-', trim(strtolower($title)));
    }

    protected function getProductCollectionCustom()
    {
        if (is_null($this->special))
        {
            $todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
            $tomorrow = mktime(0, 0, 0, date('m'), date('d')+1, date('y'));
            $dateTomorrow = date('m/d/y', $tomorrow);
            $perPage = $this->getConfig('special/products_per_page');

            $collection = Mage::getResourceModel('catalog/product_collection');
            $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
            $collection = $this->_addProductAttributesAndPrices($collection)
             ->addStoreFilter()
             ->addAttributeToSort('entity_id', 'desc')
             ->addAttributeToFilter('special_from_date', array('date' => true, 'to' => $todayDate))
             ->addAttributeToFilter('special_to_date', array('or'=> array(0 => array('date' => true, 'from' => $dateTomorrow), 1 => array('is' => new Zend_Db_Expr('null')))), 'left')
             ->setPageSize($perPage)
             ->setCurPage(($this->getCurrentPage()) ? $this->getCurrentPage() : 1);

            $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
            $pager->setAvailableLimit(array($perPage => $perPage));
            $pager->setCollection($collection);
            $this->setChild('pager', $pager);
            $this->setTotalPageNum($pager->getLastPageNum());

            $this->special = $collection;
            return $this->special;
        }
    }
}