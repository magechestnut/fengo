<?php
class Chestnut_Fengo_Block_Social_Facebookfans extends Mage_Core_Block_Template
{
    protected $_cacheKeyArray = NULL;
    protected $_helper;
    protected $_facebookConfig;
    
    protected function _construct()
    {
        parent::_construct();

        $this->_helper = Mage::helper('fengo');
        $this->_facebookConfig = $this->getFacebookConfig();

        $this->addData(array(
            'cache_lifetime'    => 999999,
            'cache_tags'        => array(Mage_Cms_Model_Block::CACHE_TAG)
        ));
    }

    public function getFacebookConfig()
    {
        return $this->_helper->getFacebookConfig();
    }
    
    public function getCacheKeyInfo()
    {
        if (NULL === $this->_cacheKeyArray)
        {
            $this->_cacheKeyArray = array(
                'SOCIAL_FACEBOOKFANS',
                Mage::app()->getStore()->getId(),
                (int)Mage::app()->getStore()->isCurrentlySecure(),
                Mage::getDesign()->getPackageName(),
                Mage::getDesign()->getTheme('template')
            );
        }
        return $this->_cacheKeyArray;
    }

    public function isEnabledFB()
    {
        $fb = $this->_facebookConfig;

        if (!$fb['enable'])
            return false;

        return true;
    }
    
    public function getFBPageUrl() 
    {
        return $this->_helper->getFBPageUrl();
    }
    
    public function getShowPosts() 
    {
        $fb = $this->_facebookConfig;

        if (!$fb['show_posts'])
            return false;

        return true;
    }
    
    public function getSmallHeader() 
    {
        $fb = $this->_facebookConfig;

        if (!$fb['small_header'])
            return false;

        return true;
    }
    
    public function getHideCover() 
    {
        $fb = $this->_facebookConfig;

        if (!$fb['hide_cover'])
            return false;

        return true;
    }
    
    public function getShowFacepile() 
    {
        $fb = $this->_facebookConfig;

        if (!$fb['show_facepile'])
            return false;

        return true;
    }
}
