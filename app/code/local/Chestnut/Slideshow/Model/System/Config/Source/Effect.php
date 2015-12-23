<?php

class Chestnut_Slideshow_Model_System_Config_Source_Effect
{
    public function toOptionArray()
	{
		return array(
			array('value' => '',				'label' => Mage::helper('slideshow')->__(' ')),
			array('value' => 'fade',			'label' => Mage::helper('slideshow')->__('fade')),
			array('value' => 'backSlide',		'label' => Mage::helper('slideshow')->__('backSlide')),
			array('value' => 'goDown',			'label' => Mage::helper('slideshow')->__('goDown')),
			array('value' => 'fadeUp',			'label' => Mage::helper('slideshow')->__('fadeUp')),
		);
	}
}
