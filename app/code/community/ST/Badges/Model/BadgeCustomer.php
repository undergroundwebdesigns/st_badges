<?php

/**
 * Model representing the fact that a user has a given badge.
 * @author Alex W
 */
class ST_Badges_Model_Badgecustomer extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badgecustomer');
    }

    public function getCustomerBadgeId($customer_id)
    {
        $badge = $this->getCustomerBadge($customer_id);
        return $badge->getData('badge_id');
    }

    public function setCustomerBadgeId($customer_id, $new_badge_id)
    {
        $badge = $this->getCustomerBadge($customer_id);
        $badge->setBadgeId($new_badge_id);
        $badge->setCustomerId($customer_id);
        $badge->save();

        return $this;
    } 

    /**
     * Returns the BadgeCustomer record for the given $customer_id, or a blank one if none exists.
     * @params int $customer_id
     * @return ST_Badges_Model_Badgecustomer
     */
    public function getCustomerBadge($customer_id)
    {
        $badge = $this->getCollection()
            ->addFilter('customer_id', $customer_id)->getFirstItem();

        return $badge;
    }
}
