<?php

class Feedback_Model extends CI_Model {

   var $UserId;

   function __construct() {
      parent::__construct();
      $this->load->library('session');
   }

}