<?php

class Chestnut_Blog_Block_Adminhtml_Post_Renderer_Identifier extends Mage_Adminhtml_Block_Catalog_Form_Renderer_Fieldset_Element
{
    public function getElementHtml()
    {
        $element = $this->getElement();
        if(!$element->getValue()) {
            return parent::getElementHtml();
        }
        $element->setOnkeyup("onChanged('" . $element->getHtmlId() . "')");
        $element->setOnchange("onChanged('" . $element->getHtmlId() . "')");

        $data['html_id'] = $element->getHtmlId() . '_create_redirect';
        $data['label'] = Mage::helper('blog')->__('Create Permanent Redirect for old URL');
        $data['value'] = $element->getValue();
        $data['checked'] = true;
        $data['disabled'] = true;
        $data['name'] = $data['html_id'];
        $checkbox = new Varien_Data_Form_Element_Checkbox($data);
        $checkbox->setForm($element->getForm());
        $script = "
        <script type='text/javascript'>
        function onChanged(htmlId) {
            htmlId = $(htmlId);
            var chbx = htmlId.next('input[type=checkbox]');
            var oldValue = chbx.value;
            chbx.disabled = (oldValue == htmlId.value);
        }
        </script>";

        return parent::getElementHtml() . '<br/>' . $checkbox->getElementHtml() . $checkbox->getLabelHtml() . $script;
    }
}