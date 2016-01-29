<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Developer';
      $this->app['folder'] = 'Utilities';
      $this->Auth_Model->authorizeApplication('Developer');

//      $this->load->model('DevModels/DevFeedback_Model');
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

}
