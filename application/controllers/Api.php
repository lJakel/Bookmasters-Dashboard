<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

   function __construct() {
      parent::__construct();
      //$this->Auth_Model->authorizeApplication('Developer');
      $this->load->model('API/API_Model');
      $this->output->set_header('Content-Type: application/json');
   }

   public function index() {
      $this->load->view('DevApps/DevFeedback/index');
   }

   public function bisacs($method = '') {
      switch ($method) {

         case 'getGroupCodes':
            echo json_encode($this->API_Model->getBisacGroupCodes($this->input->post('groupId')));
            break;
         case 'getAllGroups':
            echo json_encode($this->API_Model->getAllBisacGroups());
            break;

         default:
            http_response_code(400);
            echo json_encode(['message' => ['error' => 'The supplied parameter was not found.']]);
            break;
      }
   }

   public function isoCodes($method) {
      switch ($method) {
         case 'getAllCodes':
            echo json_encode($this->API_Model->getAllIsoCodes($this->input->post('cache')));
            break;

         default:
            break;
      }
   }

   public function test() {

      echo json_encode($this->API_Model->getAllIsoCodes($this->input->post('cache')));

   }

}
