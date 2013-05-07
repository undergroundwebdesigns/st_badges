<?php

/**
 * Admin controller responsible for handling the creation of new Badges that users can earn by meeting checkout criteria.
 * @author Alex W
 */
class ST_Badges_Manage_BadgesController extends Mage_Adminhtml_Controller_Action {

    protected $_base_icon_path = '/stbadges/badges/';

    public function indexAction() 
    {
        $this->_title($this->__("Loyalty Badges"));
        $this->loadLayout();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__("Loyalty Badges"));

        $id = $this->getRequest()->getParam('badge_id');
        $model = Mage::getModel('stbadges/badge');

        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This badge no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title( $model->getId() ? $model->getTitle() : $this->__('New Badge'));

        // Restore data saved in session, in case of errors while completing the form.
        $data = Mage::getSingleton('adminhtml/session')->getUserData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        Mage::register('badge', $model);

        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        return $this->editAction();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost())
        {
            $id = $this->getRequest()->getParam('badge_id');
            $model = Mage::getModel('stbadges/badge')->load($id);
            if (!$model->getId() && $id) {
               Mage::getSingleton('adminhtml/session')->addError($this->__('This badge no longer exists.'));
               $this->redirect('*/*/');
               return;
            }

            try {
                if(isset($_FILES['icon_path']['name']) AND (file_exists($_FILES['icon_path']['tmp_name'])))
                {
                    $uploader = new Varien_File_Uploader('icon_path');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));

                    $uploader->setAllowRenameFiles(false);

                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . $this->_base_icon_path;

                    $uploader->save($path, $_FILES['icon_path']['name']);

                    $data['icon_path'] = $this->_base_icon_path.$_FILES['icon_path']['name'];
                } else {
                    unset($data['icon_path']); // If no file uploaded leave image as-is.
                }
            } catch(Exception $e) {
                Mage::getSingleton('adminhtml/sessio')->addError($this->__('Error uploading badge icon.'));
                Mage::getSingleton('adminhtml/sesion')->setSTBadgeData($data);
                $this->_redirect('*/*/edit', array('badge_id' => $model->getBadgeId()));
                return;
            }

            $model->addData($data);

            $result = $model->validate();
            if (is_array($result)) {
                Mage::getSingleton('adminhtml/session')->setSTBadgeData($data);
                foreach($result as $message) {
                    Mage::getSingleton('adminhtml/session')->addError($message);
                }
                $this->redirect('*/*/edit', array('_current' => true));
                return $this;
            }
            try { 
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Badge Saved'));
                Mage::getSingleton('adminhtml/session')->setSTBadgeData(false);
                $this->_redirect('*/*/');
                return;
            } catch(Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('Error saving badge.')); 
                Mage::getSingleton('adminhtml/session')->setSTBadgeData($data);
                $this->_redirect('*/*/edit', array('badge_id' => $model->getBadgeId()));
                return;
            }
        }
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('badge_id')) {
            try {
                $model = Mage::getModel('stbadges/badge');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Badge deleted.'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('badge_id' => $id));
                return;
            }
        }
    }
}
