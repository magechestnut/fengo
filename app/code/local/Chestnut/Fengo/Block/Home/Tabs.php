<?php

class Chestnut_Fengo_Block_Home_Tabs extends Mage_Catalog_Block_Product_Abstract
{
    protected $_tabs = array();

    protected function _construct()
    {
        parent::_construct();

        if (!$this->getTemplate())
            $this->setTemplate('chestnut/home/tabs.phtml');
    }

    public function addTab($alias, $title, $block, $template)
    {

        if (!$title || !$block || !$template) {
            return false;
        }

        $this->_tabs[] = array(
            'alias' => $alias,
            'title' => $title
        );

        $this->setChild($alias,
            $this->getLayout()->createBlock($block, $alias)
                ->setTemplate($template)
            );
    }

    public function getTabs()
    {
        return $this->_tabs;
    }
}
