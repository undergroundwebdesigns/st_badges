<?php
/**
 * Self-explanatory
 */
class ST_Badges_Model_Mysql4_BadgeCustomer extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badge_customer', 'badge_customer_id');
    }
}
