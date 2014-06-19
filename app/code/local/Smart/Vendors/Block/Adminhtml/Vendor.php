<?php

class Smart_Vendors_Block_Adminhtml_Vendor extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'smart_vendors';
        $this->_controller = 'adminhtml_vendor';
        $this->_headerText = $this->__('Vendor');

        parent::__construct();
    }
}