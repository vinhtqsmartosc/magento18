<?php

class SM_Vendor_Model_Resource_Vendor extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('sm_vendor/vendors', 'id');
    }
}