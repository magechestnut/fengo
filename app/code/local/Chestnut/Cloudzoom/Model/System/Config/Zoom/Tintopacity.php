<?php

class Chestnut_Cloudzoom_Model_System_Config_Zoom_Tintopacity
{
    public function toOptionArray()
    {
        $i = 0;
        $options = array();

        for ($i = 0; $i < 11; $i++) {
            array_push($options, array(
                'value' => 0.1 * $i,
                'label' => 0.1 * $i
            ));
        }

        return $options;
    }
}