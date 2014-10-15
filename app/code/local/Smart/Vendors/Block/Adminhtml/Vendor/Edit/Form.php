<?php

class Smart_Vendors_Block_Adminhtml_Vendor_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    public function __construct()
    {
        parent::__construct();

        $this->setId('smart_vendors_vendor_form');
        $this->setTitle('Vendor Information');
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('smart_vendors');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('vendor_id' => $this->getRequest()->getParam('vendor_id'))),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}