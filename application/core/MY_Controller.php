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

            $ModelFolder = "application/models/{$this->app['folder']}Models/{$this->app['appName']}";
            if (!is_dir($ModelFolder)) {
               mkdir($ModelFolder, 0777, TRUE);
            }
            if (!file_exists($ModelFolder . "/{$this->app['appName']}_Model.php")) {
               file_put_contents($ModelFolder . "/{$this->app['appName']}_Model.php", '<?php class '.$this->app['appName'].'_Modal extends ESM {function __construct() {parent::__construct();$this->di = $this->load->database(\'DataImports\', TRUE);}}');
            }

            $AssetFolder = "assets/js/views/{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}";
            if (!is_dir($AssetFolder)) {
               mkdir($AssetFolder, 0777, TRUE);
            }

            $jsTemplate = "BMApp.register.controller('GeneratedController', [function () {\nvar vm = this;\nvm.data = 'Hello!';\n}]);";
            if (!file_exists($AssetFolder . "/{$this->app['appName']}.js")) {
               file_put_contents($AssetFolder . "/{$this->app['appName']}.js", $jsTemplate);
            }

            $ViewFolder = "application/views/{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}";
            if (!is_dir($ViewFolder)) {
               mkdir($ViewFolder, 0777, TRUE);
            }
            if (!file_exists($ViewFolder . "/{$value}.php")) {
               file_put_contents($ViewFolder . "/{$value}.php", "<div class=\"row\" ng-controller=\"GeneratedController as gc\">\n   <div class=\"col-md-12\">\n      <div class=\"panel panel-default\">\n         <div class=\"panel-body\">\n         <h1>{{gc.data}}</h1>\n         </div>\n      </div>\n   </div>\n</div>\n<script type=\"text/javascript-lazy\" data-append=\"partial\" data-src=\"assets/js/views/{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/{$value}.js?cache=<?php echo rand(1000, 9000); ?>\"></script>");
            }
         }
      }
   }

}
