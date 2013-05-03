<?php

/**
* Class required to display rules collection as a grid block in the manage grid container.
* 
* @author Alex W
*/
class ST_Badges_Block_Manage_Rules_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{

    /**
    * Initialize grid
    * 
    * @see Mage_Adminhtml_Block_Widget_Grid::__construct
    */
    public function __construct()
    {
        parent::__construct();        
        $this->setId('Rules_grid');
        $this->setDefaultSort('rule_id');
        $this->setDefaultDir('asc');

        return $this;
    }

    /**
    * Self-explanatory  
    * 
    * @see Mage_Adminhtml_Block_Widget_Grid::_prepareCollection()
    * @return ST_Token_Block_Adminhtml_Listbadgess_Grid
    */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('stbadges/rule')->getCollection();
        var_dump($collection);
        die();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
    * Self-explanatory
    * 
    * @see Mage_Adminhtml_Block_Widget_Grid::_prepareColumns()
    * @return ST_Token_Block_Adminhtml_Listbadgess_Grid
    */
    protected function _prepareColumns()
    {
        $this->addColumn('rule_id', 
            array(
                'header'    => Mage::helper( 'stbadges' )->__( 'Rule ID' ),
                'align'     => 'right',
                'width'     => '50px',
                'index'     => 'rule_id'
            )
        );       
        $this->addColumn('name',
            array(
                'header'    => Mage::helper( 'stbadges' )->__( 'Name' ),
                'align'     => 'right',
                'width'     => '100px',
                'index'     => 'name'
            )
        );       
        $this->addColumn('trigger_purchase_amount',
            array(
                'header'    => Mage::helper( 'stbadges' )->__( 'Trigger Amount'),
                'align'     => 'left',
                'width'     => '50px',
                'index'     => 'trigger_purchase_amount'
            )
        );       

        return parent::_prepareColumns(); 
    }
}

