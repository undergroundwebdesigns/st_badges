<?php

/**
 * Observer class to handle order related events.
 * @author Alex W
 */
class ST_Badges_Model_Order_Observer extends Varien_Object {

    /**
     * Called after order is placed to determine if the user has earned a (new) badge.
     *
     * @param Varien_Event_Observer $observer, contains event data from sales_order_place_after event.
     * @return ST_Badges_Model_Order_Observer
     */
    public function awardBadge($observer)
    {
        try {
            $customer = $this->getCustomer($observer);

            $existingBadgeId = $customer->getBadgeId();

            $newBadgeId = Mage::getModel('stbadges/badge')->getBadgeByAmountSpent($customer->getPurchasesGrandTotal());

            if ($newBadgeId && $newBadgeId != $existingBadgeId)
            {
                $customer->setBadgeId($newBadgeId);
            }
        }
        catch (Exception $e)
        {
            Mage::log("An exception occured in ".__CLASS__."::".__FUNCTION__."()");
            Mage::logException($e);
        }

        return $this;
    }

    /**
     * Returns the customer object from an order observer.
     *
     * @param Varien_Event_Observer $observer.
     * @return Customer
     */
    protected function getCustomer($observer)
    {
        $order = $observer->getOrder();
        // Uses a custom sub-class of the magento customer model that I have extended with some methods to manage badges.
        return Mage::getModel('stbadges/customer')->load($order->getCustomer()->getId());
    }
}
