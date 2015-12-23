<?php

class Chestnut_Menu_Model_Category_Attribute_Source_Width extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{	
	public function getAllOptions()
	{
		if (!$this->_options)
		{
			$this->_options = array(
				array('value' => '0',		'label' => ' '),
				array('value' => '1',		'label' => '1'),
				array('value' => '2',		'label' => '2'),
				array('value' => '3',		'label' => '3'),
				array('value' => '4',		'label' => '4'),
				array('value' => '5',		'label' => '5'),
				array('value' => '6',		'label' => '6'),
				array('value' => '7',		'label' => '7'),
				array('value' => '8',		'label' => '8'),
				array('value' => '9',		'label' => '9'),
				array('value' => '10',		'label' => '10'),
				array('value' => '11',		'label' => '11'),
				array('value' => '12',		'label' => '12')
			);
		}
		return $this->_options;
	}
}
