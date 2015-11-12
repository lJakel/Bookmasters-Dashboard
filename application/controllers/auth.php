<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('System/Auth_Model');
   }

   function login() {

      $username = trim($this->input->post('username'));
      $password = trim($this->input->post('password'));

      $result = $this->Auth_Model->login($username, $password);

      if (isset($result['message']['error'])) {
         http_response_code(400);
      }

      $this->output->set_header('Content-Type: application/json');
      echo json_encode($result);
   }

   function logout() {

      $result = $this->Auth_Model->logout();
      $success = true;
      if ($success) {
         $this->output->set_header('Content-Type: application/json');
         $this->output->set_status_header('200');
         echo json_encode(['success' => 'Logged out successfully.']);
      } else {
         $this->output->set_header('Content-Type: application/json');
         $this->output->set_status_header('200');
         echo json_encode(['error' => 'Something went wrong with logging you out.']);
      }
   }

   function getuser() {

      $result = $this->Auth_Model->getUser();
      if (isset($result['message']['error'])) {
         $this->output->set_status_header('401');
      }
      $this->output->set_header('Content-Type: application/json');
      echo json_encode($result);
   }

   function register() {
      $this->output->set_header('Content-Type: application/json');

      $result = $this->Auth_Model->create_new_user($this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $this->input->post('regkey'));
      if (isset($result['message']['error'])) {
         $this->output->set_status_header('400');
      }
      echo json_encode($result);
   }

   function testPW() {


      $password = trim($this->input->post('password'));
      $salt = trim($this->input->post('salt'));


      $this->output->set_header('Content-Type: application/json');

      $result = $this->Auth_Model->create_password($password, $salt);
     
      echo json_encode($result);
   }

}
