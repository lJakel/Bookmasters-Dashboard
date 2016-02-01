<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CatalogDescriptions extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->load->model('ApplicationModels/Marketing/CatalogDescriptions_Model', 'cd_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Marketing';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Export() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function GetAll() {
      echo json_encode($this->cd_model->GetAll());
   }
   public function Create() {
      $this->output->set_content_type('application/json');
      echo json_encode($this->cd_model->Insert());
   }
   public function Update() {
      $this->output->set_content_type('application/json');
      echo json_encode($this->cd_model->Update());
   }

}
