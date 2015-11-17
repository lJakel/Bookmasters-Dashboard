<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DevFeedback extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->Auth_Model->authorizeApplication('Developer');

      $this->load->model('DevModels/DevFeedback_Model');
   }

   public function index() {
      $this->load->view('DevApps/DevFeedback/index');
   }

   public function sidebar() {
      $this->load->view('DevApps/DevFeedback/sidebar');
   }

   public function APIView() {

      $result = $this->DevFeedback_Model->viewFeedback();

      if ($result) {
         $this->output->set_status_header('200');
         $this->output->set_header('Content-Type: application/json');
         echo json_encode($result);
      } else {
         $this->output->set_status_header('400');
      }
   }

   public function APISubmit() {

      $result = $this->DevFeedback_Model->submitFeedback(
              $this->input->post('username'), $this->input->post('url'), $this->input->post('useragent'), $this->input->post('message'), $this->input->post('contact')
      );
      if ($result) {
         $this->output->set_status_header('200');
      } else {
         $this->output->set_status_header('400');
      }
   }

}
