<?php
/**
 * Self-explanatory
 * @author Alex W
 */

class ST_Badges_Model_Mysql4_BadgeCustomer_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract {
    protected function _construct()
    {
        $this->_init('stbadges/badgecustomer');
    }
}
