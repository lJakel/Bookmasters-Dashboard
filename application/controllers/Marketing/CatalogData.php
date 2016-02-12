<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CatalogData extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->load->model('ApplicationModels/Marketing/CatalogData_Model', 'cd_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Marketing';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }
}
