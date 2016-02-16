<?php

class SellSheets_Model extends ESM {

   function __construct() {
      parent::__construct();
      $this->load->model('System/Storage_Model', 'Storage_Model');
   }

   public function Upload($poop = '') {
      //Init the Application Storage
      $this->Storage_Model->StorageInit(get_class($this));

      //Upload the files and get the file return or error out
      $UploadFileResult = $this->Storage_Model->UploadFile('*');
      if (!$UploadFileResult) {
         $this->newError("0000", "There was an error in your file upload.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }
      //If no error move them to this folder and delete from the uploads folder
      $UploadedFiles = $this->Storage_Model->MoveFiles('SellSheets');
      if ($this->Storage_Model->DeleteFiles()) {
          $this->newError("0000", "An IO error occured.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      return $this->generateResponse($UploadedFiles);
   }

}
