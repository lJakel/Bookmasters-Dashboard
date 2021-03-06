<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingUpdate extends Secure_Controller {

   var $app = [];
   

   function __construct() {
      parent::__construct();
      $this->load->model('ApplicationModels/MarketingUpdate_Model', 'mu_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Marketing';
   }

   public function index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function api() {
      $this->output->set_header('Content-Type: application/json');

      echo json_encode($this->mu_model->viewAllEntries());
   }

}
