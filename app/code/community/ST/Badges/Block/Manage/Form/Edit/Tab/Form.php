<?php
class ST_Badges_Block_Manage_Form_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $model = Mage::registry('badge');
        $data = $model->getData();
        
        $fieldset = $form->addFieldset('form_form', array('legend' => Mage::helper('stbadges')->__('Badge Information')));

        $fieldset->addField('title', 'text', array(
            'label'         => Mage::helper('stbadges')->__('Title'),
            'class'         => 'required-entry',
            'required'      => true,
            'name'          => 'title',
        ));

        $fieldset->addField('description', 'textarea', array(
            'label'         => Mage::helper('stbadges')->__('Description'),
            'class'         => 'required-entry',
            'required'      => true,
            'name'          => 'description',
        ));
        
        $fieldset->addField('trigger_purchase_amount', 'text', array(
            'label'         => Mage::helper('stbadges')->__('Trigger Purchase Amount'),
            'class'         => 'required-entry',
            'required'      => true,
            'name'          => 'trigger_purchase_amount',
        ));

        $fieldset->addField('icon_path', 'image', array(
            'label'         => Mage::helper('stbadges')->__('Badge Icon'),
            'required'      => true,
            'class'         => 'required-entry',
            'name'          => 'icon_path',
        ));

        $data['icon_path'] = isset($data['icon_path']) ? Mage::getBaseUrl(Mage_Core_Model_store::URL_TYPE_MEDIA) . $data['icon_path'] : null;
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
