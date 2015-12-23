<?php

class Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid
{
	protected function _prepareCollection()
	{
        $collection = Mage::getResourceSingleton('newsletter/subscriber_collection');
        $collection->showCustomerInfo();
        
        if (Mage::getStoreConfig('egnewsletter/fields/show_gender'))
            $collection->showCustomerGender();
        if (Mage::getStoreConfig('egnewsletter/fields/show_prefix'))
            $collection->showCustomerPrefix();
        if (Mage::getStoreConfig('egnewsletter/fields/show_suffix'))
            $collection->showCustomerSuffix();
        if (Mage::getStoreConfig('egnewsletter/fields/show_dob'))
            $collection->showCustomerDob();
        
        $collection->addSubscriberTypeField()->showStoreInfo();

        if($this->getRequest()->getParam('queue', false)) {
            $collection->useQueue(Mage::getModel('newsletter/queue')->load($this->getRequest()->getParam('queue')));
        }

        $this->setCollection($collection);

        if ($this->getCollection()) {
            $this->_preparePage();

            $columnId = $this->getParam($this->getVarNameSort(), $this->_defaultSort);
            $dir      = $this->getParam($this->getVarNameDir(), $this->_defaultDir);
            $filter   = $this->getParam($this->getVarNameFilter(), null);

            if (is_null($filter)) {
                $filter = $this->_defaultFilter;
            }

            if (is_string($filter)) {
                $data = $this->helper('adminhtml')->prepareFilterString($filter);
                $this->_setFilterValues($data);
            }
            else if ($filter && is_array($filter)) {
                $this->_setFilterValues($filter);
            }
            else if(0 !== sizeof($this->_defaultFilter)) {
                $this->_setFilterValues($this->_defaultFilter);
            }

            if (isset($this->_columns[$columnId]) && $this->_columns[$columnId]->getIndex()) {
                $dir = (strtolower($dir)=='desc') ? 'desc' : 'asc';
                $this->_columns[$columnId]->setDir($dir);
                $this->_setCollectionOrder($this->_columns[$columnId]);
            }

            if (!$this->_isExport) {
                $this->getCollection()->load();
                $this->_afterLoadCollection();
            }
        }
    }

	protected function _prepareColumns()
	{
		parent::_prepareColumns();
		
        $this->removeColumn('gender');
        $this->removeColumn('prefix');
        $this->removeColumn('firstname');
        $this->removeColumn('lastname');
        $this->removeColumn('suffix');
        $this->removeColumn('dob');
		
        if (Mage::getStoreConfig('egnewsletter/fields/show_gender')) {
    		$this->addColumnAfter('gender', array(
    			'header'    => Mage::helper('newsletter')->__('Gender'),
                'index'     => 'customer_gender',
                'type'      => 'options',
                'options'   => array(
                    1  => Mage::helper('newsletter')->__('Male'),
                    2  => Mage::helper('newsletter')->__('Female')
                ),
    			'renderer'	=> 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Gender'
    		), 'type');
        }
        
        if (Mage::getStoreConfig('egnewsletter/fields/show_prefix')) {
            $this->addColumnAfter('prefix', array(
                'header'    => Mage::helper('newsletter')->__('Prefix'),
                'index'     => 'customer_prefix',
                'renderer'  => 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Prefix'
            ), Mage::getStoreConfig('egnewsletter/fields/show_gender') ? 'gender' : 'type');
        }
		
		$this->addColumnAfter('firstname', array(
			'header'    => Mage::helper('newsletter')->__('First Name'),
            'index'     => 'customer_firstname',
			'renderer'	=> 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Firstname'
		), Mage::getStoreConfig('egnewsletter/fields/show_prefix') ? 'prefix' : (Mage::getStoreConfig('egnewsletter/fields/show_gender') ? 'gender' : 'type'));
		
		$this->addColumnAfter('lastname', array(
			'header'    => Mage::helper('newsletter')->__('Last Name'),
            'index'     => 'customer_lastname',
			'renderer'	=> 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Lastname'
		), 'firstname');
        
        if (Mage::getStoreConfig('egnewsletter/fields/show_suffix')) {
            $this->addColumnAfter('suffix', array(
                'header'    => Mage::helper('newsletter')->__('Suffix'),
                'index'     => 'customer_suffix',
                'renderer'  => 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Suffix'
            ), 'lastname');
        }
        
        if (Mage::getStoreConfig('egnewsletter/fields/show_dob')) {
            $this->addColumnAfter('dob', array(
                'header'    => Mage::helper('newsletter')->__('Date of Birth'),
                'index'     => 'customer_dob',
                'renderer'  => 'Elegento_Newsletter_Block_Adminhtml_Newsletter_Subscriber_Grid_Renderer_Dob'
            ), Mage::getStoreConfig('egnewsletter/fields/show_suffix') ? 'suffix' : 'lastname');
        }

		$this->sortColumnsByOrder();
		
        return $this;
    }
}
