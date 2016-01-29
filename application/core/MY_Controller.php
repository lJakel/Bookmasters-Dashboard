<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Secure_Controller extends CI_Controller {

   function __construct() {
      parent::__construct();

      $this->load->model('System/Auth_Model');
      $this->load->library('session');

      if ($this->session->user) {
         
      } else {
         http_response_code(401);
         exit;
      }
   }

   public function ClassInit() {
      foreach (get_class_methods($this) as $value) {
         if ($value == 'get_instance' || $value == '__construct' || $value == 'ClassInit') {
            
         } else {
      
            $AssetFolder = "assets/js/views/{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}";
            if (!is_dir($AssetFolder)) {
               mkdir($AssetFolder, 0777, TRUE);
            }
            
            $ViewFolder = "application/views/{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}";
            if (!is_dir($ViewFolder)) {
               mkdir($ViewFolder, 0777, TRUE);
            }
            if (!file_exists($ViewFolder . "/{$value}.php")) {
               file_put_contents($ViewFolder . "/{$value}.php", '');
            }
         }
      }
   }

}
