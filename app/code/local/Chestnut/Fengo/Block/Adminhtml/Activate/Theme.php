<?php

class Chestnut_Fengo_Block_Adminhtml_Activate_Theme extends Mage_Adminhtml_Block_System_Config_Form_Field
{    
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$elementOriginalData = $element->getOriginalData();
		$type = $elementOriginalData['install_type'];		
		$label = $elementOriginalData['label'];
		$url = $this->getUrl('fengo/adminhtml_install/' . $type);
		
		$html = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setType('button')
			->setLabel($label)
			->setOnClick("setLocation('$url')")
			->toHtml();
			
        return $html;
    }
}
