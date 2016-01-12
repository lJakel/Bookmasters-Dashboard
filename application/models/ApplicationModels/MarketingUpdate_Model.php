<?php

class MarketingUpdate_Model extends CI_Model {

   function __construct() {
      parent::__construct();

      $this->mu = $this->load->database('marketingUpdate', TRUE);
   }

   public function viewAllEntries() {
      $this->mu->query('SELECT * FROM  `entries` LIMIT 0 , 30');
      print_r($mu);
      die();
   }

}
