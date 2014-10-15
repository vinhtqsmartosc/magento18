<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 07/10/2014
 * Time: 13:55
 * To change this template use File | Settings | File Templates.
 */

class Smart_Vendors_Block_Adminhtml_Vendor_Edit_Tab_Vasso_Pselect extends Mage_Adminhtml_Block_Widget_Grid
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendor_products_grid');
        $this->setDefaultSort('entity_id');
        $this->setSkipGenerateContent(true);
        $this->setUseAjax(true);
        $this->setDefaultFilter(array('in_products'=>1));
    }

    public function getTabUrl()
    {
        $param = Mage::registry('vasso_id');
        return $this->getUrl('*/*/select', array('vendor_id'=>$param));
    }

    public function getTabClass()
    {
        return 'ajax';
    }

    protected function _addColumnFilterToCollection($column)
    {
        // Set custom filter for in product flag
        if ($column->getId() == 'in_products') {
            $productIds = $this->_getSelectedProducts();
            if (empty($productIds)) {
                $productIds = 0;
            }
            if ($column->getFilter()->getValue()) {
                $this->getCollection()->addFieldToFilter('entity_id', array('in'=>$productIds));
            }
            else {
                $this->getCollection()->addFieldToFilter('entity_id', array('nin'=>$productIds));
            }
        }
        else {
            parent::_addColumnFilterToCollection($column);
        }

        return $this;
    }

    /**
     * Prepare collection
     *
     * @return Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Group
     */
    protected function _prepareCollection()
    {

        $param = Mage::registry('vasso_id');
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');

//        $collection = Mage::getModel('catalog/product')
//            ->getProductCollection();

        if ($this->getIsReadonly() === true) {
            $productCollection->addFieldToFilter('entity_id', array('in' => $this->_getSelectedProducts()));
        }
        $this->setCollection($productCollection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('in_products', array(
            'header_css_class' => 'a-center',
            'type'      => 'checkbox',
            'name'      => 'in_products',
            'values'    => $this->_getSelectedProducts(),
            'align'     => 'center',
            'index'     => 'entity_id'
        ));

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('catalog')->__('ID'),
            'sortable'  => true,
            'width'     => '60px',
            'index'     => 'entity_id'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('catalog')->__('Name'),
            'index'     => 'name'
        ));
        $this->addColumn('sku', array(
            'header'    => Mage::helper('catalog')->__('SKU'),
            'width'     => '80px',
            'index'     => 'sku'
        ));
        $this->addColumn('price', array(
            'header'    => Mage::helper('catalog')->__('Price'),
            'type'      => 'currency',
            'currency_code' => (string) Mage::getStoreConfig(Mage_Directory_Model_Currency::XML_PATH_CURRENCY_BASE),
            'index'     => 'price'
        ));

        $this->addColumn('qty', array(
            'header'    => Mage::helper('catalog')->__('Default Qty'),
            'name'      => 'qty',
            'type'      => 'number',
            'validate_class' => 'validate-number',
            'index'     => 'qty',
            'width'     => '1',
            'editable'  => true
        ));

        $this->addColumn('position', array(
            'header'    => Mage::helper('catalog')->__('Position'),
            'name'      => 'position',
            'type'      => 'number',
            'validate_class' => 'validate-number',
            'index'     => 'position',
            'width'     => '1',
            'editable'  => true
        ));

        return parent::_prepareColumns();
    }

    /**
     * Get Grid Url
     *
     * @return string
     */
    public function getGridUrl()
    {
        $param = Mage::registry('vasso_id');
        return $this->_getData('grid_url')
            ? $this->_getData('grid_url') : $this->getUrl('*/*/selectGridOnly', array('vendor_id'=>$param));
    }

    public function getSelectedVendorProducts()
    {
        $param = Mage::registry('vasso_id');
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('vendor',$param)->load();
        $products = array();
        foreach ($productCollection as $product) {
            $products[$product->getId()] = array(
                'id'        => $product->getId(),
                'qty'       => $product->getQty(),
                'position'  => $product->getPosition()
            );
        }
        return $products;
    }

    /**
     * Retrieve selected grouped products
     *
     * @return array
     */
    protected function _getSelectedProducts()
    {
        $products = $this->getProductsVendor();
        if (!is_array($products)) {
            $products = array_keys($this->getSelectedVendorProducts());
        }
        return $products;
    }

    public function getTabLabel()
    {
        return Mage::helper('catalog')->__('Associated Products');
    }
    public function getTabTitle()
    {
        return Mage::helper('catalog')->__('Associated Products');
    }
    public function canShowTab()
    {
        return true;
    }
    public function isHidden()
    {
        return false;
    }
}