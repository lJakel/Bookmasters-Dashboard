<?php

class SalesTools_Modal extends ESM {

   function __construct() {
      parent::__construct();
      $this->sr = $this->load->database('SalesReports', TRUE);
   }

   function submitFeedback() {
//@count : number per page
//@page : 1-base page number
//@sortcol : name if not UnitsRank
//@sortdir : asc or desc
//      exec SalesReports

      $this->generateResponse($data, $response);
   }

}
