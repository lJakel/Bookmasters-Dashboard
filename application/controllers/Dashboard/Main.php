<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Secure_Controller {

   var $app = [];

   public function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Dashboard';
      $this->app['folder'] = 'Dashboard';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

}
