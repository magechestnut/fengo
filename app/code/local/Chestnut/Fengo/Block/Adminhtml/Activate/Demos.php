<?php

class Chestnut_Fengo_Block_Adminhtml_Activate_Demos extends Mage_Adminhtml_Block_System_Config_Form_Field
{    
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
		$elementOriginalData = $element->getOriginalData();
		$type = $elementOriginalData['install_type'];
		$style = Mage::getStoreConfig('theme_activate/activate_demos/demo_style');

		$class = $elementOriginalData['class'];
		$url = $this->getUrl('fengo/adminhtml_install/' . $type, array('style' => $style));
		
		$html = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setType('button')
			->setClass($class)
			->setLabel('Activate')
			->setOnClick("setLocation('$url')")
			->toHtml();
			
        return $html;
    }
}
