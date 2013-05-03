<?php

/**
 * Admin controller responsible for handling the creation / management of rules that determine whether a user
 * recieves a badge for a given checkout.
 * @author Alex W
 */
class ST_Badges_Manage_RulesController extends Mage_Adminhtml_Controller_Action {
    public function indexAction() {
        $this->loadLayout();
        $this->renderLayout();
    }
}
