<?php

class AnonMailer_Modal extends ESM {

   function __construct() {
      parent::__construct();
      $this->di = $this->load->database('DataImports', TRUE);
   }

}
