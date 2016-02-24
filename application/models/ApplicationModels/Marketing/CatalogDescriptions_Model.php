<?php

class CatalogDescriptions_Model extends ESM {

   function __construct() {
      parent::__construct();
   }

   public function IngestData() {


      $this->load->library('excel');
//activate worksheet number 1
      $this->excel->setActiveSheetIndex(0);
//name the worksheet
      $this->excel->getActiveSheet()->setTitle('test worksheet');
//set cell A1 content with some text
      $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
//change the font size
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
//make the font become bold
      $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//merge cell A1 until D1
      $this->excel->getActiveSheet()->mergeCells('A1:D1');
//set aligment to center for that merged cell (A1 to D1)
      $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $filename = 'just_some_random_name.xls'; //save our workbook as this file name
      header('Content-Type: application/vnd.ms-excel'); //mime type
      header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
      header('Cache-Control: max-age=0'); //no cache
//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
//if you want to save it as .XLSX Excel 2007 format
      $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
//force user to download the Excel file without writing it to server's HD
      $objWriter->save('php://output');

      $data = ['ID' => $this->input->post('ID'),
          'Page' => $this->input->post('Page'),
          'PageRank' => $this->input->post('PageRank'),
          'Title' => $this->input->post('Title'),
          'Subtitle' => $this->input->post('Subtitle'),
          'Publisher' => $this->input->post('Publisher'),
          'Imprint' => $this->input->post('Imprint'),
          'ISBN' => $this->input->post('ISBN'),
          'Format' => $this->input->post('Format'),
          'USPrice' => $this->input->post('USPrice'),
          'CANPrice' => $this->input->post('CANPrice'),
          'TrimW' => $this->input->post('TrimW'),
          'TrimH' => $this->input->post('TrimH'),
          'Pages' => $this->input->post('Pages'),
          'BisacCode' => $this->input->post('BisacCode'),
          'BisacDesc' => $this->input->post('BisacDesc'),
          'PublicationDate' => $this->input->post('PublicationDate'),
          'IllustrationsCount' => $this->input->post('IllustrationsCount'),
          'IllustrationsType' => $this->input->post('IllustrationsType'),
          'AgeFrom' => $this->input->post('AgeFrom'),
          'AgeTo' => $this->input->post('AgeTo'),
          'Author1Name' => $this->input->post('Author1Name'),
          'Author1Bio' => $this->input->post('Author1Bio'),
          'Author2Name' => $this->input->post('Author2Name'),
          'Author2Bio' => $this->input->post('Author2Bio'),
          'Author3Name' => $this->input->post('Author3Name'),
          'Author3Bio' => $this->input->post('Author3Bio'),
          'Author4Name' => $this->input->post('Author4Name'),
          'Author4Bio' => $this->input->post('Author4Bio'),
          'Author5Name' => $this->input->post('Author5Name'),
          'Author5Bio' => $this->input->post('Author5Bio'),
          'Catalog' => $this->input->post('Catalog'),
      ];
   }

   public function GetAll() {
      $cdDB = $this->load->database('JakeComputer', TRUE);
      $query = $cdDB->query('SELECT * FROM title WHERE catalog = ? ORDER BY `Title` ASC', [$this->input->post('Set')]);
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         return $this->generateResponse($queryResult);
      }
      $this->newError("0000", "There are no titles in the database. Please create a title or import.", $this, __FUNCTION__, "danger", null, false);
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
          'Publisher' => $this->input->post('Publisher'),
          'MainDescription' => $this->input->post('MainDescription'),
          'AuthorBios' => $this->input->post('AuthorBios'),
          'Complete' => $this->input->post('Complete'),
          'Catalog' => $this->input->post('Catalog')['ID'],
          'Updated' => date("Y-m-d H:i:s"),
      ];


      $query = $cdDB->select('*')->from('title')->where('ISBN', $data['ISBN'])->get();

      if ($query && $query->num_rows()) {
         $this->newError("0000", "This title already exists.", $this, __FUNCTION__, "danger", null, false);
      } else {
         $newQuery = $cdDB->insert('title', $data);
         if ($cdDB->affected_rows() <= 0) {
            $this->newError("0000", "A database error has occured.", $this, __FUNCTION__, "danger", null, false);
         }
      }
   }

   public function Update() {
      $cdDB = $this->load->database('JakeComputer', TRUE);
      $data = [
          'Title' => $this->input->post('Title'),
          'SubTitle' => $this->input->post('SubTitle'),
          'ISBN' => $this->input->post('ISBN'),
          'Authors' => $this->input->post('Authors'),
          'Publisher' => $this->input->post('Publisher'),
          'MainDescription' => $this->input->post('MainDescription'),
          'AuthorBios' => $this->input->post('AuthorBios'),
          'Complete' => $this->input->post('Complete'),
          'Catalog' => $this->input->post('Catalog')['ID'],
          'Updated' => date("Y-m-d H:i:s"),
      ];
      $cdDB->where('ID', $this->input->post('ID'));
      $cdDB->update('title', $data);

      if ($cdDB->affected_rows() <= 0) {
         $this->newError("0000", "A database error has occured.", $this, __FUNCTION__, "danger", null, false);
      }
   }

   public function Delete() {
      $cdDB = $this->load->database('JakeComputer', TRUE);

      $cdDB->where('ID', $this->input->post('ID'));
      $cdDB->delete('title');

      if ($cdDB->affected_rows() <= 0) {
         $this->newError("0000", "A database error has occured.", $this, __FUNCTION__, "danger", null, false);
      }
   }

   public function GetAllSets() {
      $cdDB = $this->load->database('JakeComputer', TRUE);
      $query = $cdDB->query('SELECT * FROM catalog');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         return $this->generateResponse($queryResult);
      }
      $this->newError("0000", "There was an error retrieving Description Sets.", $this, __FUNCTION__, "danger", null, false);
      return $this->generateResponse();
   }

}
