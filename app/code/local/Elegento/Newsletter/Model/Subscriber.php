<?php

class Elegento_Newsletter_Model_Subscriber extends Mage_Newsletter_Model_Subscriber
{
    protected $customer;
    
    public function getCustomer()
    {
        if (!isset($this->customer)) {
            $this->customer = Mage::getModel('customer/customer')->load($this->getCustomerId());
        }
        
        return $this->customer;
    }
    
    public function getSubscriberGender()
    {
        $gender = parent::getSubscriberGender();
        
        if (!$gender && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $gender = $this->getCustomer()->getGender();
        }
        
        return $gender;
    }
    
    public function getSubscriberGenderLabel()
    {
        $helper = Mage::helper('egnewsletter');
        return $helper->__($helper->getGenderLabelByType($this->getSubscriberGender()));
    }
    
    public function getSubscriberPrefix()
    {
        $prefix = parent::getSubscriberPrefix();
        
        if (!$prefix && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $prefix = $this->getCustomer()->getPrefix();
        }
        return $prefix;
    }
    
    public function getSubscriberFirstname()
    {
        $firstname = parent::getSubscriberFirstname();
        
        if (!$firstname && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $firstname = $this->getCustomer()->getFirstname();
        }
        return $firstname;
    }
    
    public function getSubscriberLastname()
    {
        $lastname = parent::getSubscriberLastname();
        
        if (!$lastname && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $lastname = $this->getCustomer()->getLastname();
        }
        return $lastname;
    }
    
    public function getSubscriberSuffix()
    {
        $suffix = parent::getSubscriberSuffix();
        
        if (!$suffix && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $suffix = $this->getCustomer()->getSuffix();
        }
        return $suffix;
    }
    
    public function getSubscriberDob()
    {
        $dob = parent::getSubscriberDob();
        
        if (!$dob && Mage::getStoreConfig('egnewsletter/fields/customer_fallback') && $this->getCustomer()) {
            $dob = $this->getCustomer()->getSuffix();
        }
        return $dob;
    }

    public function getSubscriberFullName()
    {
        return trim($this->getSubscriberFirstname() . ' ' . $this->getSubscriberLastname());
    }
}