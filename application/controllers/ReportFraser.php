<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportFraser extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('ReportModels/Fraser_Model');
   }

   public function upload() {

      $UploadedFiles = $this->Fraser_Model->o();
      print_r($UploadedFiles);
   }

}
