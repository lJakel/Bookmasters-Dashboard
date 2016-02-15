<?php

class SellSheets_Model extends ESM {

   function __construct() {
      parent::__construct();
      $this->di = $this->load->database('DataImports', TRUE);
   }

}
