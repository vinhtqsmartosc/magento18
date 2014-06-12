<?php

class Smart_Vendors_Block_Vendors_View extends Mage_Core_Block_Template
{
    public function getVendor()
    {
        if(Mage::registry('current_vendor')){
            return Mage::registry('current_vendor');
        } else return null;
    }

    public function getVendorId(){
        $id = null;
        $vendor = $this->getVendor();
        if($vendor->getId()){
            $id = $vendor->getId();
        }
        return $id;
    }

    public function getProductCollectionByVendor()
    {
        $productCollection = null;
        if(is_null($productCollection)){
            $productCollection = Mage::getModel('catalog/product')->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter('vendor',$this->getVendorId())->load();
        }
        return $productCollection;
    }
}