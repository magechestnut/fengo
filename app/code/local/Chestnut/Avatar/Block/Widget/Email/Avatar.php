<?php

class Chestnut_Avatar_Block_Widget_Email_Avatar extends Chestnut_Avatar_Block_Widget_Avatar
{
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('chestnut/avatar/email/template/avatar.phtml');
    }
}