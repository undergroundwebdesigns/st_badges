<?php

/**
 * Model representing badges that can be awarded to customers.
 * @author Alex W
 */
class ST_Badges_Model_Badge extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/badge');
    }
}
