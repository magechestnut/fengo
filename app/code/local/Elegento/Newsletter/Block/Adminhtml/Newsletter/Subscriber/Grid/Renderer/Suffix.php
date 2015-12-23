<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Suffix extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
        if ($row->getType() != 2) {
            $value = $row->getSubscriberSuffix();
        } elseif (Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
            if (Mage::getStoreConfig('egnewsletter/fields/customer_fallback')) {
                $value = $row->getSubscriberSuffix() ? $row->getSubscriberSuffix() : $row->getCustomerSuffix();
            } else {
                $value = $row->getSubscriberSuffix();
            }
        } else {
            $value = $row->getCustomerSuffix();
        }

        return $value ? $value : '---';
	}
}