<?php

/**
 * Admin controller responsible for handling the creation of new Badges that users can earn by meeting checkout criteria.
 * @author Alex W
 */
class ST_Badges_Manage_BadgesController extends Mage_Adminhtml_Controller_Action {
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
}
