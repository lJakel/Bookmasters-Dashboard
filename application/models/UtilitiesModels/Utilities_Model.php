<?php

require_once APPPATH . '/third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

class Utilities_Model extends ESM {

   var $UserId;

   function __construct() {
      parent::__construct();
      $this->load->model('System/Storage_Model');
   }

   public function uploadFraserReport() {
      $this->Storage_Model->StorageInit();
      $this->Storage_Model->UploadFile();
      $UploadedFiles = $this->Storage_Model->MoveFiles('Process');
      $this->Storage_Model->DeleteFiles();

      set_time_limit(60 * 5);

      try {
         $ReaderSrc = ReaderFactory::create(Type::XLSX);
//         $ReaderMatch = ReaderFactory::create(Type::XLSX);

         $ReaderSrc->open($UploadedFiles[0]['full_path']);
//         $ReaderMatch->open($UploadedFiles[1]['full_path']);
      } catch (Exception $exc) {
         echo $exc->getTraceAsString();
      }

      $File = [];
      foreach ($ReaderSrc->getSheetIterator() as $sheet) {
         foreach ($sheet->getRowIterator() as $row) {
            $File[$sheet->getName()][] = [$row];
         }
      }
      print_r($File);
   }

}
