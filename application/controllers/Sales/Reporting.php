<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reporting extends Secure_Controller {

   var $app = [];
   var $folder = 'Apps/';

   function __construct() {
      parent::__construct();
      $this->load->model('SalesTools/SalesTools_Modal', 'st_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Sales';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Top100() {

      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function api() {
      $this->output->set_header('Content-Type: application/json');

      echo json_encode($this->st_model->submitFeedback());
   }

}
