<?php
/**
 * Extends the Mage Customer model to add some functionality specifically related to dealing with badges.
 */
class ST_Badges_Model_Customer extends Mage_Customer_Model_Customer
{
    protected $_badge; # The badge associated with this cusomter, if any.

    public function getPurchasesGrandTotal()
    {
        $order_totals = Mage::getModel('sales/order')->getCollection()
        //    ->addAttributeToFilter('status', Mage_Sales_Model_Order::STATE_COMPLETE)
            ->addAttributeToFilter('customer_id', $this->getId())
            ->getColumnValues('grand_total');

        return array_sum($order_totals);
    }

    public function getBadgeId()
    {
        return (int) $this->_badge->getBadgeId();
    }

    public function setBadgeId($badge_id)
    {
        $this->_badge->setBadgeId($badge_id);
        $this->_badge->setCustomerId($this->getId()); // Ensures that customer id is set even if we're saving a new record.
        $this->_badge->save();

        return $this;
    }

    public function _afterLoad()
    {
        $this->_badge = Mage::getModel('stbadges/badgecustomer')->getCollection()
            ->addFilter('customer_id', $this->getId())
            ->getFirstItem();
    }
}
