<?php

class MarketingUpdate_Model extends ESM {

   function __construct() {
      parent::__construct();

      $this->mu = $this->load->database('marketingUpdate', TRUE);
   }

   public function viewAllEntries() {

      $output = [
          [
              "distributor" => "Bookmasters",
              "years" => [],
          ],
      ];
      $AtlasBooksResult = $this->mu->query("SELECT submission_date, id FROM entries WHERE distributor = ? ORDER BY submission_date DESC", [1]);
      $BookmastersResult = $this->mu->query("SELECT submission_date, id FROM entries WHERE distributor = ? ORDER BY submission_date DESC", [2]);

      if ($AtlasBooksResult && $AtlasBooksResult->num_rows() && $entries = $AtlasBooksResult->result_array()) {
         $AtlasBooksResult->free_result();

         $links = [];

         foreach ($entries as $key => $value) {
            foreach ($value as $keyNew => $valueNew) {



               $date = new DateTime($value['submission_date']);
               $date = $date->format('n');

               $year = new DateTime($value['submission_date']);
               $year = $year->format('Y');


               $yeararr = [
                   "year" => $year,
                   "months" => []
               ];
               $month = [
                   "month" => $date,
                   "name" => DateTime::createFromFormat('!m', $date)->format('F')
               ];

               if (!in_array($yeararr, $links, TRUE)) {
                  $links[] = $yeararr;
               }
               if (in_array($month, $links[$yeararr], TRUE)) {
                  
               } else {
                  $links[$yeararr] = $month;
               }
            }
         }


         $output = [
             [
                 "distributor" => "Bookmasters",
                 "years" => $links,
             ],
         ];



         return $this->generateResponse($output);
      } else {

         $this->newError("0000", 'There was an error in retrieving entries.', $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }
   }

}
