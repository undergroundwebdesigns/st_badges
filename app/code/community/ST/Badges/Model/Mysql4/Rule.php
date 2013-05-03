<?php
/**
 * Self-explanatory
 */
class ST_Badges_Model_Mysql4_Rule extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/rule', 'rule_id');
    }
}
