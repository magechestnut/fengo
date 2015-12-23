<?php

class Chestnut_Fengo_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
    {
		$this->loadLayout();
        $this->renderLayout();
    } 
}