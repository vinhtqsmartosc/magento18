<?php

class SM_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_vendor/vendors');
    }

    public function saveVendor($name, $email, $contact, $description)
    {
        $flag = true;
        $vendorCollection = $this->getCollection();
        foreach ($vendorCollection as $vendor) {
            if($vendor->getName() == $name) {
                $flag = false;
            }
        }

        if($flag) {
            $this->setName($name);
            $this->setEmail($email);
            $this->setContact($contact);
            $this->setDescription($description);
            $this->save();
        }
    }
}