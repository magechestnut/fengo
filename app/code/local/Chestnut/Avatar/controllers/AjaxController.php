<?php

class Chestnut_Avatar_AjaxController extends Mage_Core_Controller_Front_Action
{
	public function uploadPhotoAction()
	{
	 	$image = Mage::helper("chestnut_avatar")->processImage();
	 	if (!is_array($image)){
	 		$image = str_replace("\\", "/", $image);
	 		$session = Mage::getSingleton('customer/session');
	        $session->setAvatar($image);
	        $result = array(
	 			'success'	=> true,
                'error'     => false,
                'message'   => Mage::getBaseUrl('media')."chestnut/avatar".$image
            );
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
	 	} else {
	 		$result = array(
	 			'success'	=> false,
                'error'     => true,
                'message'   => $image[0]
            );
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($result));
	 	}
	}
}
