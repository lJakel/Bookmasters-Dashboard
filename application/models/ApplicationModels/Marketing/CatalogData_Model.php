<?php

class CatalogData_Model extends ESM {

   function __construct() {
      parent::__construct();
      $this->load->model('System/Storage_Model', 's_model');
      $this->jcDB = $this->load->database('JakeComputerCatalogData', TRUE);
   }

   public function CreateCatalog() {
      $data = [
          'id' => NULL,
          'Season' => $this->input->post('Season'),
          'Year' => $this->input->post('Year'),
          'Division' => $this->input->post('Division'),
          'Updated' => date("Y-m-d H:i:s"),
      ];
      
      
      //Check for catalog first
      $newQuery = $this->jcDB->select('*')->where(
                      [
                          'Season' => $this->input->post('Season'),
                          'Year' => $this->input->post('Year'),
                          'Division' => $this->input->post('Division'),
                      ]
              )->get('catalog');
      //If catalog exists throw error to user
      if ($newQuery && $newQuery->num_rows()) {
         $this->newError("0000", "This catalog already exists.", $this, __FUNCTION__, "danger", null, false);
         return $this->GetAllCatalog();
      }
      
      //Insert if no error
      $newQuery = $this->jcDB->insert('catalog', $data);
      if ($this->jcDB->affected_rows() <= 0) {
         $this->newError("0000", "This catalog already exists or a database error has occured.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->GetAllCatalog();
   }

   public function GetAllCatalog() {
      $query = $this->jcDB->query('SELECT * FROM catalog');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         //success
      } else {
         $this->newError("0000", "There was an error retrieving the catalogs, or there are no saved catalogs.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse(isset($queryResult) ? $queryResult : '');
   }

   public function DeleteCatalog() {
      $this->jcDB->where('id', $this->input->post('id'));
      $this->jcDB->delete('catalog');
      if ($this->jcDB->affected_rows() <= 0) {
         $this->newError("0000", "This catalog does not exist, or was already deleted. Please refresh the catalog listing and try again.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->GetAllCatalog();
   }

}
