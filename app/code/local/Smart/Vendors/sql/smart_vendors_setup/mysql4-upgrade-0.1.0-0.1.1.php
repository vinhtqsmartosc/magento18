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

$config = new Mage_Core_Model_Config();

$config->saveConfig('design/theme/template', 'vendors', 'default', 0);
$config->saveConfig('design/theme/skin', 'vendors', 'default', 0);
$config->saveConfig('design/theme/layout', 'vendors', 'default', 0);

$installer->endSetup();