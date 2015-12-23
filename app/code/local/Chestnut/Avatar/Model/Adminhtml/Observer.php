<?php

class Chestnut_Avatar_Model_Adminhtml_Observer  extends Mage_Core_Model_Abstract 
{
    function customerBlockHtmlBefore($observer) 
    {
        try {
            $block = $observer->getBlock();
            if (!isset($block)) return;
             
            switch ($block->getType()) {
                case 'adminhtml/customer_grid':
                    $block->addColumn('photo', array(
			            'header'    => Mage::helper('chestnut_avatar')->__('Avatar'),
			            'index'     => 'photo',
			            'type'      => 'options',
			        	'default'   => 'No Avatar',
			        	'options'   => array(
                            -1  => Mage::helper('chestnut_avatar')->__('No avatar'),
                            0  => Mage::helper('chestnut_avatar')->__('To moderate'),
                            1  => Mage::helper('chestnut_avatar')->__('Accepted'),
                            2  => Mage::helper('chestnut_avatar')->__('Rejected')
                        )
                    ));
                    $block->addColumnsOrder('photo','email');
                    $block->sortColumnsByOrder();                     
                    break;

                case 'adminhtml/customer_edit_tab_account':
                    $form = $block->getForm();
                    $customer = Mage::registry('current_customer');
                    
                    $form->getElement('base_fieldset')->addField('avatar_valid', 'select', array(
                        'label' => Mage::helper('chestnut_avatar')->__('Avatar Validation'),
                        'name' => 'avatar_valid',
                        'values' => array(
                            array(
                                'value' => 0,
                                'label' => Mage::helper('chestnut_avatar')->__('To moderate'),
                            ),
                            array(
                                'value' => 1,
                                'label' => Mage::helper('chestnut_avatar')->__('Accepted'),
                            ),
                            array(
                                'value' => 2,
                                'label' => Mage::helper('chestnut_avatar')->__('Rejected'),
                            ),
                        ),
                        'value' => $customer->getAvatarValid(),
                    ));

                    if ($customer->getAvatarSrc() != "" && $customer->getAvatarValid() != 2){
                        $form->getElement('base_fieldset')->addField('avatar_src2', 'note', array(
            	            'label' => Mage::helper('chestnut_avatar')->__('Avatar'),
            	            'text' => '<img src="'.Mage::getBaseUrl('media').'chestnut/avatar'. $customer->getAvatarSrc() .'" width="75" />'
            	        ));
                    }
                    break;
            }
        } catch ( Exception $e ) {
            Mage::log( "customerBlockHtmlBefore observer failed: " . $e->getMessage() );
        }
    }

    function customerEavLoadBefore($observer) {
        try {
            $collection = $observer->getCollection();
            if (!isset($collection)) return;

            if ($collection instanceof Mage_Customer_Model_Resource_Customer_Collection) {
                $fields = array("avatar_src", "avatar_valid");
                $expr = 'IF({{avatar_src}} IS NOT NULL AND {{avatar_src}} != "", IF({{avatar_valid}} IS NOT NULL,{{avatar_valid}},"0"), "-1")';
                $collection->addExpressionAttributeToSelect('photo', $expr, $fields);
            }
        } catch ( Exception $e ) {
            Mage::log( "customerEavLoadBefore observer failed: " . $e->getMessage() );
        }
    }

    function customerPrepareSave($observer) {
        try {
            $customer = $observer->getCustomer();
            $request = $observer->getRequest();
            if (!isset($customer)) return;

            $data = $request->getParam('account', array());
            $customer->setData('avatar_valid', $data['avatar_valid']);
        } catch ( Exception $e ) {
            Mage::log( "customerPrepareSave observer failed: " . $e->getMessage() );
        }
    }
}