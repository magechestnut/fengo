<?php

class Chestnut_Slideshow_Model_System_Config_Source_Width
{
    public function toOptionArray()
	{
		return array(
			array('value' => 'viewport', 'label' => Mage::helper('slideshow')->__('Fit to Viewport')),
			array('value' => 'container', 'label' => Mage::helper('slideshow')->__('Fit to Container')),
		);
	}
}
