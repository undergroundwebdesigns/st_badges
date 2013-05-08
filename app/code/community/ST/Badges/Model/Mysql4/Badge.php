<?php

class ST_Badges_Model_Mysql4_Badge extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badge', 'badge_id');
    }
}
