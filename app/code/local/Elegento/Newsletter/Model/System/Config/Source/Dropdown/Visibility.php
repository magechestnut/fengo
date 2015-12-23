<?php

class Elegento_Newsletter_Model_System_Config_Source_Dropdown_Visibility
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 0,
                'label' => 'Everyone',
            ),
            array(
                'value' => 1,
                'label' => 'Logged-in Users Only',
            ),
            array(
                'value' => 2,
                'label' => 'Guests Only',
            )
        );
    }
}