<?php

/**
 * Form container for the form to edit the badges in the system.
 */
class ST_Badges_Block_Manage_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_ojectId = 'badge_id';
        $this->_blockGroup = 'stbadges';
        $this->_controller = 'manage_form';
    }

    public function getHeaderText()
    {
        return Mage::Helper('stbadges')->__('Edit Loyalty Badges');
    }
}
