<?php

class Chestnut_Fengo_Helper_Product extends Chestnut_Fengo_Helper_Data
{
	public function setDescriptionTitle()
	{
		$title = $this->getSetting('product_page/description_title');
		return ($title) ? $title : $this->__('Details');
	}

	public function setAttributeTitle()
	{
		$title = $this->getSetting('product_page/attribute_title');
		return ($title) ? $title : $this->__('Additional Information');
	}

	public function setShortDescriptionTitle()
	{
		$title = $this->getSetting('product_page/short_desc_title');
		return ($title) ? $title : $this->__('Description');
	}

	public function setReviewsTitle()
	{
		$title = $this->getSetting('product_page/reviews_title');
		return ($title) ? $title : $this->__('Reviews');
	}

	public function setUpsellTitle()
	{
		$title = $this->getSetting('product_page/upsell_title');
		return ($title) ? $title : $this->__('We Also Recommend');
	}

	public function setTagsTitle()
	{
		$title = $this->getSetting('product_page/tags_title');
		return ($title) ? $title : $this->__('Product Tags');
	}
}