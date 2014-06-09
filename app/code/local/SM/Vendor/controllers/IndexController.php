<?php

class SM_Vendor_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function createAction()
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
        echo 'a';
    }
}