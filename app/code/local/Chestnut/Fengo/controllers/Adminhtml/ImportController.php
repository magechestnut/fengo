<?php

class Chestnut_Fengo_Adminhtml_ImportController extends Mage_Adminhtml_Controller_Action {

    public function blocksAction() {
        $theme = Mage::helper('fengo');
        $overwrite = $theme -> getSetting('synchronize/overwrite_blocks');
        $theme -> importCmsItems('cms/block', 'blocks', $overwrite);
        $this -> _redirectReferer();
    }

    public function pagesAction() {
        $theme = Mage::helper('fengo');
        $overwrite = $theme -> getSetting('synchronize/overwrite_pages');
        $theme -> importCmsItems('cms/page', 'pages', $overwrite);
        $this -> _redirectReferer();
    }

}
