<?php

class Chestnut_Menu_Block_Adminhtml_Custom extends Mage_Adminhtml_Block_System_Config_Form_Field 
{
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element) 
    {
        $this->setElement($element);
        $output = '<style type="text/css" scoped>' . "\n";
        $output .= '    .columns .form-list td.value {width: auto;}' . "\n";
        $output .= '</style>' . "\n";
        $output .= '<script type="text/javascript">//<![CDATA[' . "\n";
        $output .= '    var egcustom_template = \'' . str_replace("'", "\'", $this->_getRowHtml()) .'\';' . "\n";
        $output .= '//]]></script>' . "\n";
        $output .= '<input type="hidden" name="' . $this->getElement()->getName() . '" value="">';
        $output .= '<table style="border-collapse:collapse;"><tbody>';
        $output .= $this->_getHeaderHtml();
        if ($this->getElement()->getData('value')) {
            foreach ($this->getElement()->getData('value/link_label') as $index => $value) {
                $output .= $this->_getRowHtml($index);
            }
        }
        $output .= '<tr><td colspan="2" style="padding: 4px 0;">';
        $output .= $this->_getAddButtonHtml();
        $output .= '</td></tr>';
        $output .= '</tbody></table>';
        return $output;
    }

    protected function _getHeaderHtml() 
    {
        $output = '<tr>';
        $output .= '<th style="padding: 2px; text-align: left;" width="200">';
        $output .= Mage::helper('egmenu')->__('Label');
        $output .= '</th>';
        $output .= '<th style="padding: 2px; text-align: left;" width="200">';
        $output .= Mage::helper('egmenu')->__('Link Url');
        $output .= '</th>';
        $output .= '<th style="padding: 2px; text-align: left;" width="200">';
        $output .= Mage::helper('egmenu')->__('Static Block');
        $output .= '</th>';
        $output .= '<th style="padding: 2px; text-align: left;" width="200">';
        $output .= Mage::helper('egmenu')->__('Menu Style');
        $output .= '</th>';
        $output .= '<th>&nbsp;</th>';
        $output .= '</tr>';
        return $output;
    }

    protected function _getRowHtml($index = -1) 
    {
        $output = '<tr>';
        $output .= '<td style="padding: 2px 0;">';
        $output .= $this->_getLinkLabel($index);
        $output .= '</td>';
        $output .= '<td style="padding: 2px 0;">';
        $output .= $this->_getLinkUrl($index);
        $output .= '</td>';
        $output .= '<td style="padding: 2px 0;">';
        $output .= $this->_getLinkBlock($index);
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
            ->setOnClick("Element.insert($(this).up('tr'), {before: egcustom_template})")
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

    protected function _getLinkLabel($index = -1)
    {        
        $selected = '';
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/link_label/' . $index);
            return '<input style="margin-right:5px;width:200px;" class="required-entry input-text" name="' . $this->getElement()->getName() . '[link_label][]" value="' . $selected . '">';
        }
        return '<input style="margin-right:5px;width:200px;" class="required-entry input-text" name="' . $this->getElement()->getName() . '[link_label][]" value="">';
    }

    protected function _getLinkUrl($index = -1)
    {        
        $selected = '';
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/link_url/' . $index);
            return '<input style="margin-right:5px;width:200px;" class="required-entry input-text" name="' . $this->getElement()->getName() . '[link_url][]" value="' . $selected . '">';
        }
        return '<input style="margin-right:5px;width:200px;" class="required-entry input-text" name="' . $this->getElement()->getName() . '[link_url][]" value="">';
    }

    protected function _getLinkBlock($index = -1)
    {
        $selected = '';
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/static_block/' . $index);
            return '<input style="margin-right:5px;width:200px;" class="input-text" name="' . $this->getElement()->getName() . '[static_block][]" value="' . $selected . '">';
        }
        return '<input style="margin-right:5px;width:200px;" class="input-text" name="' . $this->getElement()->getName() . '[static_block][]" value="">';
    }

    protected function _getMenuStyle($index = -1)
    {
        $selected = '';
        if ($index > -1) {
            $selected = $this->getElement()->getData('value/menu_style/' . $index);
        }
        $output = '<select style="width:200px;min-height:20px;" class="required-entry" name="' . $this->getElement()->getName() . '[menu_style][]">';
        $output .= '<option value="">' . Mage::helper('adminhtml')->__('-- Please Select a Style --') . '</option>';
        $output .= '<option value="wide"' . (($selected == 'wide') ? ' selected' : '') . '>Wide</option>';
        $output .= '<option value="classic"' . (($selected == 'classic') ? ' selected' : '') . '>Classic</option>';
        $output .= '</select>';
        return $output;
    }
}