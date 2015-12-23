<?php
/**
 * 
 * Fengo Magento Theme
 * 
 */
class Chestnut_Layerednav_Helper_Data extends Mage_Core_Helper_Abstract 
{

    protected $_params = null;
    protected $_targetUrl = null;
    
    public function getConfig($path, $store = NULL) 
    {
        return Mage::getStoreConfig('chestnut_layerednav/' . $path, $store);
    }
    
    public function getInitData() 
    {
        $ajaxUrl = '';
        if ($cat = Mage::registry('current_category')) {
            $ajaxUrl = Mage::getUrl('layerednav/front/category', array('id' => $cat->getId()));
        }

        $ajaxUrl = $this->stripQuery($ajaxUrl);
        $url = $this->getTargetUrl();

        $pageKey = Mage::getBlockSingleton('page/html_pager')->getPageVarName();

        //$queryStr = $this->getParams(true, $pageKey);
        $queryStr = $this->getParams(true, null);
        if ($queryStr)
            $queryStr = substr($queryStr, 1);

        if (false !== strpos($url, '?')) {
            $url = substr($url, 0, strpos($url, '?'));
        }
        return array($url, $queryStr, $ajaxUrl);
    }

    public function getTargetUrl() 
    {
        if (is_null($this->_targetUrl)) {
            $url = '';

            $allParams = $this->getParams();
            $defaultQueryKeys = $this->getDefaultQueryKeys();

            $query = array();
            foreach ($allParams as $key => $value) {
                if (in_array($key, $defaultQueryKeys))
                    $query[$key] = $value;
            }

            $category = Mage::registry('current_category');
            $rootId = Mage::app()->getStore()->getRootCategoryId();
            if ($category && $category->getId() != $rootId) {
                $url = $category->getUrl();
            } else {
                $url = Mage::app()->getStore()->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
            }
            $url .= $this->toQuery($query);
            $this->_targetUrl = $url;
        }

        return $this->_targetUrl;
    }

    public function wrapProducts($html) {
        $html = str_replace('onchange="setLocation', 'onchange="catalog_toolbar_make_request', $html);

        $loaderHtml = '<div class="layerednav_loading" style="display:none"><img src="' . Mage::getDesign()->getSkinUrl('images/chestnut/layerednav/ajax-loader.gif') . '" alt="Loading" /></div>';
        $html .= $loaderHtml;

        if (Mage::app()->getRequest()->isXmlHttpRequest()) {
            $html = str_replace('?___SID=U&amp;', '?', $html);
            $html = str_replace('?___SID=U', '', $html);
            $html = str_replace('&amp;___SID=U', '', $html);

            $k = Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED;
            $v = Mage::helper('core')->urlEncode($this->getTargetUrl());
            $html = preg_replace("#$k/[^/]+#", "$k/$v", $html);
        } else {
            $html = '<div id="chestnut_layerednav_container">' . $html . '</div>' . '';
        }
        
        return $html;
    }

    public function getParam($key) {
        $params = $this->getParams();
        return isset($params[$key]) ? $params[$key] : null;
    }

    public function getParams($asString = false, $without = null) {
        if (is_null($this->_params)) {

            $session = Mage::getSingleton('catalog/session');
            $needClearAll = false;

            $currentCurrencyRate = $session->getCurrentCurrencyRate();
            $currencyRate = Mage::app()->getStore()->convertPrice(1000000, false);
            $currencyRate = $currencyRate / 1000000;

            $needClearPrice = false;

            if ($currentCurrencyRate AND $currentCurrencyRate != $currencyRate) {
                $needClearPrice = true;
            }

            if ($needClearPrice) {
                $sess = (array) $session->getLayerParams();
                if ($sess) {
                    $defaultQueryKeys = $this->getDefaultQueryKeys();
                    foreach ($sess as $sKey => $sVal) {
                        if (!in_array($sKey, $defaultQueryKeys)) {
                            $attribute = Mage::getModel('eav/entity_attribute');
                            $attribute->load($sKey, 'attribute_code');
                            if ($attribute->getFrontendInput() == 'price') {
                                unset($sess[$sKey]);
                            }
                        }
                    }
                    $session->setLayerParams($sess);
                }
            }

            $session->setCurrentCurrencyRate($currencyRate);

            $query = Mage::app()->getRequest()->getQuery();
            $sess = (array) $session->getLayerParams();
            $this->_params = array_merge($sess, $query);

            if (!empty($query['clearall']) OR $needClearAll) {
                $this->_params = array();
            }
            $sess = array();
            foreach ($this->_params as $key => $value) {
                if ($value && 'clear' != $value)
                    $sess[$key] = $value;
            }

            if (Mage::registry('new_category') AND isset($sess['p'])) {
                //unset($sess['p']);
                $sess = array();
            }

            $session->setLayerParams($sess);
            $this->_params = $sess;

            Mage::register('current_session_params', $sess);
        }

        if ($asString) {
            return $this->toQuery($this->_params, $without);
        }

        return $this->_params;
    }

    public function toQuery($params, $without = null) {
        if (!is_array($without))
            $without = array($without);

        $queryStr = '?';
        foreach ($params as $k => $v) {
            if (strpos($k, "amp;") !== false)
                continue;

            if (!in_array($k, $without))
                $queryStr .= $k . '=' . urlencode($v) . '&';
        }
        return substr($queryStr, 0, -1);
    }

    public function stripQuery($url) {
        $pos = strpos($url, '?');
        if (false !== $pos)
            $url = substr($url, 0, $pos);
        return $url;
    }

    public function getClearUrl($requestVar = NULL) {
        $params = array();
        $query = $this->getParams();
        if (empty($query[$requestVar])) 
            return null;        
        $query[$requestVar] = null;
        $params['_use_rewrite'] = true;
        $params['_query'] = $query;
        return Mage::getUrl('*/*/*', $params);
    }

    public function getClearAllUrl($baseUrl) {
        return $baseUrl . '?clearall=true';
    }

    public function getNeedClearAll() {
        if ($aParams = Mage::registry('current_session_params')) {
            $needClearAll = false;
            $defaultQueryKeys = $this->getDefaultQueryKeys();
            foreach ($aParams as $sKey => $sVal) {
                if (!in_array($sKey, $defaultQueryKeys)) {
                    $needClearAll = true;
                }
            }
            return $needClearAll;
        } else {
            return false;
        }
        return true;
    }

    public function getCacheKey($attrCode) {
        $defaultQueryKeys = $this->getDefaultQueryKeys();
        $defaultQueryKeys[] = $attrCode;
        return md5($this->getParams(true, $defaultQueryKeys));
    }

    protected function getDefaultQueryKeys() {
        return array('x', 'y', 'mode', 'p', 'order', 'dir', 'limit', 'q', '___store', '___from_store', 'sns');
    }
}