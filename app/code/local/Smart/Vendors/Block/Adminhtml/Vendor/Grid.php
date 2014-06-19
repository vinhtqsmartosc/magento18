<?php

class Smart_Vendors_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('id');
        $this->setId('smart_vendors_vendor_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('smart_vendors/vendors')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('vendor_id',
            array(
                'header' => $this->__('Vendor ID'),
                'align' =>'right',
                'width' => '70px',
                'index' => 'vendor_id'
            )
        );

        $this->addColumn('vendor_name',
            array(
                'header' => $this->__('Vendor Name'),
                'index' => 'vendor_name'
            )
        );

        $this->addColumn('vendor_email',
            array(
                'header' => $this->__('Vendor Email'),
                'index' => 'vendor_email'
            )
        );

        $this->addColumn('vendor_contact',
            array(
                'header' => $this->__('Vendor Contact'),
                'index' => 'vendor_contact'
            )
        );

        return parent::_prepareColumns();

    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}