<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('user_m');
   }

   function login() {

      $username = trim($this->input->post('username'));
      $password = trim($this->input->post('password'));

      $result = $this->user_m->login($username, $password);

      if (isset($result['message']['error'])) {
         http_response_code(400);
      }

      $this->output->set_header('Content-Type: application/json');
      echo json_encode($result);
   }

   function logout() {

      $result = $this->user_m->logout();
      $success = true;
      if ($success) {
         $this->output->set_header('Content-Type: application/json');
         http_response_code(200);
         echo json_encode(['success' => 'Logged out successfully.']);
      } else {
         $this->output->set_header('Content-Type: application/json');
         http_response_code(200);
         echo json_encode(['error' => 'Something went wrong with logging you out.']);
      }
   }

   function getuser() {

      $result = $this->user_m->getUser();
      if (isset($result['message']['error'])) {
         http_response_code(401);
      }
      $this->output->set_header('Content-Type: application/json');
      echo json_encode($result);
   }

   function register() {
      $result = $this->user_m->create_new_user($this->input->post('username'), $this->input->post('password'), $this->input->post('email'), $this->input->post('regkey'));

      if (isset($result['message']['error'])) {
         http_response_code(400);
      }

      $this->output->set_header('Content-Type: application/json');
      echo json_encode($result);
   }

}
