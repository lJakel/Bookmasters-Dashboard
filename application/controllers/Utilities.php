<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilities extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
   }

   public function ISBNConversion() {
      $this->load->model('UtilitiesModels/Utilities_Model');
      if ($this->input->post('Report')) {
         print_r($this->Utilities_Model->uploadFraserReport());
      } else {
         $this->load->view('Apps/' . get_class($this) . '/' . __FUNCTION__);
      }
   }

   public function fraserReport() {
      $this->load->model('UtilitiesModels/Utilities_Model');
      if ($this->input->post('Report')) {
         print_r($this->Utilities_Model->uploadFraserReport());
      } else {
         $this->load->view('Apps/' . get_class($this) . '/' . __FUNCTION__);
      }
   }

}
