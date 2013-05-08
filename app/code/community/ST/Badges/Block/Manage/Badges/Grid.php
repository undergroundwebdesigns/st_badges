<?php

/**
* Class required to display badges collection as a grid block in the manage grid container.
*/
class ST_Badges_Block_Manage_Badges_Grid extends Mage_Adminhtml_Block_Widget_Grid 
{

    /**
    * Initialize grid
    * 
    * @see Mage_Adminhtml_Block_Widget_Grid::__construct
    */
    public function __construct()
    {
        parent::__construct();        
        $this->setId('Badges_grid');
        $this->setDefaultSort('trigger_purchase_amount');
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
        $collection = Mage::getModel('stbadges/badge')->getCollection();
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
        $this->addColumn('title',
            array(
                'header'    => Mage::helper( 'stbadges' )->__( 'Title' ),
                'align'     => 'left',
                'width'     => '100px',
                'index'     => 'title'
            )
        );       
        $this->addColumn('image',
            array(
                'header'    => Mage::helper( 'stbadges' )->__( 'Image'),
                'align'     => 'left',
                'width'     => '100px',
                'type'      => 'image',
                'index'     => 'icon_path'
            )
        );       

        $this->addColumn('trigger_purchase_amount',
            array(
                'header'    => Mage::helper('stbadges')->__( 'Trigger Purchase Amount'),
                'align'     => 'right',
                'index'     => 'trigger_purchase_amount',
                'width'     => '100px',
            )
        );

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('stbadges')->__('Action'),
                'width'     => '50px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('stbadges')->__('Edit'),
                        'url'       => array('base' => '*/*/edit'),
                        'field'     => 'badge_id',
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
            )
        );

        return parent::_prepareColumns(); 
    }
}

