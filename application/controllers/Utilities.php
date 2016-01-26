<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->load->model('UtilitiesModels/Utilities_Model', 'UM');
   }

   public function ISBNConversion() {
      $this->load->view('Apps/' . get_class($this) . '/' . __FUNCTION__);
   }

   public function ISBNConversionAPI() {
      header('Content-Type: application/json');
      echo json_encode($this->UM->ConvertIsbns());
   }

   public function fraserReport() {

      if ($this->input->post('Report')) {
         print_r($this->UM->uploadFraserReport());
      } else {
         $this->load->view('Apps/' . get_class($this) . '/' . __FUNCTION__);
      }
   }

}
