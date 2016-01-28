<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubmitFeedback extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('DevFeedback_Model');
   }

   public function index() {
      $this->load->view('Apps/Main/index');
   }

   public function Submit() {

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
