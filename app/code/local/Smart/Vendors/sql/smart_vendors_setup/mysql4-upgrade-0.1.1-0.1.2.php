<?php
/**
 * Created by PhpStorm.
 * User: Sonnv
 * Date: 6/9/14
 * Time: 8:44 AM
 */ 
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();


$objCatalogEavSetup = Mage::getResourceModel('catalog/eav_mysql4_setup', 'core_setup');
$attributeModel = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', "vendor");
if(!$attributeModel->getId()){
    $objCatalogEavSetup->addAttribute('catalog_product', 'vendor', array(
        'group' => 'General',
        'type' => 'int',
        'backend' => '',
        'frontend' => '',
        'label' => 'Vendor',
        'input' => 'select',
        'class' => '',
        'source' => 'smart_vendors/option',
        'is_global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_STORE,
        'visible' => true,
        'required' => true,
        'user_defined' => true,
        'searchable' => true, //use search
        'filterable' => false, //show sidebar in listing
        'is_filterable_in_search' => false,  // show sidebar in search page
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing'=> '1',
        'apply_to' => 'simple,configurable,virtual,bundle,downloadable,grouped',
        'unique' => false,

    ));
}


$installer->endSetup();