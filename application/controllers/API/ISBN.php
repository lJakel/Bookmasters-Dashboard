<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ISBN extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('UtilitiesModels/Utilities_Model', 'UM');
   }

   public function GetInfo() {
      header('Content-Type: application/json');
      echo json_encode($this->UM->ConvertIsbns());
   }

}
