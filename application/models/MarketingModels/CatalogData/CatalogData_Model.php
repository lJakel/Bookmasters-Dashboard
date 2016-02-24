<?php

class CatalogData_Modal extends ESM {

   function __construct() {
      parent::__construct();
      $DB = $this->load->database('JakeComputer', TRUE);
   }

   public function CreateCatalog() {
      $sql = "INSERT INTO `catalog` (`id`, `Season`, `Year`, `Division`) VALUES (NULL, 'Summer', '2016', 'Christian');";
      $data = [
          'id' => NULL,
          'Season' => $this->input->post('Season'),
          'Year' => $this->input->post('Year'),
          'Division' => $this->input->post('Division'),
          'Updated' => date("Y-m-d H:i:s"),
      ];

      $newQuery = $DB->insert('catalog', $data);
      if ($DB->affected_rows() <= 0) {
         $this->newError("0000", "This catalog already exists.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse();
   }

   public function GetAllCatalog() {
      $query = $DB->query('SELECT * FROM catalog');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         return $this->generateResponse($queryResult);
      } else {
         $this->newError("0000", "There was an error retrieving Description Sets.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }
   }

   public function DeleteCatalog() {

      $DB->where('id', $this->input->post('id'));
      $DB->delete('catalog');
      if ($DB->affected_rows() <= 0) {
         $this->newError("0000", "This catalog does not exist, or was already deleted. Please refresh the catalog listing and try again.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse();
   }

}
