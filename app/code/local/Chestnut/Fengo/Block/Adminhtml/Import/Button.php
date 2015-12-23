<?php

class Chestnut_Fengo_Block_Adminhtml_Import_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{    
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$elementOriginalData = $element->getOriginalData();
		$type = $elementOriginalData['cms_type'];		
		$label = $elementOriginalData['label'];
		$url = $this->getUrl('fengo/adminhtml_import/' . $type);
		
		$html = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setType('button')
			->setLabel($label)
			->setOnClick("setLocation('$url')")
			->toHtml();
			
        return $html;
    }
}
