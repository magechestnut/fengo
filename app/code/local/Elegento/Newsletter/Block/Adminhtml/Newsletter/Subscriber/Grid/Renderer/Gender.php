<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Gender extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ($row->getType() != 2) {
            $value = $row->getSubscriberGender();
        } elseif (Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
            if (Mage::getStoreConfig('egnewsletter/fields/customer_fallback')) {
                $value = $row->getSubscriberGender() ? $row->getSubscriberGender() : $row->getCustomerGender();
            } else {
                $value = $row->getSubscriberGender();
            }
        } else {
            $value = $row->getCustomerGender();
        }
        
        $value = $this->helper('egnewsletter')->getGenderLabelByType($value);
        return $value ? $value : '---';
    }
}