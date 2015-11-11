<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DevUserManagement extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('DevModels/DevUserManagement_Model');
   }

   public function index() {
      $this->load->view('DevApps/DevUserManagement/index');
   }

   public function sidebar() {
      $this->load->view('DevApps/DevUserManagement/sidebar');
   }

   public function viewusers() {
      $result = $this->DevUserManagement_Model->viewUsers();

      sleep(rand(0,3));
      
      if ($result) {
         $this->output->set_status_header('200');
         $this->output->set_header('Content-Type: application/json');
         echo json_encode($result);
      } else {
         $this->output->set_status_header('400');
      }
   }

}
