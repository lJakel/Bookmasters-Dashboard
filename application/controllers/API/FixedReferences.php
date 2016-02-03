<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FixedReferences extends CI_Controller {

   function __construct() {
      parent::__construct();
      //$this->Auth_Model->authorizeApplication('Developer');
      $this->load->model('API/API_Model');
   }

   public function GetAllReferences() {
      $this->output->set_content_type('application/json')
              ->set_output(json_encode($this->API_Model->getFixedReferences()));
   }

}
