<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Secure_Controller extends CI_Controller {

   function __construct() {
      parent::__construct();


      $this->load->model('System/Auth_Model');
      $this->load->library('session');


      if ($this->session->user) {
         
      } else {
         http_response_code(401);
         exit();
      }
   }

}
