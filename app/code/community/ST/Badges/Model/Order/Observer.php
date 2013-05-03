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
            $customer_id = $customer->getId();
            $order_totals = Mage::getModel('sales/order')->getCollection()
            //    ->addAttributeToFilter('status', Mage_Sales_Model_Order::STATE_COMPLETE)
                ->addAttributeToFilter('customer_id', $customer_id)
                ->getColumnValues('grand_total');

            $grand_total = array_sum($order_totals);

            $existing_badge_id = Mage::getModel('stbadges/badgecustomer')->getCustomerBadgeId($customer_id);

            $new_badge_id = Mage::getModel('stbadges/badge')->getBadgeIdByRules($grand_total);

            if ($new_badge_id && $new_badge_id != $existing_badge_id)
            {
                Mage::getModel('stbadges/badgecustomer')->setCustomerBadgeId($customer_id, $new_badge_id);
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
        return $order->getCustomer();
    }
}
