<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends Secure_Controller {

   var $app = [];
   var $folder = 'Apps/';

   function __construct() {
      parent::__construct();
      $this->load->model('SalesTools/SalesTools_Modal', 'st_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
   }

   public function index() {
      $this->load->view($this->folder . get_class($this) . '/' . __FUNCTION__);
   }
   public function top100() {
      
      $this->load->view($this->folder . get_class($this) . '/' . __FUNCTION__);
   }

   public function api() {
      $this->output->set_header('Content-Type: application/json');

      echo json_encode($this->st_model->submitFeedback());
   }

}
