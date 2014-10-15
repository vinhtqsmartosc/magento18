<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 07/10/2014
 * Time: 10:28
 * To change this template use File | Settings | File Templates.
 */

class Smart_Vendors_Block_Adminhtml_Vendor_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('smart_vendors');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->__('Vendor Information'),
            'class'     => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('vendor_id', 'hidden', array(
                'name' => 'vendor_id',
            ));
        }

        $fieldset->addField('vendor_name', 'text', array(
            'name'      => 'vendor_name',
            'label'     => $this->__('Vendor Name'),
            'title'     => $this->__('Vendor Name'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $fieldset->addField('vendor_email', 'text', array(
            'name'      => 'vendor_email',
            'label'     => $this->__('Vendor Email'),
            'title'     => $this->__('Vendor Email'),
            'required'  => true,
            'class'     => 'required-entry validate-email',
        ));

        $fieldset->addField('vendor_contact', 'text', array(
            'name'      => 'vendor_contact',
            'label'     => $this->__('Vendor Contact'),
            'title'     => $this->__('Vendor Contact'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $fieldset->addField('vendor_description', 'textarea', array(
            'name'      => 'vendor_description',
            'label'     => $this->__('Vendor Description'),
            'title'     => $this->__('Vendor Description'),
            'required'  => true,
            'class'     => 'required-entry',
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}