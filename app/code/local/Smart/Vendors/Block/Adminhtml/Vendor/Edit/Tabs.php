<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 07/10/2014
 * Time: 10:07
 * To change this template use File | Settings | File Templates.
 */

class Smart_Vendors_Block_Adminhtml_Vendor_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function _construct()
    {
        parent::_construct();
        $this->setId('vendor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle('Manage Vendor');
    }

    protected function _beforeToHtml()
    {
        $model = Mage::registry('smart_vendors');

        $this->addTab('vendor_form', array(
            'label' => 'Vendor Information',
            'title' => 'Vendor Information',
            'content' => $this->getLayout()->createBlock('smart_vendors/adminhtml_vendor_edit_tab_form')->toHtml(),
        ));

        $this->addTab('catalog_section', array(
            'label' => 'Associated Products',
            'url'       => $this->getUrl('*/*/select', array('vendor_id'=> $model->getId())),
            'class'     => 'ajax'
        ));

        return parent::_beforeToHtml();
    }
}
