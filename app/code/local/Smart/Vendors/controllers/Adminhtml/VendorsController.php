<?php

class Smart_Vendors_Adminhtml_VendorsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/smart_vendors_vendor')
            ->_title($this->__('Catalog'))->_title($this->__('Vendor'))
            ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
            ->_addBreadcrumb($this->__('Vendor'), $this->__('Vendor'));
        $this->renderLayout();
    }

    public function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('catalog/smart_vendors_vendor')
            ->_title($this->__('Catalog'))->_title($this->__('Vendor'))
            ->_addBreadcrumb($this->__('Catalog'), $this->__('Catalog'))
            ->_addBreadcrumb($this->__('Vendor'), $this->__('Vendor'));

        return $this;
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('smart_vendors/vendors');

        if ($id) {
            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This vendor no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getVendorName() : $this->__('New Vendor'));

        $data = Mage::getSingleton('adminhtml/session')->getVendorData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('smart_vendors', $model);
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Vendor') : $this->__('New Vendor'), $id ? $this->__('Edit Vendor') : $this->__('New Vendor'))
            ->_addContent($this->getLayout()->createBlock('smart_vendors/adminhtml_vendor_edit')->setData('action', $this->getUrl('*/*/save')))
            ->_addLeft($this->getLayout()->createBlock('smart_vendors/adminhtml_vendor_edit_tabs'))
            ->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {

            $vendor_id = (int) $postData['vendor_id'];
            $links = $this->getRequest()->getPost('links');
            $vasso_param = Mage::helper('adminhtml/js')->decodeGridSerializedInput($links['pvendors']);
            $productCollection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('vendor',$vendor_id)->load();

            $model = Mage::getSingleton('smart_vendors/vendors');
            try {

                foreach ($productCollection as $product) {
                    $product->setData('vendor', null);
                    $product->save();
                }

                foreach ($vasso_param as $key => $param) {
                    $product = Mage::getModel('catalog/product')->load($key);
                    $product->setData('vendor', $vendor_id);
                    $product->save();
                }

                $model->setData($postData);
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The vendor has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this vendor.'));
            }

            Mage::getSingleton('adminhtml/session')->setVendorData($postData);
            $this->_redirectReferer();
        }
    }

    public function messageAction()
    {
        $data = Mage::getModel('smart_vendors/vendors')->load($this->getRequest()->getParam('id'));
        echo $data->getContent();
    }

    public function selectAction()
    {
        $param = $this->getRequest()->getParam('vendor_id');
        Mage::register('vasso_id', $param);
        $this->loadLayout();
        $this->getLayout()->getBlock('adminhtml.vendor.edit.tab.vasso.pselect')
            ->setProductsVendor($this->getRequest()->getPost('products_vendor', null));;
        $this->renderLayout();
    }

    public function selectGridOnlyAction()
    {
        $param = $this->getRequest()->getParam('vendor_id');
        Mage::register('vasso_id', $param);
        $this->loadLayout();
        $this->getLayout()->getBlock('adminhtml.vendor.edit.tab.vasso.pselect')
            ->setProductsVendor($this->getRequest()->getPost('products_vendor', null));;
        $this->renderLayout();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/smart_vendors_vendor');
    }

}