<?php

class Chestnut_Fengo_Model_System_Config_Source_Category_Hoverimage
{
    public function toOptionArray()
    {
        return array(
			array('value' => 'label', 'label' => Mage::helper('fengo')->__('Label')),
            array('value' => 'position', 'label' => Mage::helper('fengo')->__('Sort Order'))
        );
    }
}