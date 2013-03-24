<?php

class YZ_StorePickup_Model_Carrier_Pickup extends Mage_Shipping_Model_Carrier_Pickup 
{

    /**
     * Override the existing method
     *
     * @param Mage_Shipping_Model_Rate_Request $data
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $result = Mage::getModel('shipping/rate_result');

        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier('pickup');
        $method->setCarrierTitle($this->getConfigData('title'));

        $method->setMethod('store');
        $method->setMethodTitle($this->getConfigData('name'));

        $method->setPrice(0);
        $method->setCost(0);

        $result->append($method);

        return $result;
    }

}
