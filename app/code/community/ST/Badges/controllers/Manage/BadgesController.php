<?php

/**
 * Admin controller responsible for handling the creation of new Badges that users can earn by meeting checkout criteria.
 * @author Alex W
 */
class ST_Badges_Manage_BadgesController extends Mage_Adminhtml_Controller_Action {

    protected $_base_icon_path = '/stbadges/badges/';

    public function indexAction() 
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('stbadges/manage_form_edit'))->_addLeft($this->getLayout()->createBlock('stbadges/manage_form_edit_tabs'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('stbadges/manage_form_edit'))->_addLeft($this->getLayout()->createBlock('stbadges/manage_form_edit_tabs'));
        $this->renderLayout();
        #$this->_forward('edit'); In theory should be able to use this to keep things DRY, but it's 404ing on me.
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost())
        {
            try 
            {
                if(isset($_FILES['icon_path']['name']) AND (file_exists($_FILES['icon_path']['tmp_name'])))
                {
                    $uploader = new Varien_File_Uploader('icon_path');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));

                    $uploader->setAllowRenameFiles(false);

                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . $this->_base_icon_path;

                    $uploader->save($path, $_FILES['icon_path']['name']);

                    $data['icon_path'] = $_FILES['icon_path']['name'];
                }
                else
                {
                    if (isset($data['icon_path']['delete']) && $data['icon_path']['delete'] == 1)
                    {
                        $data['icon_path'] = '';
                    }
                    else
                    {
                        unset($data['icon_path']);
                    }
                }
                
                $badge = Mage::getModel('stbadges/badge')->load($this->getRequest()->getParam('badge_id'));
                $badge->setTitle($data['title']);
                $badge->setDescription($data['description']);
                $badge->setTriggerPurchaseAmount($data['trigger_purchase_amount']);
                if (isset($data['icon_path']))
                {
                    $badge->setIconPath($this->_base_icon_path.$data['icon_path']);
                }
                $badge->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Badge Saved'));
            }
            catch(Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($this->__('Error saving badge.')); 
                Mage::logException($e); 
            }
            $this->_redirect('*/*/');
        }
    }
}
