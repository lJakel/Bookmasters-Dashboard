<?php

class CatalogDescriptions_Model extends ESM {

   function __construct() {
      parent::__construct();
   }

   public function GetAll() {
      $cdDB = $this->load->database('JakeComputer', TRUE);
      $query = $cdDB->query('SELECT * FROM title WHERE Complete = 0');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         return $this->generateResponse($queryResult);
      }
      $this->newError("0000", "There was a problem with the username you supplied or your account has been disabled.", $this, __FUNCTION__, "danger", null, false);
      return $this->generateResponse();
   }

   public function Insert() {
      $cdDB = $this->load->database('JakeComputer', TRUE);

      $data = [
          'ID' => NULL,
          'Title' => $this->input->post('Title'),
          'SubTitle' => $this->input->post('SubTitle'),
          'ISBN' => $this->input->post('ISBN'),
          'Authors' => $this->input->post('Authors'),
          'MainDescription' => $this->input->post('MainDescription'),
          'AuthorBios' => $this->input->post('AuthorBios'),
          'Complete' => $this->input->post('Complete'),
          'Catalog' => $this->input->post('Catalog'),
          'Updated' => date("Y-m-d H:i:s"),
      ];


      $query = $cdDB->select('*')->from('title')->where('ISBN', $data['ISBN'])->get();

      if ($query && $query->num_rows()) {
         $this->newError("0000", "This record already exists in the table.", $this, __FUNCTION__, "danger", null, false);
      } else {
         $newQuery = $cdDB->insert('title', $data);
         if ($cdDB->affected_rows() <= 0) {
            $this->newError("0000", "A database error has occured.", $this, __FUNCTION__, "danger", null, false);
         }
      }
      return $this->generateResponse();
   }

   public function Update() {
      $cdDB = $this->load->database('JakeComputer', TRUE);
      $data = [
          'Title' => $this->input->post('Title'),
          'SubTitle' => $this->input->post('SubTitle'),
          'ISBN' => $this->input->post('ISBN'),
          'Authors' => $this->input->post('Authors'),
          'MainDescription' => $this->input->post('MainDescription'),
          'AuthorBios' => $this->input->post('AuthorBios'),
          'Complete' => $this->input->post('Complete'),
          'Catalog' => $this->input->post('Catalog'),
          'Updated' => date("Y-m-d H:i:s"),
      ];
      $cdDB->where('ID', $this->input->post('ID'));
      $cdDB->update('title', $data);

      if ($cdDB->affected_rows() <= 0) {
         $this->newError("0000", "A database error has occured.", $this, __FUNCTION__, "danger", null, false);
      }

      return $this->generateResponse();
   }

}
