<?php

class Chestnut_Blog_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action 
{
    protected function _isAllowed() 
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/blog/category');
    }

    protected function _initAction() 
    {
        $this->loadLayout()
                ->_setActiveMenu('blog/category')
                ->_addBreadcrumb(Mage::helper('adminhtml')->__('Category Manager'), Mage::helper('adminhtml')->__('Category Manager'));
        $this->displayTitle('Categories');

        return $this;
    }

    public function indexAction() 
    {
        $this->_initAction()->renderLayout();
    }

    public function deleteAction() 
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('blog/category');

                $model->load($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Category was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() 
    {
        $blogIds = $this->getRequest()->getParam('blog');
        if (!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select categories'));
        } else {
            try {
                foreach ($blogIds as $blogId) {
                    $blog = Mage::getModel('blog/category')->load($blogId);
                    $blog->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                        Mage::helper('adminhtml')->__(
                                'Total of %d record(s) were successfully deleted', count($blogIds)
                        )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }

    public function editAction() 
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('blog/category')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('blog_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('blog/category');
            $this->displayTitle('Edit category');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Blog Manager'), Mage::helper('adminhtml')->__('BlogManager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Category Manager'), Mage::helper('adminhtml')->__('Category Manager'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_category_edit'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Category does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction() 
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('blog/category')->load($id);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('blog_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('blog/category');
        $this->displayTitle('Add new category');

        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Blog Manager'), Mage::helper('adminhtml')->__('BlogManager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Category Manager'), Mage::helper('adminhtml')->__('Category Manager'));

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_category_edit'));

        $this->renderLayout();
    }

    public function saveAction() 
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('blog/category');
            $model->setData($data)
                    ->setId($this->getRequest()->getParam('id'));

            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('blog')->__('Category was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('Unable to find category to save'));
        $this->_redirect('*/*/');
    }

    public function levelAction() 
    {
        $level = $this->getRequest()->getParam('level');
        $collection = Mage::getModel('blog/category')->getCollection();
        if (isset($level)) {
            $collection->addLevelFilter($level);
        }
        $collection->setOrder('sort_order', 'asc');
        $response = array();
        $response['options'] = '';
        foreach ($collection as $cat) {
            $response['options'] .= '<option value="' . $cat->getCatId() . '">' . $cat->getTitle() . '</option>';
        }

        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }

    protected function displayTitle($data = null, $root = 'Blog') 
    {
        if (!Mage::helper('blog')->magentoLess14()) {
            if ($data) {
                if (!is_array($data)) {
                    $data = array($data);
                }
                foreach ($data as $title) {
                    $this->_title($this->__($title));
                }
                $this->_title($this->__($root));
            } else {
                $this->_title($this->__('Blog'))->_title($root);
            }
        }
        return $this;
    }

}
