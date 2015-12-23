<?php 

class Chestnut_Fengo_Block_Links_Links extends Mage_Wishlist_Block_Links
{
	protected function _createLabel($count)
    {
        if ($count > 1) {
            return $this->__('My Wishlist (%d items)', $count);
        } else if ($count == 1) {
            return $this->__('My Wishlist (%d item)', $count);
        } else {
            return $this->__('My Wishlist (0)');
        }
    }
}