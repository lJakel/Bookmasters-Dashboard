<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingUpdate extends Secure_Controller {

   function __construct() {
      parent::__construct();
      $this->load->model('MarketingUpdate_Model');
   }

   public function index() {
      $this->load->view('Apps/MarketingUpdate/index');
   }

   public function sidebar() {
      $this->load->view('Apps/MarketingUpdate/sidebar');
   }


}
