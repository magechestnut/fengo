<?php

class Chestnut_Products_Helper_Labels extends Mage_Core_Helper_Abstract
{
	public function getLabels($product)
	{
		$html = '';

		$isNew = false;
		if (Mage::getStoreConfig('fengo_setting/product_page/new'))
		{	
			$isNew = $this->isNew($product);
		}
		
		$isSale = false;
		if (Mage::getStoreConfig('fengo_setting/product_page/sale'))
		{
			$isSale = $this->isOnSale($product);
		}
		
		if ($isNew == true)
		{
			$html .= '<span class="sticker-wrapper top-left"><span class="sticker new">' . $this->__('New') . '</span></span>';
		}
		
		if ($isSale == true)
		{
			$html .= '<span class="sticker-wrapper top-right"><span class="sticker sale">' . $this->__('Sale') . '</span></span>';
		}
		
		return $html;
	}
	
	public function isNew($product)
	{
		return $this->_nowIsBetween($product->getData('news_from_date'), $product->getData('news_to_date'));
	}
	
	public function isOnSale($product)
	{
		$specialPrice = number_format($product->getFinalPrice(), 2);
		$regularPrice = number_format($product->getPrice(), 2);
		
		if ($specialPrice != $regularPrice)
			return $this->_nowIsBetween($product->getData('special_from_date'), $product->getData('special_to_date'));
		else
			return false;
	}
	
	protected function _nowIsBetween($fromDate, $toDate)
	{
		if ($fromDate)
		{
			$fromDate = strtotime($fromDate);
			$toDate = strtotime($toDate);
			$now = strtotime(Mage::app()->getLocale()->date()->setTime('00:00:00')->toString(Varien_Date::DATETIME_INTERNAL_FORMAT));
			
			if ($toDate)
			{
				if ($fromDate <= $now && $now <= $toDate)
					return true;
			}
			else
			{
				if ($fromDate <= $now)
					return true;
			}
		}
		
		return false;
	}
}
