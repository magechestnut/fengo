<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Firstname extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
        if ($row->getType() != 2) {
            $value = $row->getSubscriberFirstname();
        } elseif (Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
            if (Mage::getStoreConfig('egnewsletter/fields/customer_fallback')) {
                $value = $row->getSubscriberFirstname() ? $row->getSubscriberFirstname() : $row->getCustomerFirstname();
            } else {
                $value = $row->getSubscriberFirstname();
            }
        } else {
            $value = $row->getCustomerFirstname();
        }
		
		return $value ? $value : '---';
	}
}