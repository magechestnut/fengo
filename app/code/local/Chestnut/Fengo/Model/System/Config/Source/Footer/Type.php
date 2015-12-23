<?php

class Chestnut_Fengo_Model_System_Config_Source_Footer_Type
{
    public function toOptionArray()
    {
        return array(
			array('value' => 'type1', 'label' => Mage::helper('fengo')->__('Footer Type 1')),
			array('value' => 'type2', 'label' => Mage::helper('fengo')->__('Footer Type 2')),
        );
    }
}