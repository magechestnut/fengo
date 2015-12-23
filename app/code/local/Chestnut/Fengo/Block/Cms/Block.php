<?php

class Chestnut_Fengo_Block_Cms_Block extends Mage_Cms_Block_Block
{
    public function getCacheKeyInfo()
    {
        return array(
            $this->getBlockId(),
            $this->getNameInLayout(),
            Mage::app()->getStore()->getId(),
            Mage::getDesign()->getPackageName(),
            Mage::getDesign()->getTheme('template'),
        );
    }
}
