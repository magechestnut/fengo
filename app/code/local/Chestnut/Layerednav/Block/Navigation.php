<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Block_Navigation extends Mage_Catalog_Block_Navigation
{
    public function getSideNavigation($categories, $level = 0)
    {
        $html = '';
        
        if ($count = count($categories))
        {
            $index = 1;
            foreach ($categories as $category) 
            {
                if (!$category->getIsActive()) continue;
                
                $active = '';
                $id = $category->getId();
                if ($this->isCategoryActive($category)) {
                    $active = ' active';
                    if ($id == $this->getCurrentCategory()->getId()) $active .= ' current';
                }
                
                $children = $this->getActiveChildren($category, $level);
                $hasChild = count($children) > 0;
                $parent = ($hasChild) ? ' parent' : '';
                $class = '';
                if ($index == 1) $class = ' first';
                if ($index == $count) $class = ' last';
                $last = true;
                
                $html .= '<li id="category-' . $id . '" class="level' . $level . $active . $parent . $class . '">';  
                $html .= '<a class="level' . $level . '" href="' . $this->getCategoryUrl($category) . '"><span>' . $this->escapeHtml($category->getName()) . '</span></a>';
                if ($hasChild) {
                    $html.= '<span class="opener"><i class="fa fa-plus"></i><i class="fa fa-minus"></i></span>';
                    $html.= '<ul class="level' . $level . $parent . ' clearfix">';
                    $html.= $this->getSideNavigation($children, $level + 1);
                    $html.= '</ul>';
                }
                $html .= '</li>';
                $index++;
            }
        }
        
        return $html;
    }

    protected function getActiveChildren($parent, $level)
    {
        $activeChildren = array();

        $depth = 3;
        
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
}