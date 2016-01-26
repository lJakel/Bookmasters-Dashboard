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

   public function ConvertIsbns() {

      $this->load->library('FaleISBN');

      $inputPattern = "/[^0-9\\n\\r]/";
      $result = preg_replace($inputPattern, "", $this->input->post('input'));
      $isbnsList = explode("\n", $result);

      $pattern = "/(978\\d{10}|979\\d{10})/";

      foreach ($isbnsList as $value) {

         if (trim($value) == "") {
            $output[] = [];
         } else {
            $value = str_replace("-", "", $value);
            preg_match($pattern, $value, $match);

            $isbn = new FaleISBN;

            $isbn10 = '';
            $isbn13 = '';
            $fail = false;

            if (isset($match[0]) && $isbn->check->identify($match[0]) == '10' && $isbn->check->is10($match[0])) {
               $isbn10 = $match[0];
               $isbn13 = $isbn->translate->to13($isbn10);
            } elseif (isset($match[0]) && $isbn->check->identify($match[0]) == '13' && $isbn->check->is13($match[0])) {
               $isbn13 = $match[0];
            } else {
               $fail = true;
            }

            $isbn13 = $isbn->hyphens->addHyphens($isbn13);
            $exploded = explode('-', $isbn13);

            if ($fail) {
               $output[] = [];
            } else {
               $output[] = [
                   'original' => $match[0],
                   'isbn13' => $isbn13,
                   'isbn10' => $isbn->translate->to10($isbn13),
                   'ean' => $match[0],
                   'checkSum' => $exploded[4],
                   'country' => $exploded[1],
                   'product' => $exploded[0],
                   'publication' => $exploded[3],
                   'publisher' => $exploded[2],
                   'fail' => !$isbn->validation->isbn($match[0]),
               ];
            }
         }
      }
      return $this->generateResponse($output, '');
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
