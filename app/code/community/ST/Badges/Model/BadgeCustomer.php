<?php

/**
 * Model representing the fact that a user has a given badge.
 * @author Alex W
 */
class ST_Badges_Model_BadgeCustomer extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badge_customer');
    }
}
