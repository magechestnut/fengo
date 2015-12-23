<?php

class Chestnut_Fengo_Model_System_Config_Source_Font_Subset
{
	public function toOptionArray()
	{
		return array(
			array('value' => 'cyrillic',			'label' => Mage::helper('fengo')->__('Cyrillic')),
			array('value' => 'cyrillic-ext',		'label' => Mage::helper('fengo')->__('Cyrillic Extended')),
			array('value' => 'greek',				'label' => Mage::helper('fengo')->__('Greek')),
			array('value' => 'greek-ext',			'label' => Mage::helper('fengo')->__('Greek Extended')),
			array('value' => 'khmer',				'label' => Mage::helper('fengo')->__('Khmer')),
			array('value' => 'latin',				'label' => Mage::helper('fengo')->__('Latin')),
			array('value' => 'latin-ext',			'label' => Mage::helper('fengo')->__('Latin Extended')),
			array('value' => 'vietnamese',			'label' => Mage::helper('fengo')->__('Vietnamese')),
		);
	}
}