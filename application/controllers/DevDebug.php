<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DevDebug extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->Auth_Model->authorizeApplication('Developer');

//      $this->load->model('DevModels/DevFeedback_Model');
   }

   public function index() {
      $this->load->view('DevApps/' . get_class($this) . '/' . __FUNCTION__);
   }

   public function sidebar() {
      $this->load->view('DevApps/' . get_class($this) . '/' . __FUNCTION__);
   }

}
