<?php

class Chestnut_Optionswatch_Block_Optionswatch extends Mage_Core_Block_Template
{
	protected function _construct()
    {
        parent::_construct();
        
        if ($this->getConfig('general/enable'))
            $this->setTemplate('chestnut/optionswatch/optionswatch.phtml');
    }

	public function getConfig($path, $store = NULL)
	{
		return $this->helper('chestnut_optionswatch')->getConfig($path, $store);
	}
	
	protected function parseOption($optionConfig) {
		$swatches = array();
		if ($optionConfig) {
			if (preg_match_all("/^(.*)\:(.*)=(.*)$/m", $optionConfig, $m, PREG_SET_ORDER)) {
				foreach ($m as $_ln)
					$swatches[] = array(
						'key' => trim($_ln[1]),
						'value' => trim($_ln[2]),
						'img' => trim($_ln[3])
					);
			}
		}
		return $swatches;
	}
}