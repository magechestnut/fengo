<?php

class Elegento_Newsletter_Model_Mysql4_Subscriber_Collection extends Mage_Newsletter_Model_Mysql4_Subscriber_Collection
{
    /**
     * Adds customer info to select
     *
     * @return Mage_Newsletter_Model_Resource_Subscriber_Collection
     */
    public function showCustomerGender()
    {
        $adapter = $this->getConnection();
        $customer = Mage::getModel('customer/customer');
        $gender   = $customer->getAttribute('gender');
        
        $this->getSelect()
            ->joinLeft(
                array('customer_gender_table'=>$gender->getBackend()->getTable()),
                $adapter->quoteInto('customer_gender_table.entity_id=main_table.customer_id
                 AND customer_gender_table.attribute_id = ?', (int)$gender->getAttributeId()),
                array('customer_gender'=>'value')
            );

        return $this;
    }
    
    public function showCustomerPrefix()
    {
        $adapter = $this->getConnection();
        $customer = Mage::getModel('customer/customer');
        $prefix   = $customer->getAttribute('prefix');

        $this->getSelect()
            ->joinLeft(
                array('customer_prefix_table'=>$prefix->getBackend()->getTable()),
                $adapter->quoteInto('customer_prefix_table.entity_id=main_table.customer_id
                 AND customer_prefix_table.attribute_id = ?', (int)$prefix->getAttributeId()),
                array('customer_prefix'=>'value')
            );
            
        return $this;
    }
    
    public function showCustomerSuffix()
    {
        $adapter = $this->getConnection();
        $customer = Mage::getModel('customer/customer');
        $suffix   = $customer->getAttribute('suffix');

        $this->getSelect()
            ->joinLeft(
                array('customer_suffix_table'=>$suffix->getBackend()->getTable()),
                $adapter->quoteInto('customer_suffix_table.entity_id=main_table.customer_id
                 AND customer_suffix_table.attribute_id = ?', (int)$suffix->getAttributeId()),
                array('customer_suffix'=>'value')
            );
            
        return $this;
    }
    
    public function showCustomerDob()
    {
        $adapter = $this->getConnection();
        $customer = Mage::getModel('customer/customer');
        $dob   = $customer->getAttribute('dob');

        $this->getSelect()
            ->joinLeft(
                array('customer_dob_table'=>$dob->getBackend()->getTable()),
                $adapter->quoteInto('customer_dob_table.entity_id=main_table.customer_id
                 AND customer_dob_table.attribute_id = ?', (int)$dob->getAttributeId()),
                array('customer_dob'=>'value')
            );
            
        return $this;
    }
}
