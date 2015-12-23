<?php

class Chestnut_Cloudzoom_Block_Product_View_Media extends Mage_Catalog_Block_Product_View_Media
{
    protected $_params;

    public function getConfig($path, $store = NULL)
    {
        return $this->helper('chestnut_cloudzoom')->getConfig($path, $store);
    }

    public function getZoomParams()
    {
        if (!isset($this->_params)) {
            $output = "";
            $width = $this->getConfig('zoom_image/zoom_width');
            if (empty($width)) {
                $width = 400;
            }
            $height = $this->getConfig('zoom_image/zoom_height');
            if (empty($height)) {
                $height = 400;
            }

            $output .= "responsive: true,zoomWindowOffetx: 0,";
            $output .= "easing: " . $this->getConfig('zoom_image/easing') . ",";
            $output .= "zoomWindowWidth: '" . $width . "',";
            $output .= "zoomWindowHeight: '" . $height . "',";
            $output .= "zoomType: '" . $this->getConfig('zoom_image/zoom_type') . "',";
            if ($this->getConfig('zoom_image/zoom_type') == 'window') {
                $output .= "zoomWindowPosition: " . $this->getConfig('zoom_image/position') . ",";
            }
            if ($this->getConfig('zoom_image/tint')) {
                $output .= "tint: " . $this->getConfig('zoom_image/tint') . ",";
                $output .= "tintColour: '" . $this->getConfig('zoom_image/tint_color') . "',";
                $output .= "tintOpacity: " .$this->getConfig('zoom_image/tint_opacity');
            }

            $this->_params = '{' . $output . '}';
        }

        return $this->_params;
    }
}
