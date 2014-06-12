<?php

class Smart_Vendors_Block_Vendors_List extends Mage_Core_Block_Template
{
    public function getAllVendor()
    {
        $vendorCollection = Mage::getModel('smart_vendors/vendors')->getCollection();
        return $vendorCollection;
    }
}