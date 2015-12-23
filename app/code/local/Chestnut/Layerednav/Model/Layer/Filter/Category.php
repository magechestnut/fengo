<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Model_Layer_Filter_Category extends Mage_Catalog_Model_Layer_Filter_Category 
{
    protected $cat = null;

    public function apply(Zend_Controller_Request_Abstract $request, $filterBlock) 
    {
        $catId = (int) Mage::helper('chestnut_layerednav')->getParam($this->getRequestVar());
        if ($catId) {
            $request->setParam($this->getRequestVar(), $catId);
            parent::apply($request, $filterBlock);
        }
        return $this;
    }

    protected function _getItemsData() 
    {
        $key = $this->getLayer()->getStateKey() . '_SUBCATEGORIES';
        $key .= Mage::helper('chestnut_layerednav')->getCacheKey('cat');
        $pageKey = Mage::getBlockSingleton('page/html_pager')->getPageVarName();
        $queryStr = Mage::helper('chestnut_layerednav')->getParams(true, $pageKey);
        $data = $this->getLayer()->getAggregator()->getCacheData($key);

        if ($data === null) {
            $category = null;
            $category = $this->getCategory();
            $categories = $category->getChildrenCategories();
            $data = array();
            $level = 0;
            $parent = null;
            if ($category->getLevel() > 1) { 
                $parent = $category->getParentCategory();

                ++$level;
                if ($parent->getLevel() > 1) {
                    $data[] = array(
                        'label' => $parent->getName(),
                        'value' => $parent->getUrl(),
                        'level' => $level,
                        'category_id' => $parent->getId(),
                        'uri' => $queryStr,
                    );
                }
                
                ++$level;
                $data[] = array(
                    'label' => $category->getName(),
                    'value' => '',
                    'level' => $level,
                    'is_current' => true,
                    'category_id' => $category->getId(),
                    'uri' => $queryStr,
                );
            }

            ++$level;
            foreach ($categories as $cat) {
                if ($cat->getIsActive() && $cat->getProductCount()) {
                    $data[] = array(
                        'label' => $cat->getName(),
                        'value' => $cat->getId(),
                        'count' => $cat->getProductCount(),
                        'level' => $level,
                        'category_id' => $cat->getId(),
                        'uri' => $cat->getUrl(),
                    );
                }
            }

            for ($i = 0, $n = sizeof($data); $i < $n; ++$i) {
                $url = $data[$i]['uri'];
                $pos = strpos($url, '?');
                if ($pos)
                    $url = substr($url, 0, $pos);
                $data[$i]['uri'] = $url . $queryStr;
            }
            $tags = $this->getLayer()->getStateTags();
            $this->getLayer()->getAggregator()->saveCacheData($data, $key, $tags);
        }
        
        return $data;
    }

    protected function _initItems() 
    {
        $data = $this->_getItemsData();
        $items = array();
        foreach ($data as $itemData) {
            $obj = new Varien_Object();
            $obj->setData($itemData);
            $obj->setUrl($itemData['value']);

            $items[] = $obj;
        }
        $this->_items = $items;
        return $this;
    }
}
