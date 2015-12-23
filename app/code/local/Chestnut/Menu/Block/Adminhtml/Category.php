<?php

class Chestnut_Menu_Block_Adminhtml_Category extends Mage_Adminhtml_Block_System_Config_Form_Field 
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) 
    {
        $this->setElement($element);
        $output = '<script type="text/javascript">//<![CDATA[' . "\n";
        $output .= '    var egcategory_template = \'' . str_replace("'", "\'", $this->_getRowHtml()) .'\';' . "\n";
        $output .= '//]]></script>' . "\n";
        $output .= '<input type="hidden" name="' . $this->getElement()->getName() . '" value="">';
        $output .= '<table style="border-collapse:collapse;"><tbody>';
        if ($this->getElement()->getData('value')) {
            foreach ($this->getElement()->getData('value/category') as $index => $value) {
                $output .= $this->_getRowHtml($index);
            }
        }
        $output .= '<tr><td colspan="2" style="padding: 4px 0;">';
        $output .= $this->_getAddButtonHtml();
        $output .= '</td></tr>';
        $output .= '</tbody></table>';
        return $output;
    }

    protected function _getRowHtml($index = -1) 
    {
        $output = '<tr>';
        $output .= '<td style="padding: 2px 0;">';
        $output .= $this->_getCategoriesHtml($index);
        $output .= '</td>';
        $output .= '<td style="padding: 2px 0;">';
        $output .= $this->_getMenuStyle($index);
        $output .= '</td>';
        $output .= '<td style="padding: 2px 4px;">';
        $output .= $this->_getRemoveButtonHtml();
        $output .= '</td>';
        $output .= '</tr>';
        return $output;
    }

    protected function _getAddButtonHtml() 
    {
        return $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('add')
            ->setLabel($this->__('Add New'))
            ->setOnClick("Element.insert($(this).up('tr'), {before: egcategory_template})")
            ->toHtml();
    }

    protected function _getRemoveButtonHtml() 
    {
        return $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setType('button')
            ->setClass('delete v-middle')
            ->setLabel($this->__('Delete'))
            ->setOnClick("Element.remove($(this).up('tr'))")
            ->toHtml();
    }

    protected function _getCategoriesHtml($index = -1)
    {
        $collection = Mage::getResourceModel('catalog/category_collection');
        $collection->addAttributeToSelect('name')
            ->addFieldToFilter('level', array('eq' => 2))
            ->load();

        $output = '<select style="width:274px;min-height:20px;margin-right:5px;" class="required-entry" name="' . $this->getElement()->getName() . '[category][]">';
        $output .= '<option value="">' . Mage::helper('adminhtml')->__('-- Please Select a Category --') . '</option>';
        
        $selected = -1;
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/category/' . $index);
        }
        foreach ($collection as $category) {
            $output .= '<option value="' . $category->getId() . '"' . (($selected == $category->getId()) ? ' selected' : '') . '>' . $category->getName() . '</option>';
        }
        return $output . '</select>';
    }

    protected function _getMenuStyle($index = -1)
    {
        $selected = '';
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/style/' . $index);
        }
        $output = '<select style="width:274px;min-height:20px;" class="required-entry" name="' . $this->getElement()->getName() . '[style][]">';
        $output .= '<option value="">' . Mage::helper('adminhtml')->__('-- Please Select a Style --') . '</option>';
        $output .= '<option value="wide"' . (($selected == 'wide') ? ' selected' : '') . '>Wide</option>';
        $output .= '<option value="classic"' . (($selected == 'classic') ? ' selected' : '') . '>Classic</option>';
        $output .= '</select>';
        return $output;
    }
}