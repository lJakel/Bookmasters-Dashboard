<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AccountSettings extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Account';
   }

   public function index() {
      $this->load->view('Apps/UserManagement/' . get_class($this) . '/' . __FUNCTION__);
   }


}
