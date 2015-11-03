<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends Secure_Controller {

   function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->view('Apps/Main/index');
   }

   public function APISubmit() {



      http_response_code(200);
      echo json_decode('OK');
   }

}
