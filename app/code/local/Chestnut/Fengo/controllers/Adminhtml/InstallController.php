<?php

class Chestnut_Fengo_Adminhtml_InstallController extends Mage_Adminhtml_Controller_Action 
{
    public function themeAction() {
        $theme = Mage::helper('fengo');
        $theme->installTheme();
        $this->_redirectReferer();
    }

    public function demosAction() {
        $theme = Mage::helper('fengo');
        $style = $this->getRequest()->getParam('style');
        $theme->activateDemo($style);
        $this->_redirectReferer();
    }
}
