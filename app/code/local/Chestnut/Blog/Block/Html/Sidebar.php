<?php

class Chestnut_Blog_Block_Html_Sidebar extends Chestnut_Blog_Block_Abstract
{
    public function getRecent()
    {
        if ($this->getBlogWidgetRecentCount()) {
            $size = $this->getBlogWidgetRecentCount();
        } else {
            $size = self::$_helper->getRecentPage();
        }

        if ($size) {
            $collection = clone self::$_collection; 
            $collection->setPageSize($size);

            foreach ($collection as $item) {
                $item->setAddress($this->getBlogUrl($item->getIdentifier()));
            }

            return $collection;
        }

        return false;
    }

    protected function getCategories($level = 0, $parent = 0)
    {
        $collection = Mage::getModel('blog/category')
                ->getCollection()
                ->addLevelFilter($level)
                ->addParentFilter($parent)
                ->addStoreFilter(Mage::app()->getStore()->getId())
                ->setOrder('sort_order', 'asc');
      
        foreach ($collection as $item) {            
            $item->setAddress($this->getBlogUrl($item->getIdentifier()));
        }
        
        return $collection;
    }

    public function getCategoriesAccordion($level = 0, $parent = 0)
    {
        $accordion = '';
        $categories = array();
        if ($categories = $this->getCategories($level, $parent)) {
            $count = 0;
            $isFirst = ' first';
            foreach ($categories as $category) {
                $count++;
                $isLast = ($categories->count() == $count) ? ' last': '';
                if ($this->getCategories($level+1, $category->getId())->count() > 0) {
                    $accordion .= '<li id="category-' . $category->getId() . '" class="level' . $level . ' parent' . $isFirst . $isLast . '">';
                    $accordion .= '<a href="' . $category->getAddress() .'" class="level' . $level . '">' . $category->getTitle() . '</a>';
                    $accordion .= '<span class="opener"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>';
                    $accordion .= '<ul class="level' . $level . ' parent clearfix">';
                    $accordion .= $this->getCategoriesAccordion($level+1, $category->getId());
                    $accordion .= '</ul>';
                } else {
                    $accordion .= '<li id="category-' . $category->getId() . '" class="level' . $level . $isFirst . $isLast . '">';
                    $accordion .= '<a href="' . $category->getAddress() .'" class="level' . $level . '">' . $category->getTitle() . '</a>';
                }
                $accordion .= '</li>';
                $isFirst = '';
            }
        }

        return $accordion;
    }
    
    protected function _beforeToHtml() {        
        return $this;        
    }
    
    protected function _toHtml()
    {
        if (self::$_helper->getEnabled()) {

            $parent = $this->getParentBlock();

            if (!$parent) {
                return null;
            }

            $showLeft = Mage::getStoreConfig('blog/menu/left');
            $showRight = Mage::getStoreConfig('blog/menu/right');
            
            $isBlogPage = Mage::app()->getRequest()->getModuleName() == Chestnut_Blog_Helper_Data::DEFAULT_ROOT;

            $leftAllowed = ($isBlogPage && ($showLeft == 2)) || ($showLeft == 1);
            $rightAllowed = ($isBlogPage && ($showRight == 2)) || ($showRight == 1);

            if (!$leftAllowed && ($parent->getNameInLayout() == 'left')) {
                return null;
            }
            if (!$rightAllowed && ($parent->getNameInLayout() == 'right')) {
                return null;
            }

            return parent::_toHtml();
        }
    }

    public function getComments()
    {
        $count = self::$_helper->getConfig(Chestnut_Blog_Helper_Config::XML_COMMENTS_COUNT);
        $collection = Mage::getModel('blog/comment')->getCollection();
        $collection->setPageSize($count);

        return $collection;
    }
}