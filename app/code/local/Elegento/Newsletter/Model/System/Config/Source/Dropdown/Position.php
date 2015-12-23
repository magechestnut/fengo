<?php

class Elegento_Newsletter_Model_System_Config_Source_Dropdown_Position
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'n',
                'label' => 'Don\'t Show',
            ),
            array(
                'value' => 'p',
                'label' => 'Popup Window',
            ),
            array(
                'value' => 'g',
                'label' => 'General Window',
            ),
            array(
                'value' => 'b',
                'label' => 'Both of Popup and General Window',
            )
        );
    }
}