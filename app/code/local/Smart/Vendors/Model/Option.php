<?php

class Smart_Vendors_Model_Option extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    public function getAllOptions()
    {

        if (is_null($this->_options)) {
            $result = array();
            $result[] = array(
                'label' => '-- Please Select --',
                'value' => ''
            );
            $colection = Mage::getModel('smart_vendors/vendors')->getCollection();
            if($colection){
                foreach($colection as $vendor){
                    $result[] = array(
                        'label' => $vendor->getVendorName(),
                        'value' => $vendor->getId()
                    );
                }
            }
            $this->_options = $result;

        }
        return $this->_options;
    }
}