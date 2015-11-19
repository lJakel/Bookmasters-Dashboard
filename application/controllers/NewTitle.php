<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NewTitle extends Secure_Controller {

   public function index() {
      $this->load->view('Apps/NewTitle/index');
   }

   public function sidebar() {
      $this->load->view('Apps/NewTitle/sidebar');
   }

   public function submit() {
      $this->load->view('Apps/NewTitle/submit');
   }

   public function submitexcel() {
      $this->load->view('Apps/NewTitle/submitexcel');
   }

   public function submitexcelupload() {
      $this->output->set_header('Content-Type: application/json');
      $this->output->set_status_header('400');

      $output = [
          'post' => $_POST,
          'files' => $_FILES
      ];
      $this->load->model('ApplicationModels/TitleManagement_Model');
      
     $return =  $this->TitleManagement_Model->process($output);
      echo json_encode($return);
   }

}
