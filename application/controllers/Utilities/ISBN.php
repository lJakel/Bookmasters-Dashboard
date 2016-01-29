<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ISBN extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Utilities';
      //$this->load->model("{$this->app['folder']}/{$this->app['appName']}_Model", "{$this->app['appName']}_Model");
   }

   public function Convert() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Information() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

}
