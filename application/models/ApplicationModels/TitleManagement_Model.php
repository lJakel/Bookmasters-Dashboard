<?php

class TitleManagement_Model extends CI_Model {

   function __construct() {
      parent::__construct();
      $this->load->library('session');
      //
   }

   public function process($input) {

      $this->load->library('excel');

      try {
         $objPHPExcel = PHPExcel_IOFactory::load($input['files']['file']['tmp_name']);
      } catch (Exception $e) {
         die('Error loading file "' . pathinfo($filename, PATHINFO_BASENAME) . '": ' . $e->getMessage());
      }

      $sheetSource = $objPHPExcel->getSheet(0);
      $highestRowSource = $sheetSource->getHighestRow();

      $randReturn = rand(7, $highestRowSource);
      $output = [];
      for ($rowSource = 7; $rowSource <= $randReturn; $rowSource++) {
         $output['failed'][] = [
             'title' => $sheetSource->getCellByColumnAndRow(4 - 1, $rowSource)->getValue(),
             'isbn' => $sheetSource->getCellByColumnAndRow(7 - 1, $rowSource)->getValue(),
         ];

//         $isbnSrc = trim(str_replace('-', '', $sheetSource->getCellByColumnAndRow(2 - 1, $rowSource)->getValue()));
//         if (isset($matchArray[$isbnSrc])) {
//            $sheetSource->setCellValueByColumnAndRow(10 - 1, $rowSource, $matchArray[$isbnSrc]['quantity']);
//         }
      }
      $output['errorCount'] = count($output['failed']);


//      $filenameOutput = 'fraser/Fraser_BO_' . date("Y-m-d H-i-s") . '.xlsx';
//      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//      $objWriter->save('output/' . $filenameOutput);

      return $output;
   }

}
