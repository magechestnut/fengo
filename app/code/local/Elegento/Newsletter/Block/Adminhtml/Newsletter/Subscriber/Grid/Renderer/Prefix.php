<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Prefix extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
        if ($row->getType() != 2) {
            $value = $row->getSubscriberPrefix();
        } elseif (Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
            if (Mage::getStoreConfig('egnewsletter/fields/customer_fallback')) {
                $value = $row->getSubscriberPrefix() ? $row->getSubscriberPrefix() : $row->getCustomerPrefix();
            } else {
                $value = $row->getSubscriberPrefix();
            }
        } else {
            $value = $row->getCustomerPrefix();
        }
        
        return $value ? $value : '---';
	}
}