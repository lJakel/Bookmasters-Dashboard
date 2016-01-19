<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TitleManagement extends Secure_Controller {

   function __construct() {
      parent::__construct();
   }

   public function index() {
      $this->load->view('Apps/NewTitle/index');
   }

   public function submit() {
      $this->load->view('Apps/NewTitle/submit');
   }

   public function submitexcel() {
      $this->load->view('Apps/NewTitle/submitexcel');
   }

   public function submitexcelupload() {
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
