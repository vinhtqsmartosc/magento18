<?php

class Smart_Vendors_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function registerAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction()
    {
        $vendor_name = $this->getRequest()->getPost('vendor_name');
        $vendor_email = $this->getRequest()->getPost('vendor_email');
        $vendor_contact = $this->getRequest()->getPost('vendor_contact');
        $vendor_description = $this->getRequest()->getPost('vendor_description');

        $vendorModel = Mage::getModel('smart_vendors/vendors');
        $vendorCollection = $vendorModel->getCollection();

        $flag = true;

        foreach ($vendorCollection as $vendor) {
            if($vendor->getVendorName() == $vendor_name) {
                $flag = false;
            }
        }

        if($flag) {
            try {
                $vendorModel->setVendorName($vendor_name);
                $vendorModel->setVendorEmail($vendor_email);
                $vendorModel->setVendorContact($vendor_contact);
                $vendorModel->setVendorDescription($vendor_description);
                $vendorModel->save();
                Mage::getSingleton('core/session')->addSuccess('Vendor is added successfully');
                $this->_redirect('*/*/index');
                return;
            } catch(Exception $e) {
                Mage::getSingleton('core/session')->addError('Unable to save vendor');
                $this->_redirect('*/*/register');
                return;
            }
        } else {
            Mage::getSingleton('core/session')->addError('This vendor is existed');
            $this->_redirect('*/*/register');
            return;
        }

    }

    public function viewAction()
    {
        $vendorId = (int)$this->getRequest()->getParam('id');
        $vendor = Mage::getModel('smart_vendors/vendors')
                    ->setStoreId(Mage::app()->getStore()->getId())
                    ->load($vendorId);
        Mage::register('current_vendor', $vendor);
        $this->loadLayout();
        $this->renderLayout();
    }

}