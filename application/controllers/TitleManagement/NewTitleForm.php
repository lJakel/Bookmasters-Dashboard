<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class NewTitleForm extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'TitleManagement';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Submit() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
      $this->output->cache(10);
   }

   public function SubmitExcel() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function SubmitExcelUpload() {
      $this->output->set_header('Content-Type: application/json');
      $this->output->set_status_header('400');

      $output = [
          'post' => $_POST,
          'files' => $_FILES
      ];
      $this->load->model('ApplicationModels/TitleManagement_Model');
      $return = $this->TitleManagement_Model->process($output);
      $output1['message'] = ['error' => 'there was an error in yo stuff'];
      $output1['data']['success'] = [
          [
              'row' => 1,
              'title' => 'fgdkgdlkfgfd',
              'isbn' => '9780000000002',
          ],
      ];
      $output1['data']['error'] = [
          [
              'row' => 1,
              'title' => 'fgdkgdlkfgfd',
              'isbn' => '9780000000002',
              'errors' => [
                  [ 'field' => 'Title',
                      'message' => 'This field is required'
                  ],
                  [ 'field' => 'Subtitle',
                      'message' => 'This field is required'
                  ],
                  [ 'field' => 'ISBN',
                      'message' => 'Invalid ISBN'
                  ],
              ],
          ],
          [
              'row' => 1,
              'title' => 'fgdkgdlkfgfd',
              'isbn' => '9780000000002',
              'errors' => [
                  [
                      'field' => 'Title',
                      'message' => 'This field is required'
                  ],
                  [
                      'field' => 'Subtitle',
                      'message' => 'This field is required'
                  ],
                  [
                      'field' => 'ISBN',
                      'message' => 'Invalid ISBN'
                  ],
              ],
          ],
          [
              'row' => 1,
              'title' => 'fgdkgdlkfgfd',
              'isbn' => '9780000000002',
              'errors' => [
                  [ 'field' => 'Title',
                      'message' => 'This field is required'
                  ],
                  [ 'field' => 'Subtitle',
                      'message' => 'This field is required'
                  ],
                  [ 'field' => 'ISBN',
                      'message' => 'Invalid ISBN'
                  ],
              ],
          ],
      ];

      echo json_encode($output1);
   }

}
