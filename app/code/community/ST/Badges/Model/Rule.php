<?php

/**
 * Model representing rules that trigger to give customers a badge.
 * @author Alex W
 */
class ST_Badges_Model_Rule extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('stbadges/rule');
    }
}
