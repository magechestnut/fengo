<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Model_Select extends Zend_Db_Select 
{
    public function setPart($part, $val)
    {
        $this->_parts[$part] = $val;
    }
}