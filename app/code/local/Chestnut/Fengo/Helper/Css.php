<?php

class Chestnut_Fengo_Helper_Css extends Mage_Core_Helper_Abstract 
{
    public function generate($filename, $website=null, $store=null) 
    {
        if ($website) {
            if ($store) {
                $this -> _generateStoreCss($filename, $store);
            } else {
                $this -> _generateWebsiteCss($filename, $website);
            }
        } else {$websites = Mage::app() -> getWebsites(false, true);
            foreach ($websites as $code => $website) {
                $this -> _generateWebsiteCss($filename, $code);
            }
        }
    }

    protected function _generateWebsiteCss($filename, $website) 
    {
        $website = Mage::app()->getWebsite($website);
        foreach ($website->getStoreCodes() as $store) { 
            $this -> _generateStoreCss($filename, $store);
        }
    }

    protected function _generateStoreCss($filename, $store) 
    {
        if (!Mage::app()->getStore($store)->getIsActive())
            return;
        $skinOption = array(
            '_area' => 'frontend',
            '_package' => 'fengo',
            '_theme' => 'default',
        );
        $cssDir = Mage::getDesign()->getSkinBaseDir($skinOption) . '/css/chestnut/fengo/config/';
        $cssFileName = $filename . '_' . $store . '.css';
        $cssFile = $cssDir . $cssFileName;
        $templateFile = 'chestnut/fengo/css/' . $filename . '.phtml';
        Mage::register('cssgen_store', $store);
        try {
            $templateBlock = Mage::app()->getLayout()->createBlock("core/template")->setData('area', 'frontend')->setTemplate($templateFile)->toHtml();
            if (empty($templateBlock)) {
                throw new Exception(Mage::helper('fengo') -> __("Template file is empty or doesn't exist, %s", $templateFile));
            }
            $fileIO = new Varien_Io_File();
            $fileIO -> setAllowCreateFolders(true);
            $fileIO -> open(array('path' => $cssDir));
            $fileIO -> streamOpen($cssFile, 'w+');
            $fileIO -> streamLock(true);
            $fileIO -> streamWrite($templateBlock);
            $fileIO -> streamUnlock();
            $fileIO -> streamClose();
        } catch (Exception $e) { 
            Mage::getSingleton('adminhtml/session') -> addError(Mage::helper('fengo') -> __('Failed generating CSS file: %s in %s', $cssFileName, $cssDir) . '<br/>Message: ' . $e -> getMessage());
            Mage::logException($e);
        }
        Mage::unregister('cssgen_store'); 
    }
}
