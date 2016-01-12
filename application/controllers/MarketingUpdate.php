<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingUpdate extends Secure_Controller {

   var $app = [];
   var $folder = 'Apps/';

   function __construct() {
      parent::__construct();
      $this->load->model('ApplicationModels/MarketingUpdate_Model', 'mu_model');

      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
   }

   public function index() {
      $this->load->view($this->folder . get_class($this) . '/' . __FUNCTION__);
   }

   public function sidebar() {
      $this->load->view($this->folder . get_class($this) . '/' . __FUNCTION__, $this->app);
   }

   public function api() {

      echo json_encode($this->mu_model->viewAllEntries());
   }

}
