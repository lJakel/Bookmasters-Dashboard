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

}
