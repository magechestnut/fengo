<?php

class Chestnut_Fengo_Model_System_Config_Source_Demo_Type
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'type1',  'label' => Mage::helper('fengo')->__('Type 1')),
            array('value' => 'type2',  'label' => Mage::helper('fengo')->__('Type 2')),
            array('value' => 'type3',  'label' => Mage::helper('fengo')->__('Type 3')),
            array('value' => 'type4',  'label' => Mage::helper('fengo')->__('Type 4')),
            // array('value' => 'type5',  'label' => Mage::helper('fengo')->__('Type 5')),
            // array('value' => 'type6',  'label' => Mage::helper('fengo')->__('Type 6')),
            // array('value' => 'type7',  'label' => Mage::helper('fengo')->__('Type 7')),
            // array('value' => 'type8',  'label' => Mage::helper('fengo')->__('Type 8')),
            // array('value' => 'type9',  'label' => Mage::helper('fengo')->__('Type 9')),
            // array('value' => 'type10',  'label' => Mage::helper('fengo')->__('Type 10')),
        );
    }
}