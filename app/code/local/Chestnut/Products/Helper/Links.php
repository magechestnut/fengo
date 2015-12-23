<?php

class Chestnut_Products_Helper_Links extends Mage_Core_Helper_Abstract
{
	public function getCategoryAddtoLinks($_product, $_compareUrl, $wrapperClasses = '')
	{
		$html = '';

		if (Mage::helper('wishlist')->isAllow())
		{
			$html .= '<li><a href="' . Mage::helper('wishlist')->getAddUrl($_product) . '" class="link-wishlist" title="' . $this->__('Add to Wishlist') . '">' . $this->__('Add to Wishlist') . '</a></li>';
		}
		
		if ($_compareUrl)
		{
			$html .= '<li><a href="' . $_compareUrl . '" class="link-compare" title="' . $this->__('Add to Compare') . '">' . $this->__('Add to Compare') . '</a></li>';
		}
		
		//If any link rendered
		if (!empty($html))
		{
			return '<ul class="add-to-links clearer '. $wrapperClasses .'">' . $html . '</ul>';
		}
		return $html;
	}
	
	public function getCategoryAddtoLinksComplex($_product, $_compareUrl, $wrapperClasses = '')
	{
		$html = '';

		if (Mage::helper('wishlist')->isAllow())
		{			
			$html .= '
			<li><a class="link-wishlist feature feature-icon-hover first v-centered-content" 
				href="' . Mage::helper('wishlist')->getAddUrl($_product) . '" 
				title="' . $this->__('Add to Wishlist') . '">
				<span class="v-center">
					<span class="icon i-wishlist-bw"></span>
				</span>
				<span class="v-center">' . $this->__('Add to Wishlist') . '</span>
			</a></li>';
		}
		
		if ($_compareUrl)
		{
			$html .= '
			<li><a class="link-compare feature feature-icon-hover first v-centered-content"
				href="' . $_compareUrl . '" 
				title="' . $this->__('Add to Compare') . '">
				<span class="v-center">
					<span class="icon i-compare-bw"></span>
				</span>
    	        <span class="v-center">' . $this->__('Add to Compare') . '</span>
			</a></li>';
		}
		
		if (!empty($html))
		{
			return '<ul class="add-to-links clearer ' . $wrapperClasses .'">' . $html . '</ul>';
		}
		return $html;
	}

	public function getCategoryAddtoLinksComplex_2($_product, $_compareUrl, $wrapperClasses = '')
	{
		$html = '';

		if (Mage::helper('wishlist')->isAllow())
		{			
			$html .= '
			<li><a class="link-wishlist" 
				href="' . Mage::helper('wishlist')->getAddUrl($_product) . '" 
				title="' . $this->__('Add to Wishlist') . '">
					<span class="icon icon-hover i-wishlist-bw"></span>
			</a></li>';
		}
		
		if ($_compareUrl)
		{
			$html .= '
			<li><a class="link-compare"
				href="' . $_compareUrl . '" 
				title="' . $this->__('Add to Compare') . '">
					<span class="icon icon-hover i-compare-bw"></span>
			</a></li>';
		}
		
		if (!empty($html))
		{
			return '<ul class="add-to-links clearer ' . $wrapperClasses .'">' . $html . '</ul>';
		}
		return $html;
	}
}
