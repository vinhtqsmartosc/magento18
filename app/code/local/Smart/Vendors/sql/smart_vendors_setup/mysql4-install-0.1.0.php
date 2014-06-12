<?php
/**
 * Created by PhpStorm.
 * User: Sonnv
 * Date: 6/9/14
 * Time: 8:44 AM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `sm_vendors` (
  `vendor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_contact` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `vendor_description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
");

$installer->endSetup();