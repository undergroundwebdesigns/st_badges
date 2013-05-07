<?php

/**
 * Form container for the form to edit the badges in the system.
 */
class ST_Badges_Block_Manage_Form_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {

        $this->_objectId = 'badge_id';
        $this->_blockGroup = 'stbadges';
        $this->_controller = 'manage_form';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('stbadges')->__('Save Badge'));
        $this->_updateButton('delete', 'label', Mage::helper('stbadges')->__('Delete Badge'));

        if (!Mage::getSingleton('admin/session')->isAllowed('badges/delete')) {
            $this->_removeButton('delete');
        }
    }

    public function getHeaderText()
    {
        if (Mage::registry('badge')->getId()) {
            return Mage::Helper('stbadges')->__('Edit %s Badges', $this->htmlEscape(Mage::registry('badge')->getTitle()));
        } else {
            return Mage::Helper('stbadges')->__('Create a New Loyalty Badge');
        }
    }
}
