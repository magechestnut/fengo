<?php

class Chestnut_Cloudzoom_Model_System_Config_Zoom_Type
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'lens',
                'label' => 'Lens'
            ),
            array(
                'value' => 'inner',
                'label' => 'Inner'
            ),
            array(
                'value' => 'window',
                'label' => 'Window'
            )
        );
    }
}