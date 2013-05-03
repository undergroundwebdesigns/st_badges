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

    public function getBadgeIdByRules($target_amount_spent)
    {
        $badge_rules = $this->getCollection()
            ->setOrder('trigger_purchase_amount', 'DESC');
            
        foreach($badge_rules as $rule)
        {
            if ($target_amount_spent >= $rule->getData('trigger_purchase_amount')) 
            {
                return $rule->getData('badge_id');
            }
        }

        return null;
    }
}
