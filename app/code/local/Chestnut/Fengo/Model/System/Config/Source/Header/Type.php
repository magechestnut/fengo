<?php

class Chestnut_Fengo_Model_System_Config_Source_Header_Type
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'type1',  'label' => Mage::helper('fengo')->__('Type 1')),
            array('value' => 'type2',  'label' => Mage::helper('fengo')->__('Type 2')),
            array('value' => 'type3',  'label' => Mage::helper('fengo')->__('Type 3')),
            array('value' => 'type4',  'label' => Mage::helper('fengo')->__('Type 4')),
        );
    }
}