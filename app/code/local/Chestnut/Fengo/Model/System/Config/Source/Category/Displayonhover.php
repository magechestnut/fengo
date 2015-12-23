<?php

class Chestnut_Fengo_Model_System_Config_Source_Category_Displayonhover
{
    public function toOptionArray()
    {
		return array(
			array('value' => 0, 'label' => Mage::helper('fengo')->__('Don\'t Display')),
            array('value' => 1, 'label' => Mage::helper('fengo')->__('Display On Hover')),
            array('value' => 2, 'label' => Mage::helper('fengo')->__('Display'))
        );
    }
}