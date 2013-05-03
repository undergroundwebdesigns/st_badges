<?php
/* 
 * This block clas is responsible for listing badge rules in the admin panel.
 * @author Alex W
 */
class ST_Badges_Block_Manage_Rules extends Mage_Adminhtml_Block_Widget_Grid_Container {

    /**
     * Self-explanatory
     *
     * @see Mage_Adminhtml_Block_Widget_Grid_Container::__construct()
     */
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Manage_Rules';
        $this->_blockGroup = 'stbadges';
        $this->_headerText = Mage::helper('stbadges')->__("Badge Rules");

        return $this;
    }
}
