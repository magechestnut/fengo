<?php

class Chestnut_Fengo_Model_System_Config_Source_General_Style
{
    public function toOptionArray()
    {
        return array(
            array('value' => 'disable',  'label' => Mage::helper('fengo')->__('Disable')),
            array('value' => 'text',  'label' => Mage::helper('fengo')->__('Text')),
            array('value' => 'image',  'label' => Mage::helper('fengo')->__('Image')),
            array('value' => 'percent',  'label' => Mage::helper('fengo')->__('Percentage')),
        );
    }
}