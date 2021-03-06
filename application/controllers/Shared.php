<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shared extends CI_Controller {

   /**
    * Index Page for this controller.
    *
    * Maps to the following URL
    * 		http://example.com/index.php/welcome
    * 	- or -
    * 		http://example.com/index.php/welcome/index
    * 	- or -
    * Since this controller is set as the default controller in
    * config/routes.php, it's displayed at http://example.com/
    *
    * So any other public methods not prefixed with an underscore will
    * map to /index.php/welcome/<method_name>
    * @see http://codeigniter.com/user_guide/general/urls.html
    */
   public function notFound() {
      $this->load->view('Shared/404');
   }

   public function appBootstrap() {
      $this->load->view('Shared/AppBootstrap');
   }

   public function error() {
      $this->load->view('Shared/Error');
   }

   public function appNavbar() {
      $this->load->view('Shared/AppNavbar');
   }

   public function Login() {
      $this->load->view('Authentication/login2');
   }

   public function Register() {
      $this->load->view('Authentication/register');
   }
   public function Forgot() {
      $this->load->view('Authentication/forgot');
   }

}
