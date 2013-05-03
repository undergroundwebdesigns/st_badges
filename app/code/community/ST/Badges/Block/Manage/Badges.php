<?php
/* 
 * This block clas is responsible for listing badges in the admin panel.
 * @author Alex W
 */
class ST_Badges_Block_Manage_Badges extends Mage_Adminhtml_Block_Widget_Grid_Container {

    /**
     * Self-explanatory
     *
     * @see Mage_Adminhtml_Block_Widget_Grid_Container::__construct()
     */
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'Manage_Badges';
        $this->_blockGroup = 'stbadges';
        $this->_headerText = Mage::helper('stbadges')->__("Badges");

        return $this;
    }
}
