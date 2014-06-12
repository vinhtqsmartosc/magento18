<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 11/06/2014
 * Time: 09:42
 * To change this template use File | Settings | File Templates.
 */ 
class Smart_Vendors_Helper_Data extends Mage_Core_Helper_Abstract {

    public function registerVendorsUrl()
    {
        return Mage::getUrl('vendors/index/register/');
    }

    public function listVendorsUrl()
    {
        return Mage::getUrl('vendors/index/index');
    }


}