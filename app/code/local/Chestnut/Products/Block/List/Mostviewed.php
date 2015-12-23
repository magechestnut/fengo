<?php

class Chestnut_Products_Block_List_Mostviewed extends Chestnut_Products_Block_Products
{
    protected $mostviewed;
    
    protected function _construct()
    {
        parent::_construct();

        if (!$this->getTemplate())
            $this->setTemplate('chestnut/home/most-viewed.phtml');
    }

    protected function getAlias()
    {
        $title = $this->getConfig('most-viewed/title');
        return str_replace(' ', '-', trim(strtolower($title)));
    }

    protected function getProductCollectionCustom()
    {
        if (is_null($this->mostviewed))
        {
            $storeId    = Mage::app()->getStore()->getId();
            $perPage = $this->getConfig('most-viewed/products_per_page');
            $attributesToSelect = array('name', 'small_image','short_description','price');
            $productFlatTable = Mage::getResourceSingleton('catalog/product_flat')->getFlatTableName($storeId);

            try {
                $collection = Mage::getResourceModel('reports/product_collection')->addViewsCount();
                if(Mage::helper('catalog/product_flat')->isEnabled()){
                    $collection->joinTable(array('flat_table'=>$productFlatTable),'entity_id = entity_id', $attributesToSelect);
                    //var_dump($collection->count());exit;
                }else{
                    $collection->addAttributeToSelect($attributesToSelect);
                }
                
                $collection->setStoreId($storeId)->addStoreFilter($storeId)->setPageSize($perPage)->setCurPage(($this->getCurrentPage()) ? $this->getCurrentPage() : 1);
                Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
                Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

                $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
                $pager->setAvailableLimit(array($perPage => $perPage));
                $pager->setCollection($collection);
                $this->setChild('pager', $pager);
                $this->setTotalPageNum($pager->getLastPageNum());

                $this->mostviewed = $collection;
                return $this->mostviewed;
            } catch (Exception $e) {
                Mage::logException($e->getMessage());
            }
        }
    }
}