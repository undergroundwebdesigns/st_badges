<?php

/**
 * Model representing the fact that a user has a given badge.
 */
class ST_Badges_Model_Badgecustomer extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badgecustomer');
    }
}
