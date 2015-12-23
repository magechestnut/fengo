<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Dob extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
        if ($row->getType() != 2) {
            $value = $row->getSubscriberDob();
        } elseif (Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
            if (Mage::getStoreConfig('egnewsletter/fields/customer_fallback')) {
                $value = $row->getSubscriberDob() ? $row->getSubscriberDob() : $row->getCustomerDob();
            } else {
                $value = $row->getSubscriberDob();
            }
        } else {
            $value = $row->getCustomerDob();
        }

        return $value ? Mage::helper('core')->formatDate($value, 'medium', false) : '---';
	}
}