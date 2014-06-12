<?php

class Smart_Vendors_Model_Resource_Vendors_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('smart_vendors/vendors');
    }
}