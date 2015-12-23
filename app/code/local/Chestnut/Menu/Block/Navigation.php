<?php

class Chestnut_Menu_Block_Navigation extends Mage_Catalog_Block_Navigation
{
    public $_helper = null;
    protected $_classic = 'classic';
    protected $_wide = 'wide';
    protected $_tplProcessor = null;
    protected $_categoryBlockInstance = array();
    
    protected function _construct()
    {
        if (!$this->_helper)
            $this->_helper = Mage::helper('egmenu');
        
        if (!$this->getTemplate())
            $this->setTemplate('chestnut/menu/top.phtml');
    }

    protected function getGroupingConfig($store = null)
    {
        return $this->_helper->getConfig('general/category_grouping', $store);
    }

    protected function getCategoryMenuConfig($store = null)
    {
        return $this->_helper->getCategoryDesignConfig($store);
    }

    protected function getAdditionalMenuConfig($store = null)
    {
        return $this->_helper->getAdditionalDesignConfig($store);
    }

    protected function getCategoryBlockInstance($catId = null)
    {
        if (!$catId)
            $catId = $this->getRootCategoryId();

        $blockInstance = $this->_categoryBlockInstance;
        if (!array_key_exists($catId, $blockInstance)) {
            $blockInstance[$catId] = Mage::getModel('egmenu/blocks')->getCollection()->addFieldToFilter('cat_id', $catId)->getFirstItem();
        }

        return $blockInstance[$catId];
    }

    protected function getCategoryStaticBlock($block = NULL, $catId = null)
    {
        if (is_null($block)) {
            return '';
        }

        if (!$catId) {
            $catId = $this->getRootCategoryId();
        }

        if (!$this->_tplProcessor) {
            $this->_tplProcessor = Mage::helper('cms')->getBlockTemplateProcessor();
        }

        return $this->_tplProcessor->filter(trim($this->getCategoryBlockInstance($catId)->getData($block)));
    }

    protected function getCategoryLabelHtml($catId = null)
    {
        $label = '';

        if (!$catId) {
            $catId = $this->getRootCategoryId();
        }
        $block = $this->getCategoryBlockInstance($catId);

        if ($block->getCategoryLabel()) {
            $label .= '<span class="category-label category-label-' . $block->getCategoryLabel() . '">';
            $label .= $this->_helper->getCategoryLabel($block->getCategoryLabel());
            $label .= '</span>';
        }

        return $label;
    }

    protected function hasCategoryStaticBlock($catId = null)
    {
        $block = $this->getCategoryBlockInstance($catId);
        return ($block->getLeftBlock() || $block->getRightBlock() || $block->getTopBlock() || $block->getBottomBlock());
    }

    protected function getCategoryMenuStyle($categoryId, $store = NULL)
    {
        $style = 'wide';

        if (!$config = $this->getCategoryMenuConfig($store))
            return $style;

        foreach ($config['category'] as $index => $id) {
            if ($id == $categoryId) {
                $style = $config['style'][$index];
            }
        }

        return $style;
    }

    public function getMobileMenuHtml()
    {
        $html = $this->getMobileHomeLink();
        $html .= $this->getMobileCategoriesHtml($this->getTopLevelCategories());
        $html .= $this->getMobileCustomLinks();
        return $html;
    }

    protected function getMobileCategoriesHtml($categories, $level = 0)
    {
        $html = '';
        
        if ($count = count($categories))
        {
            foreach ($categories as $category) 
            {
                if (!$category->getIsActive()) continue;
                
                $active = '';
                $id = $category->getId();
                if ($this->isCategoryActive($category)) {
                    $active = ' active';
                    if ($id == $this->getCurrentCategory()->getId()) $active .= ' current active';
                }
                
                $children = $this->getActiveChildren($category, $level);
                $hasChild = count($children) > 0;
                $parent = ($hasChild) ? ' parent' : '';
                
                $html .= '<li id="mobile-' . $id . '" class="level' . $level . $active . $parent . '">';  
                $html .= '<a class="level' . $level . '" href="' . $this->getCategoryUrl($category) . '"><span>' . $this->escapeHtml($category->getName()) . '</span></a>';
                if ($hasChild) {
                    $html.= '<span class="opener"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>';
                    $html.= '<ul class="level' . $level . $parent . ' clearfix">';
                    $html.= $this->getMobileCategoriesHtml($children, $level + 1);
                    $html.= '</ul>';
                }
                $html .= '</li>';
            }
        }
        
        return $html;
    }

    protected function getMobileHomeLink()
    {
        return $this->_helper->getMobileHomeLink();
    }

    protected function getMobileCustomLinks($store = null)
    {
        $html = '';

        if (is_null($store))
            $store = Mage::app()->getStore()->getId();
       
        if (!$config = $this->getAdditionalMenuConfig($store))
            return $html;

        foreach ($config['link_label'] as $index => $label) {
            $html .= '<li class="level0' . $isParent . '"><a href="';
            $html .= $config['link_url'][$index];
            $html .= '"><span>';
            $html .= $this->__($label);
            $html .= '</span></a></li>';
        }

        return $html; 
    }

    public function getMenuHtml()
    {
        $html = $this->getHomeLink();
        if ($this->getGroupingConfig()) {
            $html .= $this->getGroupedCategoriesHtml();
        } else {
            foreach ($this->getTopLevelCategories() as $category) {
                $html .= $this->getCategoriesHtml($category);
            }
        }
        $html .= $this->getCustomLinks();
        return $html;
    }

    protected function getHomeLink()
    {
        return $this->_helper->getHomeLink();
    }

    protected function getRootCategoryId()
    {
        return Mage::app()->getStore()->getRootCategoryId();
    }

    protected function getRootCategory()
    {
        return Mage::getModel('catalog/category')->load($this->getRootCategoryId());
    }

    protected function getTopLevelCategories()
    {
        return $this->getStoreCategories();
    }

    protected function getCustomLinks($store = NULL)
    {
        $html = '';

        if (!$config = $this->getAdditionalMenuConfig($store))
            return $html;

        foreach ($config['link_label'] as $index => $label) {
            $tmp = '';
            $isParent = '';
            if (($blockId = $config['static_block'][$index]) &&
                ($block = Mage::getBlockSingleton('cms/block')->setBlockId($blockId)->toHtml())) {
                $tmp .= '<div class="level0-wrapper ' . $config['menu_style'][$index] . '" style="display: none;">';
                $tmp .= $block;
                $tmp .= '</div>';
                $isParent .= ' parent'; 
            }

            $html .= '<li class="menu level-top custom-link ' . $config['menu_style'][$index] . $isParent . '"><a href="';
            $html .= $config['link_url'][$index];
            $html .= '"><span>';
            $html .= $this->__($label);
            $html .= '</span></a>';
            $html .= $tmp;
            $html .= '</li>';
        }

        return $html; 
    }

    protected function getGroupedCategoriesHtml()
    {
        $html = '';

        $children   = $this->getStoreCategories();
        $block      = $this->getCategoryBlockInstance();

        $html .= '<li class="menu level-top parent">';
        $html .= '<a href="#"><span>' . $this->getGroupedCategoriesLabel() . $this->getCategoryLabelHtml() . '</span></a>';

        $columns = (int)$this->_helper->getConfig('menu_content/columns_count');
        if (count($children) || $this->hasCategoryStaticBlock())
        {
            $html .= '<div class="level0-wrapper">';
            if ($block->getTopBlock()) {
                $html .= '<div class="row">';
                $html .= $this->getCategoryStaticBlock('top_block');
                $html .= '</div>';
            }
            if ($block->getLeftBlock() || $block->getRightBlock()) {
                $html .= '<div class="row">';
            }
            if ($block->getLeftBlock()) {
                $html .= '<div class="grid12-' . $block->getLeftBlockWidth() . '">';
                $html .= $this->getCategoryStaticBlock('left_block');
                $html .= '</div>';
            }
            if (count($children))
            {
                $childrenWidth = 12 - ($block->getLeftBlockWidth() + $block->getRightBlockWidth());
                $html .= '<div class="category-block grid12-' . $childrenWidth . ' clearfix">';
                $html .= $this->drawColumns($children, $columns);
                $html .= '</div>';
            }
            if ($block->getRightBlock()) {
                $html .= '<div class="grid12-' . $block->getRightBlockWidth() . '">';
                $html .= $this->getCategoryStaticBlock('right_block');
                $html .= '</div>';
            }
            if ($block->getLeftBlock() || $block->getRightBlock()) {
                $html .= '</div>';
            }
            if ($block->getBottomBlock()) {
                $html .= '<div class="row">';
                $html .= $this->getCategoryStaticBlock('bottom_block');
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</li> ';
        
        return $html;
    }

    protected function getGroupedCategoriesLabel()
    {
        $label = $this->_helper->getConfig('general/group_label');
        return ($label) ? $label : 'Shop';
    }

    protected function getCategoriesHtml($category, $level = 0)
    {
        if (!$category->getIsActive()) return;
        $html = '';
        
        $id         = $category->getId();
        $menuStyle  = $this->getCategoryMenuStyle($id);
        $block      = $this->getCategoryBlockInstance($id);
        
        $children = $this->getActiveChildren($category, $level);
        
        $active = ''; if ($this->isCategoryActive($category)) $active = ' active';

        $html .= '<li id="menu-' . $id . '" class="menu' . $active . ' ' . $menuStyle . ' level-top parent">';
        $html .= '<a href="' . $this->getCategoryUrl($category).'"><span>' . $this->escapeHtml($category->getName()) . $this->getCategoryLabelHtml($id) . '</span></a>';

        $columns = (int)$this->_helper->getConfig('menu_content/columns_count');
        if ($this->hasCategoryStaticBlock($id) || count($children))
        {
            $html .= '<div class="level0-wrapper ' . $menuStyle . '">';
            if ($block->getTopBlock()) {
                $html .= '<div class="row">';
                $html .= $this->getCategoryStaticBlock('top_block', $id);
                $html .= '</div>';
            }
            if ($block->getLeftBlock() || $block->getRightBlock()) {
                $html .= '<div class="row">';
            }
            if ($block->getLeftBlock()) {
                $html .= '<div class="grid12-' . $block->getLeftBlockWidth() . '">';
                $html .= $this->getCategoryStaticBlock('left_block', $id);
                $html .= '</div>';
            }
            if (count($children))
            {
                $childrenWidth = 12 - ($block->getLeftBlockWidth() + $block->getRightBlockWidth());
                $html .= '<div class="category-block grid12-' . $childrenWidth . ' clearfix">';
                $html .= $this->drawColumns($children, $columns, $menuStyle);
                $html .= '</div>';
            }
            if ($block->getRightBlock()) {
                $html .= '<div class="grid12-' . $block->getRightBlockWidth() . '">';
                $html .= $this->getCategoryStaticBlock('right_block', $id);
                $html .= '</div>';
            }
            if ($block->getLeftBlock() || $block->getRightBlock()) {
                $html .= '</div>';
            }
            if ($block->getBottomBlock()) {
                $html .= '<div class="row">';
                $html .= $this->getCategoryStaticBlock('bottom_block', $id);
                $html .= '</div>';
            }
            $html .= '</div>';
        }
        $html .= '</li> ';
        
        return $html;
    }

    protected function drawColumns($children, $columns = 1, $menuStyle = 'wide')
    {
        $html = '';
        
        if ($menuStyle == $this->_classic) {
            return $this->getChildrenHtml($children, 1);
        }

        $cols = array();
        $cols = array_pad($cols, $columns, array());
        $col = 0;
        foreach ($children as $key => $value) {
            $cols[$col][$key] = $value;
            if (++$col == $columns) $col = 0;
        }
        
        $width = number_format(100/$columns, 2, '.', '');
        $i = 1;
        foreach ($cols as $key => $value) {
            if (!count($value)) continue;
            $class = 'column';
            if ($i % 2) $class.= ' odd'; else $class.= ' even';
            if ($i == 1) $class.= ' first';
            if ($i == count($cols)) $class.= ' last';
            $html.= '<div class="' . $class . '" style="width: ' . $width . '%">';
            $html.= $this->getChildrenHtml($value, 1);
            $html.= '</div>';
            $i++;
        }

        return $html;
    }

    protected function getChildrenHtml($children, $level = 1)
    {
        $html = '<ul class="level' . $level . '">';

        foreach ($children as $child) {
            if (is_object($child) && $child->getIsActive()) {
                
                $active = '';
                if ($this->isCategoryActive($child)) {
                    $active = ' active';
                    if ($child->getId() == $this->getCurrentCategory()->getId()) $active = ' current';
                }
                
                $html .= '<li class="level' . $level . $active . '">';
                $html .= '<a class="level' . $level . $active . '" href="' . $this->getCategoryUrl($child) . '"><span>' . $this->escapeHtml($child->getName()) . $this->getCategoryLabelHtml($child->getId()) . '</span></a>';
                
                $activeChildren = $this->getActiveChildren($child, $level);
                if (count($activeChildren) > 0) {
                    $html.= $this->getChildrenHtml($activeChildren, $level + 1);
                }
                $html .= '</li>';
            }
        }
        $html.= '</ul>';

        return $html;
    }

    protected function getActiveChildren($parent, $level)
    {
        $activeChildren = array();

        $depth = (int)$this->_helper->getConfig('general/maximal_depth');
        
        if ($level >= ($depth - 1)) return $activeChildren;
        
        if ($this->helper('catalog/category_flat')->isEnabled()) {
            $children = $parent->getChildrenNodes();
            $childrenCount = count($children);
        } else {
            $children = $parent->getChildren();
            $childrenCount = $children->count();
        }
        
        if ($children && $childrenCount) {
            foreach ($children as $child) {
                array_push($activeChildren, $child);
            }
        }
        
        return $activeChildren;
    }

    public function getEffectParams()
    {
        return $this->_helper->getEffectParams();
    }
}
