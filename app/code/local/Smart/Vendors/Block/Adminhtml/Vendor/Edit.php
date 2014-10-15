<?php

class Smart_Vendors_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
        $this->_blockGroup = 'smart_vendors';
        $this->_controller = 'adminhtml_vendor';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save Vendor'));
        $this->_updateButton('delete', 'label', $this->__('Delete Vendor'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        }
    }

    public function getHeaderText()
    {
        if(Mage::registry('smart_vendors')->getId())
        {
            return $this->__('Edit Vendor');
        } else {
            return $this->__('New Vendor');
        }
    }

}