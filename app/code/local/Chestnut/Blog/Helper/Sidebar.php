<?php

class Chestnut_Blog_Helper_Sidebar extends Chestnut_Blog_Helper_Data
{
	public function getStore()
	{
		return Mage::app()->getStore()->getId();
	}

	public function getLeftSidebar()
	{
		$leftEnabled = $this->getConfig(self::XML_LEFT_SIDEBAR, $this->getStore());
		if ($leftEnabled == 1) {
			return 'chestnut/blog/sidebar.phtml';
		} elseif ($leftEnabled == 2) {
			if (Mage::app()->getRequest()->getModuleName() == 'blog') {
				return 'chestnut/blog/sidebar.phtml';
			}
		}

		return '';
	}

	public function getRightSidebar()
	{
		$rightEnabled = $this->getConfig(self::XML_RIGHT_SIDEBAR, $this->getStore());
		if ($rightEnabled == 1) {
			return 'chestnut/blog/sidebar.phtml';
		} elseif ($rightEnabled == 2) {
			if (Mage::app()->getRequest()->getModuleName() == 'blog') {
				return 'chestnut/blog/sidebar.phtml';
			}
		}

		return '';
	}
}