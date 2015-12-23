<?php

class Elegento_Newsletter_Helper_Data extends Mage_Core_Helper_Abstract
{
    protected $genderOptions;

    public function getConfig($path, $store = NULL)
    {
        return Mage::getStoreConfig('egnewsletter/' . $path, $store);
    }

    public function isEnabledPopup($store = NULL)
    {
        return $this->getConfig('popup/enabled', $store);
    }

    public function showAlreadySubscribed($store = NULL)
    {
        return $this->getConfig('popup/show_already_subscribed', $store);
    }

    public function getPopupVisibility($store = NULL)
    {
        return $this->getConfig('popup/visibility', $store);
    }

    public function getPopupExpire($store = NULL)
    {
        $expire = 2592000;
        if ($this->getConfig('popup/pop_expire', $store)) {
            $expire = $this->getConfig('popup/pop_expire', $store) * 60;
        }
        return $expire;
    }
    
    public function getGenderOptions()
    {
        if (!isset($genderOptions)) {
            
            $attribute = Mage::getSingleton('eav/config')->getAttribute('customer', 'gender');
            if ($attribute->usesSource()) {
                $options = $attribute->getSource()->getAllOptions(false);
            }
            
            if (empty($options)) {
                $options = array(
                    0 => array(
                        'value' => '1',
                        'label' => 'Male'
                    ),
                    1 => array(
                        'value' => '2',
                        'label' => 'Female'
                    )
                );
            }
            
            $this->genderOptions = $options;
        }
        
        return $this->genderOptions;
    }
    
    public function getGenderLabelByType($type)
    {
        $type = intval($type);
        foreach($this->getGenderOptions() as $option) {
            
            if (isset($option['value']) && isset($option['label']) && intval($option['value']) === $type) {
                return $option['label'];
            }
        }

        if ($type === 1) {
            return 'Male';
        }
        if ($type === 2) {
            return 'Female';
        }
        return '';
    }
    
    public function getGenderOptionsHtml()
    {
        $html = '';
        foreach($this->getGenderOptions() as $option) {
            
            if (isset($option['value']) && isset($option['label'])) {
                $html .= '<option value="' . $option['value'] . '">' . $this->__($option['label']) . '</option>' . PHP_EOL;
            }
        }
        return $html;
    }
}