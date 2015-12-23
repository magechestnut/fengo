<?php

class Chestnut_Menu_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getConfig($path, $store = NULL) 
    {
        return Mage::getStoreConfig('egmenu/' . $path, $store);
    }    
    
    public function getHomeLink()
    {
        $home = '';
        if ($this->getConfig('general/show_home_link')) {
            $home .= '<li id="home" class="level-top"><a href="';
            $home .= Mage::getBaseUrl();
            $home .= '"><span>';
            $home .= $this->__('Home');
            $home .= '</span></a></li>';
        }
        
        return $home;
    }    
    
    public function getMobileHomeLink()
    {
        $home = '';
        if ($this->getConfig('general/show_home_link')) {
            $home .= '<li id="mobile-home" class="level0"><a href="';
            $home .= Mage::getBaseUrl();
            $home .= '"><span>';
            $home .= $this->__('Home');
            $home .= '</span></a></li>';
        }
        
        return $home;
    }

    public function getCategoryLabel($value = null)
    {
        if (!$value) return;
        return $this->getConfig('category_labels/' . $value);
    }

    public function getCategoryDesignConfig($store = NULL)
    {
        return unserialize($this->getConfig('category_menu/design', $store));
    }

    public function getAdditionalDesignConfig($store = NULL)
    {
        return unserialize($this->getConfig('custom_menu/links', $store));
    }

    public function getEffectParams()
    {
        $effectConfig = $this->getConfig('menu_content');
        $effectParams = array();
        $effectParams['show_delay'] = ($effectConfig['delay_displaying']) ? $effectConfig['delay_displaying'] : 150;
        $effectParams['hide_delay'] = ($effectConfig['delay_hiding']) ? $effectConfig['delay_hiding'] : 100; 
        $effectParams['fade_in'] = ($effectConfig['fadein_duration']) ? $effectConfig['fadein_duration'] : 300; 
        $effectParams['fade_out'] = ($effectConfig['fadeout_duration']) ? $effectConfig['fadeout_duration'] : 300;

        return $effectParams;
    }
}
