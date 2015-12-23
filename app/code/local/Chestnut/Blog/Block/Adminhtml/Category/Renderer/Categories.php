<?php

class Chestnut_Blog_Block_Adminhtml_Category_Renderer_Categories extends Mage_Adminhtml_Block_Catalog_Form_Renderer_Fieldset_Element
{
    public function getElementHtml()
    {
        $element = $this->getElement();
        $element->setOnchange("SubmitRequest('" . $element->getHtmlId() . "')");

        $categories = array();
        $collection = Mage::getModel('blog/category')->getCollection();

        if($element->getValue() > -1) {
            $elementValue = $element->getValue();
            $elementValue = ($elementValue == 0) ? $elementValue : $elementValue - 1;
            $collection = $collection->addLevelFilter($elementValue);
        }
        $collection->setOrder('sort_order', 'asc');
        foreach ($collection as $cat) {
            $categories[] = (array(
                'label' => (string) $cat->getTitle(),
                'value' => $cat->getCatId()
            ));
        }

        $data['html_id'] = 'parent';
        $data['values'] = $categories;
        $data['disabled'] = true;
        $data['style'] = 'margin-top:5px';
        $data['name'] = $data['html_id'];
        $multiselect = new Varien_Data_Form_Element_Multiselect($data);
        $multiselect->setForm($element->getForm());
        $script = "
        <script type='text/javascript'>
        var htmlId = '" . $element->getHtmlId() . "';
        var requestUrl = '" . Mage::helper("adminhtml")->getUrl("blog/adminhtml_category/level/level/LevelNumber/") . "'
        function SubmitRequest(htmlId)
        {
            htmlId = $(htmlId);
            var level = (htmlId.value == 0) ? htmlId.value : htmlId.value - 1;
            requestUrl.replace()
            new Ajax.Request(requestUrl.replace('LevelNumber', level), {
                method: 'get',
                onSuccess: successFunc,
                onFailure: failureFunc
            });
        }

        function successFunc(transport) {
            htmlId = $(htmlId);
            var selectbox = htmlId.next('select[id=parent]');
            var container = $('parent');
            var response = {};
            selectbox.disabled = (htmlId.value == 0);
            if (transport && transport.responseText) {
                try {
                    response = eval('(' + transport.responseText + ')');
                } catch (e) {
                    response = {};
                }
            }
            container.update(response.options);
        }

        function failureFunc(transport) {
            alert('Call is failed' );            
        }
        </script>";

        return parent::getElementHtml() . '<br/>' . $multiselect->getElementHtml() . $script;
    }
}