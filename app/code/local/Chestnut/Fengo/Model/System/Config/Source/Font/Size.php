<?php

class Chestnut_Fengo_Model_System_Config_Source_Font_Size
{
    public function toOptionArray()
    {
		return array(
			array('value' => '12px',	'label' => Mage::helper('fengo')->__('12 px')),
			array('value' => '13px',	'label' => Mage::helper('fengo')->__('13 px')),
            array('value' => '14px',	'label' => Mage::helper('fengo')->__('14 px'))
        );
    }
}