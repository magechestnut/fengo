<?php

class Chestnut_Menu_Model_Category_Attribute_Source_Categorylabel extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
	protected $_options;
	
	public function getAllOptions()
	{
		$menuHelper = Mage::helper('egmenu');
		
		if (!$this->_options)
		{	
			$this->_options[] =	array('value' => '', 'label' => " ");
					
			if ($tmp = trim($menuHelper->getConfig('category_labels/label1')))
			{
				$this->_options[] =	array('value' => 'label1', 'label' => $tmp);
			}
			if ($tmp = trim($menuHelper->getConfig('category_labels/label2')))
			{
				$this->_options[] =	array('value' => 'label2', 'label' => $tmp);
			}
        }
        return $this->_options;
    }
}
