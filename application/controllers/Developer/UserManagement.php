<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserManagement extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Developer';
      $this->app['folder'] = 'Utilities';
      $this->Auth_Model->authorizeApplication('Developer');
      $this->load->model('DevModels/DevUserManagement_Model');
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function ViewUsers() {
      $result = $this->DevUserManagement_Model->viewUsers();

      sleep(1);

      if ($result) {
         $this->output->set_status_header('200');
         $this->output->set_header('Content-Type: application/json');
         echo json_encode($result);
      } else {
         $this->output->set_status_header('400');
      }
   }

   public function View() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

}
