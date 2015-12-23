<?php

class Chestnut_Fengo_Model_System_Config_Source_Progress_Theme
{
    public function toOptionArray()
    {
		return array(
			array('value' => 'blue',	'label' => Mage::helper('fengo')->__('blue')),
			array('value' => 'blueOverlay',	'label' => Mage::helper('fengo')->__('blueOverlay')),
            array('value' => 'blueOverlayRadius',	'label' => Mage::helper('fengo')->__('blueOverlayRadius')),
            array('value' => 'blueOverlayRadiusHalfOpacity',	'label' => Mage::helper('fengo')->__('blueOverlayRadiusHalfOpacity')),
            array('value' => 'blueOverlayRadiusWithPercentBar',	'label' => Mage::helper('fengo')->__('blueOverlayRadiusWithPercentBar')),
            array('value' => 'blackRadiusInputs',	'label' => Mage::helper('fengo')->__('blackRadiusInputs')),
        );
    }
}