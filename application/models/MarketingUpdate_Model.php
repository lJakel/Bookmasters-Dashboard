<?php

class MarketingUpdate_Model extends CI_Model {

   var $UserId;

   function __construct() {
      parent::__construct();
      $this->load->library('session');
      $this->Feedbackdb = $this->db;
   }

   function submitFeedback($username, $url, $useragent, $message, $maycallyou) {

      $feedbackquery = $this->Feedbackdb->query('exec SendSiteFeedback ?, ?, ?, ?, ?', [$username, $url, $useragent, $message, $maycallyou]);

      if ($feedbackquery && $feedbackquery->num_rows() && $feedbackresult = $feedbackquery->row_object()) {
         return true;
      } else {
         return false;
      }
   }

   function viewFeedback() {



      $feedbackquery = $this->Feedbackdb->get('dbo.SiteFeedback'); //,10, 0);

      if ($feedbackquery && $feedbackquery->num_rows() && $feedbackresult = $feedbackquery->result()) {
         return $feedbackresult;
      } else {
         return false;
      }
   }

}
