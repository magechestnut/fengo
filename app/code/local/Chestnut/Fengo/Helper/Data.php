<?php

class Chestnut_Fengo_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getSetting($path = '', $store = NULL)
    {
		return Mage::getStoreConfig('fengo_setting/' . $path, $store);
    }
	
	public function getDesign($path = '', $store = NULL)
    {
		return Mage::getStoreConfig('fengo_design/' . $path, $store);
    }

	public function getHoverImgHtml($product, $w = 0, $h = 0, $imgVersion = 'image')
	{
		$colname = $this->getSetting('category_view/hover_image_colname');
		$colvalue = $this->getSetting('category_view/hover_image_colvalue');
		$product->load('media_gallery');
		if ($galleryImages = $product->getMediaGalleryImages())
		{
			if ($hoverImage = $galleryImages->getItemByColumnValue($colname, $colvalue))
			{
				return
				'<img class="hover-image" src="' . Mage::helper('chestnut_products/image')->getImg($product, $w, $h, $imgVersion, $hoverImage->getFile()) . '" alt="' . $product->getName() . '" />';
			}
		}

		return '';
	}

	public function getFooterBlock($id, $type = 'type1')
	{
		$html = '';

		$columnCount = 0;
		$columnIndex = array();
		for ($i = 1; $i <= 4; $i++) {
		    for ($j = 1; $j < 5; $j++) {
		    	$identifier = $id . '_col' . $i . '_row' . $j . '_' . $type;
                if (Mage::getBlockSingleton('fengo/cms_block')->setBlockId($identifier)->toHtml()) {
                    $columnCount++;
                    $columnIndex[$i] = true;
                    continue 2; 
                } else {
                	$columnIndex[$i] = false;
                }
            }
		}
		
		$gridClass = '';
		if ($columnCount == 0) {
			$gridClass = 'grid-full';
		} else {			
			$suffix = (int) (12 / $columnCount);
			$gridClass = 'grid12-' . $suffix;
		}

		for ($i = 1; $i <= 4; $i++) {
			if ($columnIndex[$i]) {
				$html .= '<div class="' . $gridClass . ' grid-full-below-768 ' . $id . '_col' . $i . '_' . $type . '">';
			    for ($j = 1; $j < 5; $j++) {
			    	$identifier = $id . '_col' . $i . '_row' . $j . '_' . $type;
	                if ($tmpBlock = Mage::getBlockSingleton('fengo/cms_block')->setBlockId($identifier)->toHtml()) {
	                    $html .= $tmpBlock; 
	                }
	            }
	            $html .= '</div>';
	        }
		}

		return $html;
	}

	public function getHomeParams() {
        return array(
            "label" => $this->__('Home'),
            "title" => $this->__('Go to Home Page'),
            "link" => Mage::getUrl('')
        );
    }

	public function getPriceBlockTemplate() 
	{
		return 'chestnut/home/price.phtml';
	}

	public function setHeader() 
	{
		$template = '';
		$store = Mage::app()->getStore()->getStoreId();

		switch ($this->getSetting('header/header_style', $store)) {
			case 'type1':
				$template = 'page/html/header-type1.phtml';
				break;
			case 'type2':
				$template = 'page/html/header-type2.phtml';
				break;
			case 'type3':
				$template = 'page/html/header-type3.phtml';
				break;
			case 'type4':
				$template = 'page/html/header-type4.phtml';
				break;
			
			default:
				$template = 'page/html/header.phtml';
				break;
		}

		return $template;
	}

	public function setFooter() 
	{
		$template = '';
		$store = Mage::app()->getStore()->getStoreId();

		switch ($this->getSetting('footer/footer_style', $store)) {
			case 'type1':
				$template = 'page/html/footer-type1.phtml';
				break;
			case 'type2':
				$template = 'page/html/footer-type2.phtml';
				break;
			
			default:
				$template = 'page/html/footer.phtml';
				break;
		}

		return $template;
	}

	public function setCategoryBlock() 
	{
		$blockId = 'category_banner_';
		$category = Mage::registry('current_category');

		if ($category) {
			return $blockId . $category->getId();
		}

		return $blockId . 'default';
	}

	public function enabledQuickView()
	{
		return $this->getSetting('quick_view/enable');
	}

    public function installTheme($website = NULL, $store = NULL) 
    {
    	$config = Mage::getConfig();
        $config->saveConfig('cms/wysiwyg/enabled', 'hidden');
        $config->saveConfig('design/header/welcome', '');
        $config->saveConfig('design/package/name', 'fengo');
		$config->saveConfig('web/default/cms_home_page', 'fengo-home-page');
		$config->saveConfig('fengo_setting/header/header_style', 'type1');
		$config->saveConfig('fengo_setting/footer/footer_style', 'type1');
		Mage::helper('fengo/css')->generate('design', null, null);
		Mage::app()->cleanCache();
    }

    public function activateDemo($style = 'type1', $website = NULL, $store = NULL) 
    {
    	$config = Mage::getConfig();
    	if ($style == 'type1') {
        	$config->saveConfig('web/default/cms_home_page', 'fengo-home-page');
        } else {
        	$config->saveConfig('web/default/cms_home_page', 'fengo-home-page'.str_replace('type', '', $style));
        }

        switch ($style) {
        	case 'type1':
        		$config->saveConfig('fengo_setting/header/header_style', 'type1');
        		$config->saveConfig('fengo_setting/footer/footer_style', 'type1');
        		$config->saveConfig('theme_activate/activate_demos/demo_style', $style);
        		break;
        	case 'type2':
        		$config->saveConfig('fengo_setting/header/header_style', 'type2');
        		$config->saveConfig('fengo_setting/footer/footer_style', 'type2');
        		$config->saveConfig('fengo_setting/footer/show_footer_top', 1);
        		$config->saveConfig('theme_activate/activate_demos/demo_style', $style);
        		break;
        	case 'type3':
        		$config->saveConfig('fengo_setting/header/header_style', 'type3');
        		$config->saveConfig('fengo_setting/footer/footer_style', 'type2');
        		$config->saveConfig('fengo_setting/footer/show_footer_top', 1);
        		$config->saveConfig('theme_activate/activate_demos/demo_style', $style);
        		break;
        	case 'type4':
        		$config->saveConfig('fengo_setting/header/header_style', 'type4');
        		$config->saveConfig('fengo_setting/footer/footer_style', 'type2');
        		$config->saveConfig('fengo_setting/footer/show_footer_top', 0);
        		$config->saveConfig('theme_activate/activate_demos/demo_style', $style);
        		break;
        	
        	default:
        		$config->saveConfig('fengo_setting/header/header_style', 'type1');
        		$config->saveConfig('fengo_setting/footer/footer_style', 'type1');
        		$config->saveConfig('theme_activate/activate_demos/demo_style', 'type1');
        		break;
        }
    }

	public function importCmsItems($modelString, $type, $overwrite = false)
    {
		try
		{
			$xmlFile = Mage::getModuleDir('etc', 'Chestnut_Fengo') . "/import/$type.xml";
			if (!is_readable($xmlFile))
			{
				throw new Exception(
					Mage::helper('fengo')->__("Can't read xml file: %s", $xmlFile)
				);
			}
			$xmlObj = new Varien_Simplexml_Config($xmlFile);
			
			$conflictingOldItems = array();
			$i = 0;
			foreach ($xmlObj->getNode($type)->children() as $b)
			{
				$oldBlocks = Mage::getModel($modelString)->getCollection()
					->addFieldToFilter('identifier', $b->identifier)
					->load();
				
				if ($overwrite)
				{
					if (count($oldBlocks) > 0)
					{
						$conflictingOldItems[] = $b->identifier;
						foreach ($oldBlocks as $old)
							$old->delete();
					}
				}
				else
				{
					if (count($oldBlocks) > 0)
					{
						$conflictingOldItems[] = $b->identifier;
						continue;
					}
				}
				
				Mage::getModel($modelString)
					->setTitle($b->title)
					->setContent($b->content)
					->setIdentifier($b->identifier)
					->setRootTemplate($b->root_template)
					->setIsActive($b->is_active)
					->setStores(array(0))
					->save();
				$i++;
			}
			
			if ($i)
			{
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('fengo')->__('Number of imported items: %s', $i)
				);
			}
			else
			{
				Mage::getSingleton('adminhtml/session')->addNotice(
					Mage::helper('fengo')->__('No items were imported')
				);
			}
			
			if ($overwrite)
			{
				if ($conflictingOldItems)
					Mage::getSingleton('adminhtml/session')->addSuccess(
						Mage::helper('fengo')
						->__('Items (%s) with the following identifiers were overwritten:<br />%s', count($conflictingOldItems), implode(', ', $conflictingOldItems))
					);
			}
			else
			{
				if ($conflictingOldItems)
					Mage::getSingleton('adminhtml/session')->addNotice(
						Mage::helper('fengo')
						->__('Unable to import items (%s) with the following identifiers (they already exist in the database):<br />%s', count($conflictingOldItems), implode(', ', $conflictingOldItems))
					);
			}
		}
		catch (Exception $e)
		{
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			Mage::logException($e);
		}
    }
	
	public function isColor($color)
	{
		if ($color && $color != 'transparent')
			return true;
		else
			return false;
	}

	public function getConfigFile($path = NULL, $store = NULL)
	{
		// $uploadDir = Chestnut_Fengo_Model_System_Config_Source_File_Image::EG_UPLOAD_DIR;
		// $uploadRoot = Chestnut_Fengo_Model_System_Config_Source_File_Image::EG_UPLOAD_ROOT;
		return Chestnut_Fengo_Model_System_Config_Source_File_Image::getEGUploadDir() . '/' . $this->getSetting($path, $store);
	}

	public function getLoadingMask($store = NULL)
	{
		$loadingConfig = $this->getSetting('general', $store);
		$bgColor = ($bgColor = $loadingConfig['loading_mask_bg_color']) ? "background-color: $bgColor;" : '';
		$html = '';

		switch ($loadingConfig['loading_mask']) {
		    case 'image':
		    	$src = $this->getConfigFile('general/loading_mask_image', $store);
		        $html .= '<div id="eg-loading-mask" style="' . $bgColor . '"><div id="eg-loading-image">';
		        $html .= '<img src="' . $src . '" alt="Loading Mask">';
		        $html .= '</div></div>';
		        break;
		    case 'text':
		    	$text = ($text = $loadingConfig['loading_mask_text']) ? $text : 'LOADING';
		    	$fontColor = ($color = $loadingConfig['loading_mask_font_color']) ? "color: $color;" : '';
		    	$fontSize = ($size = $loadingConfig['loading_mask_font_size']) ? "font-size: $size;" : '';
		        $html .= '<div id="eg-loading-mask" style="' . $bgColor . '"><div id="eg-loading-text">';
		        $html .= '<span style="' . $fontColor . $fontSize . '">' . $text . '</span>';
		        $html .= '</div></div>';
		        break;
		    case 'percent':
		    	$progressTheme = $this->getSetting('general/loading_mask_theme', $store);
		        $html .= '<script type="text/javascript">//<![CDATA[' . "\n";
		        $html .= <<<SCRIPT
					progressJs().setOptions({overlayMode: true, theme: '$progressTheme'}).start().autoIncrease(4, 500);
					if (window.attachEvent) {
					    window.attachEvent('onload', function () {
					        progressJs().end();
					    });
					} else {
					    if (window.onload) {
					        var curronload = window.onload;
					        var newonload = function () {
					            curronload();
					            progressJs().end();
					        };
					        window.onload = newonload;
					    } else {
					        window.onload = function () {
					            progressJs().end();
					        };
					    }
					}
SCRIPT
				;
		        $html .= "\n";
		        $html .= '//]]></script>' . "\n";
		        break;
		}

		return $html;
	}
	
	public function getThemeBodyClasses()
	{
		$classes = '';

		if (array_key_exists('HTTP_USER_AGENT', $_SERVER))
		{
			$array = array();
			$userAgentStr = strtolower($_SERVER['HTTP_USER_AGENT']);
			if (!preg_match('/opera|webtv/i', $userAgentStr) && preg_match('/msie\s(\d)/', $userAgentStr, $array))
			{
				if ($array[1] >= 6 && $array[1] <= 8)
				{
					$classes = 'lte-ie8';
				}
			}
		}
		
		return $classes;
	}
    
    public function getGmapMarker()
    {
        $icon = $this->getSetting('contactus/gmap_marker');
        if ($icon)
            return Mage::getBaseUrl('media') . 'chestnut/fengo/icons/' . $icon;
        return Mage::getBaseUrl('media') . 'chestnut/fengo/icons/icon_gmap.png';
    }
    
    public function getFacebookConfig() 
    {
        return Mage::getStoreConfig('fengo_setting/facebook');
    }
    
    public function getFBPageUrl() 
    {
        $fb = $this->getFacebookConfig();
        
        if (!$fb['enable'])
            return false;

        if (!$fb['page_url'])
        	return 'https://www.facebook.com/facebook';
        
        return $fb['page_url'];
    }
    
    private function getUrlContentCurl($url, $useragent = null) 
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ($useragent)
            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $data = curl_exec($ch);
        curl_close($ch);
        
        return $data;
    }
    
    function getAttribute($attrib, $tag){
          $re = '/'.$attrib.'=["\']?([^"\' ]*)["\' ]/is';
          preg_match($re, $tag, $match);
          
          if($match){
            return urldecode($match[1]);
          }else {
            return false;
          }
    }
}