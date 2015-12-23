<?php

class Elegento_Newsletter_Model_Observer
{
    public function newsletterSubscriberChange(Varien_Event_Observer $observer)
    {
        $subscriber = $observer->getEvent()->getSubscriber();
        $data = Mage::app()->getRequest()->getParams() ? Mage::app()->getRequest()->getParams() : array();
        
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {            
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            
            if (isset($data['email']) && $customer->getEmail() === $data['email']) {
                if (!Mage::getStoreConfig('egnewsletter/fields/customer_override')) {
                    $data['firstname'] = '';
                    $data['lastname'] = '';
                    $data['gender'] = '';
                    $data['prefix'] = '';
                    $data['dob'] = '';
                }
            }
        }
        
        if (isset($data['email'])) {            
            if (isset($data['gender'])) $subscriber->setSubscriberGender($data['gender']);
            if (isset($data['prefix'])) $subscriber->setSubscriberPrefix($data['prefix']);
            if (isset($data['firstname'])) $subscriber->setSubscriberFirstname($data['firstname']);
            if (isset($data['lastname'])) $subscriber->setSubscriberLastname($data['lastname']);
            if (isset($data['suffix'])) $subscriber->setSubscriberSuffix($data['suffix']);
            if (isset($data['dob'])) $subscriber->setSubscriberDob($data['dob']);
        }
        
        return $this;
    }
}