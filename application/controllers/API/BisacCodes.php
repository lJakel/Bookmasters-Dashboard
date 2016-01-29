<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BisacCodes extends CI_Controller {

   function __construct() {
      parent::__construct();
      //$this->Auth_Model->authorizeApplication('Developer');
      $this->load->model('API/API_Model');
      $this->output->set_header('Content-Type: application/json');
   }

   public function GetAllGroups() {
      echo json_encode($this->API_Model->getAllBisacGroups());
   }
   public function GetGroupCodes(){
      echo json_encode($this->API_Model->getBisacGroupCodes($this->input->post('groupId')));
   }

}
