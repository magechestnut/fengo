<?php

class Chestnut_Products_Block_List_Featured extends Chestnut_Products_Block_Products
{
    protected $featured;

    protected function getAlias()
    {
        $title = $this->getConfig('featured/title');
        return str_replace(' ', '-', trim(strtolower($title)));
    }

    protected function getProductCollectionCustom()
    {
        if (is_null($this->featured))
        {
            $storeId = Mage::app()->getStore()->getId();
            $perPage = $this->getConfig('featured/products_per_page');

            $collection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToFilter(array(array('attribute' => 'chestnut_featured', 'eq' => '1')))
                ->addAttributeToSelect('*')
                ->setStoreId($storeId)
                ->addStoreFilter($storeId)
                ->setPageSize($perPage)
                ->addAttributeToSort('position', 'desc')
                ->setCurPage(($this->getCurrentPage()) ? $this->getCurrentPage() : 1);

            Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
            Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
            Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($collection);

            $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
            $pager->setAvailableLimit(array($perPage => $perPage));
            $pager->setCollection($collection);
            $this->setChild('pager', $pager);
            $this->setTotalPageNum($pager->getLastPageNum());

            $this->featured = $collection;
            return $this->featured;
        }
    }
}