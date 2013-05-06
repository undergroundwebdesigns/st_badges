<?php

/**
 * This block class is responsible for displaying to the user which (if any) badges they have earned.
 * @author Alex W
 */

class ST_Badges_Block_Badge_Sidebar extends Mage_Core_Block_Template {
    /**
     * @var Object $_badge, contains a local copy of the badge the customer has, or null if they have no badge.
     */
    protected $_badge = null;

    /**
     * Populate $_badge if the customer is logged in before preparing layout.
     * @return ST_Badges_Block_Badge_Sidebar
     */
    protected function _prepareLayout()
    {
        if ($this->isCustomerLoggedIn())
        {
            $customerId = $this->getCustomerId();
            $this->_badge = $this->_retrieveCustomerBadge($customerId);
        }

        return parent::_prepareLayout();
    }


    /**
     * Retrieves the badge record for the given customer by customer id.
     * @param int $customerId
     * @return ST_Badges_Model_Badge
     */
    protected function _retrieveCustomerBadge($customerId)
    {
        $badge_id = Mage::getModel('stbadges/badgecustomer')->getCustomerBadgeId($customerId);
        return Mage::getModel('stbadges/badge')->load($badge_id);
    }


    /**
     * Self-explanatory
     * @return boolean true if customer is logged in, false otherwise.
     */
    public function isCustomerLoggedIn()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    /**
     * Self-explanatory
     * @return int id of logged in customer or null
     */
    public function getCustomerId()
    {
        return Mage::getSingleton('customer/session')->getCustomerId();
    }

    /**
     * Self-explanatory
     * @return boolean True if the currently loaded customer has a badge.
     */
    public function doesCustomerHaveBadge()
    {
        return ($this->_badge && $this->_badge->getData('badge_id') != null);
    }

    /**
     * Self-explanatory
     * @return String The badge title of the customer's current badge, or null if they don't have one.
     */
    public function getBadgeTitle()
    {
        return $this->_badge->getData('title');
    } 

    /**
     * Self-explanatory
     * @return String The badge description  of the customer's current badge, or null if they don't have one.
     */
    public function getBadgeDescription()
    {
        return $this->_badge->getData('description');
    }

    /**
     * Self-explanatory
     * @return String The URL of the badge's image for the customer's current badge, or null if they don't have a badge.
     */
    public function getBadgeImageUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_store::URL_TYPE_MEDIA).$this->_badge->getData('icon_path');
    }

    /**
     * Self-explanatory
     * @see Mage_Customer_Helper_Data::getLoginUrl()
     */
    public function getLoginUrl()
    {
        return Mage::helper('customer')->getLoginUrl();
    }
}
