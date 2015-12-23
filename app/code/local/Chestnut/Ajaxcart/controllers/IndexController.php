<?php
require_once 'Mage/Checkout/controllers/CartController.php';
class Chestnut_Ajaxcart_IndexController extends Mage_Checkout_CartController
{
	public function addAction()
	{
		$cart   = $this->_getCart();
		$params = $this->getRequest()->getParams();
		$theme = Mage::helper('fengo');
		if($params['isAjax'] == 1){
			$response = array();
			try {
				if (isset($params['qty'])) {
					$filter = new Zend_Filter_LocalizedToNormalized(
					array('locale' => Mage::app()->getLocale()->getLocaleCode())
					);
					$params['qty'] = $filter->filter($params['qty']);
				}

				$product = $this->_initProduct();
				$related = $this->getRequest()->getParam('related_product');

				if (!$product) {
					$response['status'] = 'ERROR';
					$response['message'] = $this->__('Unable to find Product ID');
				}

				$cart->addProduct($product, $params);
				if (!empty($related)) {
					$cart->addProductsByIds(explode(',', $related));
				}

				$cart->save();

				$this->_getSession()->setCartWasUpdated(true);

				Mage::dispatchEvent('checkout_cart_add_product_complete',
					array('product' => $product, 'request' => $this->getRequest(), 'response' => $this->getResponse())
				);

				if (!$cart->getQuote()->getHasError()){
					$message = $this->__('%s was added to your shopping cart.', Mage::helper('core')->htmlEscape($product->getName()));
					$response['status'] = 'SUCCESS';
					$response['message'] = $message;
					$this->loadLayout();
					$cart_mini = $this->getLayout()->getBlock('cart_mini')->toHtml();
					if ($theme->getSetting('header/header_style') == 'type2') {
						$cart_mini = $this->getLayout()->getBlock('cart_mini_type2')->toHtml();
					}
					$cart_sidebar = $this->getLayout()->getBlock('cart_sidebar')->toHtml();
					Mage::register('referrer_url', $this->_getRefererUrl());
					$response['cartmini'] = $cart_mini;
					$response['cartsidebar'] = $cart_sidebar;
				}
			} catch (Mage_Core_Exception $e) {
				$msg = "";
				if ($this->_getSession()->getUseNotice(true)) {
					$msg = $e->getMessage();
				} else {
					$messages = array_unique(explode("\n", $e->getMessage()));
					foreach ($messages as $message) {
						$msg .= $message.'<br/>';
					}
				}

				$response['status'] = 'ERROR';
				$response['message'] = $msg;
			} catch (Exception $e) {
				$response['status'] = 'ERROR';
				$response['message'] = $this->__('Cannot add the item to shopping cart.');
				Mage::logException($e);
			}
			
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
		}else{
			return parent::addAction();
		}
	}
	
	public function optionsAction(){
		$productId = $this->getRequest()->getParam('product_id');
		// Prepare helper and params
		$viewHelper = Mage::helper('catalog/product_view');

		$params = new Varien_Object();
		$params->setCategoryId(false);
		$params->setSpecifyOptions(false);

		// Render page
		try {
			$viewHelper->prepareAndRender($productId, $this, $params);
		} catch (Exception $e) {
			if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
				if (isset($_GET['store'])  && !$this->getResponse()->isRedirect()) {
					$this->_redirect('');
				} elseif (!$this->getResponse()->isRedirect()) {
					$this->_forward('noRoute');
				}
			} else {
				Mage::logException($e);
				$this->_forward('noRoute');
			}
		}
	}

	public function updateItemOptionsAction()
    {
        $cart   = $this->_getCart();
        $id = (int) $this->getRequest()->getParam('id');
        $params = $this->getRequest()->getParams();
		$theme = Mage::helper('fengo');

        if (!isset($params['options'])) {
            $params['options'] = array();
        }
		if($params['isAjax'] == 1){
			$response = array();
	        try {
	            if (isset($params['qty'])) {
	                $filter = new Zend_Filter_LocalizedToNormalized(
	                    array('locale' => Mage::app()->getLocale()->getLocaleCode())
	                );
	                $params['qty'] = $filter->filter($params['qty']);
	            }

	            $quoteItem = $cart->getQuote()->getItemById($id);
	            if (!$quoteItem) {
	            	$response['status'] = 'ERROR';
					$response['message'] = $this->__('Quote item is not found.');
	            }

	            $item = $cart->updateItem($id, new Varien_Object($params));
	            if (is_string($item)) {
	            	$response['status'] = 'ERROR';
					$response['message'] = $this->__($item);
	            }
	            if ($item->getHasError()) {
	            	$response['status'] = 'ERROR';
					$response['message'] = $this->__($item->getMessage());
	            }

	            $related = $this->getRequest()->getParam('related_product');
	            if (!empty($related)) {
	                $cart->addProductsByIds(explode(',', $related));
	            }

	            $cart->save();

	            $this->_getSession()->setCartWasUpdated(true);

	            Mage::dispatchEvent('checkout_cart_update_item_complete',
	                array('item' => $item, 'request' => $this->getRequest(), 'response' => $this->getResponse())
	            );
	            if (!$cart->getQuote()->getHasError()) {
		            $message = $this->__('%s was updated in your shopping cart.', Mage::helper('core')->escapeHtml($item->getProduct()->getName()));
					$response['status'] = 'SUCCESS';
					$response['message'] = $message;
					$this->loadLayout();
					$cart_mini = $this->getLayout()->getBlock('cart_mini')->toHtml();
					if ($theme->getSetting('header/header_style') == 'type2') {
						$cart_mini = $this->getLayout()->getBlock('cart_mini_type2')->toHtml();
					}
					$cart_sidebar = $this->getLayout()->getBlock('cart_sidebar')->toHtml();
					Mage::register('referrer_url', $this->_getRefererUrl());
					$response['cartmini'] = $cart_mini;
					$response['cartsidebar'] = $cart_sidebar;
				}
	        } catch (Mage_Core_Exception $e) {
	            if ($this->_getSession()->getUseNotice(true)) {
	                $this->_getSession()->addNotice($e->getMessage());
	            } else {
	                $messages = array_unique(explode("\n", $e->getMessage()));
	                foreach ($messages as $message) {
	                    $this->_getSession()->addError($message);
	                }
	            }

	            $response['status'] = 'ERROR';
				$response['message'] = $e->getMessage();
	        } catch (Exception $e) {
				$response['status'] = 'ERROR';
				$response['message'] = $this->__('Cannot update the item.');
	            Mage::logException($e);
	        }
			$this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
			return;
		} else {
			return parent::updateItemOptionsAction();
		}
    }
}