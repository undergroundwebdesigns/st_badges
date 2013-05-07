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

    public function validate()
    {
        if (!Zend_Validate::is( trim($this->getTitle()), 'NotEmpty')) {
            $errors[] = Mage::helper('stbadges')->__('The badge title cannot be empty.');
        }
        if (!Zend_Validate::is( trim($this->getIconPath()), 'NotEmpty')) {
            $errors[] = Mage::helper('stbadges')->__('Please select an icon for your badge.');
        }
        if (!Zend_Validate::is( trim($this->getTriggerPurchaseAmount()), 'NotEmpty')) {
            $errors[] = Mage::helper('stbadges')->__('The trigger purchase amount cannot be empty.');
        }
        
        if (empty($errors) || $this->getShouldIgnoreValidation()) {
            return true;
        }

        return $errors;
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
