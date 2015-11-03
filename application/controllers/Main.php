<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Secure_Controller {

  
   public function index() {
      $this->load->view('Apps/Main/index');
   }

   public function sidebar() {
      $this->load->view('Apps/Main/sidebar');
   }

}
