<?php

class API_Model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   /*    * getBisacGroupCodes
    * 
    * @param type $group
    * @return type
    */

   function getBisacGroupCodes($group) {
      $itemmaster = $this->load->database('itemmaster', TRUE);
      $bisacQuery = $itemmaster->query('exec BisacCode_Get @groupId=?', [$group]);

      if ($bisacQuery && $bisacQuery->num_rows() && $bisacResult = $bisacQuery->result_object()) {
         return ['message' => ['success' => ''], 'data' => $bisacResult];
      } else {
         return ['message' => ['error' => '']];
      }
   }

   function getAllBisacGroups() {
      $itemmaster = $this->load->database('itemmaster', TRUE);

      $bisacQuery = $itemmaster->query('exec BisacGroup_Get');
      if ($bisacQuery && $bisacQuery->num_rows() && $bisacResult = $bisacQuery->result_object()) {
         return ['message' => ['success' => ''], 'data' => $bisacResult];
      } else {
         return ['message' => ['error' => '']];
      }
   }

   function getAllIsoCodes($cache = '') {

      $itemmaster = $this->load->database('itemmaster', TRUE);
      $isoCodeQuery = $itemmaster->query('exec ISO3166Country_Get');

      if ($isoCodeQuery && $isoCodeQuery->num_rows() && $isoCodeResult = $isoCodeQuery->result_object()) {
         return ['message' => ['success' => ''], 'data' => ['codes' => $isoCodeResult]];
      } else {
         return ['message' => ['error' => '']];
      }
   }
}