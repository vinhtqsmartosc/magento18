<?php
/**
 * Created by JetBrains PhpStorm.
 * User: My PC
 * Date: 09/06/2014
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$config = new Mage_Core_Model_Config();

$config->saveConfig('design/theme/template', 'vendor', 'default', 0);
$config->saveConfig('design/theme/skin', 'vendor', 'default', 0);
$config->saveConfig('design/theme/layout', 'vendor', 'default', 0);

$installer->endSetup();