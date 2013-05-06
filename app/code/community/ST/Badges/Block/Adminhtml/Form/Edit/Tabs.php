<?php

class ST_Badges_Block_Adminhtml_Form_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('form_tabs');
        $this->setDestElementId('edit_form');
        $this->setTtiel(Mage::helper('stbadges')->__('Loyalty Badges'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('stbadges')->__('Badge Information'),
            'title'     => Mage::helper('stbadges')->__('Badge Information'),
            'content'   => $this->getLayout()->createBlock('stbadges/adminhtml_form_edit_tab_form')->toHtml(), 
        ));

        return parent::_beforeToHtml();
    }
}
