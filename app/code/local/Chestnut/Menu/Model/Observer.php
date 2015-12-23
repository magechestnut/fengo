<?php

class Chestnut_Menu_Model_Observer
{
	public function categorySave($observer)
	{
		$params = $observer->getRequest()->getParam('eg_menu');
		$egmenu = Mage::getModel('egmenu/blocks');

		if (!$params['cat_id'])
			return;

		if ($blockId = $egmenu->load($params['cat_id'], 'cat_id')->getBlockId()) {
			$egmenu->load($blockId);
			$params['block_id'] = $blockId;
		}
		
		$egmenu->setData($params)->save();
	}

	public function categoryEdit($observer)
	{
		$tabs = $observer->getData('tabs');
		
		if (!Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $tabs->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        //if ($tabs->getCategory()->getId() && ($tabs->getCategory()->getLevel() <= 2)) {
            $tabs->addTab('egmenu', array(
                'label'     => Mage::helper('catalog')->__('Menu'),
                'content'   => $tabs->getLayout()->createBlock(
                    'egmenu/adminhtml_category_tab_menu',
                    'elegento_menu'
                )->toHtml()
            ));
        //}
	}
}