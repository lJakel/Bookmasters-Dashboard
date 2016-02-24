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

   public function IngestData() {


      $this->load->library('excel');


      $objReader = PHPExcel_IOFactory::createReader('Excel2007');
      $objPHPExcel = $objReader->load('FINAL XCat16_for Jake.xlsx');

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      $rowData = '';
      for ($row = 1; $row <= $highestRow; $row++) {



         if (strlen(trim($sheet->getCellByColumnAndRow(10, $row)->getValue())) < 11) {
            continue;
         }


         if (trim($sheet->getCellByColumnAndRow(1, $row)->getValue()) == 'Bottom') {
            continue;
         }
         $rowData[] = $sheet->getCellByColumnAndRow(10, $row)->getValue();


         $data = ['ID' => null,
             'ID' => null,
             'Page' => $sheet->getCellByColumnAndRow(0, $row)->getValue(),
             'PageRank' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
             'Title' => $sheet->getCellByColumnAndRow(11, $row)->getValue(),
             'Subtitle' => $sheet->getCellByColumnAndRow(12, $row)->getValue(),
             'Publisher' => $sheet->getCellByColumnAndRow(13, $row)->getValue(),
             'Imprint' => $sheet->getCellByColumnAndRow(14, $row)->getValue(),
             'ISBN' => $sheet->getCellByColumnAndRow(10, $row)->getValue(),
             'Format' => $sheet->getCellByColumnAndRow(15, $row)->getValue(),
             'USPrice' => $sheet->getCellByColumnAndRow(32, $row)->getValue(),
             'CANPrice' => $sheet->getCellByColumnAndRow(34, $row)->getValue(),
             'TrimW' => $sheet->getCellByColumnAndRow(26, $row)->getValue(),
             'TrimH' => $sheet->getCellByColumnAndRow(27, $row)->getValue(),
             'Pages' => $sheet->getCellByColumnAndRow(36, $row)->getValue(),
             'BisacCode' => $sheet->getCellByColumnAndRow(28, $row)->getValue(),
             'BisacDesc' => $sheet->getCellByColumnAndRow(29, $row)->getValue(),
             'PublicationDate' => $sheet->getCellByColumnAndRow(16, $row)->getValue(),
             'IllustrationsCount' => null,
             'IllustrationsType' => null,
             'AgeFrom' => null,
             'AgeTo' => null,
             'Author1Name' => $sheet->getCellByColumnAndRow(17, $row)->getValue(),
             'Author1Bio' => $sheet->getCellByColumnAndRow(30, $row)->getValue(),
             'Author2Name' => $sheet->getCellByColumnAndRow(19, $row)->getValue(),
             'Author2Bio' => 'Blank',
             'Author3Name' => $sheet->getCellByColumnAndRow(21, $row)->getValue(),
             'Author3Bio' => 'Blank',
             'Author4Name' => $sheet->getCellByColumnAndRow(23, $row)->getValue(),
             'Author4Bio' => 'Blank',
             'Author5Name' => null,
             'Author5Bio' => null,
             'Catalog' => '16',
             'Updated' => date("Y-m-d H:i:s"),
         ];
         $newQuery = $this->jcDB->insert('titles', $data);
         if ($this->jcDB->affected_rows() <= 0) {
            $this->newError("0000", "Error, rip...", $this, __FUNCTION__, "danger", null, false);
         }
      }
      return $this->generateResponse($rowData);
   }

   public function ExportToCatalog() {

      require APPPATH . '/third_party/Note.php';
      require APPPATH . '/third_party/Note/HTMLToRTF.php';
      require APPPATH . '/third_party/Note/RTFToHTML.php';
      require APPPATH . '/third_party/Note/BraceLexer.php';
      require APPPATH . '/third_party/Note/SectionLexer.php';
      $Template = [
          'One' => [
              'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}{\f2\fnil\fcharset0 Calibri;}}' .
              '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red80\green80\blue80;}' .
              '\pard\pagebb\hyphpar0\sl480\slmult0\cf1\f0\fs48 [Title]\par' .
              '\pard\hyphpar0\sb90\sl320\slmult0\cf3\fs32 [Subtitle]\par' .
              '\pard\hyphpar0\sb180\sa180\sl288\slmult1\b\i\f1\fs24 [Author]\cf3\lang9\b0\i0\f2\fs22\par}',
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}
           {\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa270\sl320\slmult0\qj\cf1\f0\fs20 [MainDes]\par[AuthorDes]\par}',
              'Spec' => [
                  'main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'node' => '\pard\hyphpar0\sl340\slmult0\cf1\f0\fs24[SpecNode]\par}'
              ]
          ,
          ],
      ];
      $newQuery = $this->jcDB->get('titles');
      if ($newQuery && $newQuery->num_rows() && $newQuery_result = $newQuery->result_object()) {


         $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Root></Root>");

         foreach ($newQuery_result as $key => $value) {
            $isbn = trim($value->ISBN);



            $note = new JoshRibakoff_Note();
            $rtf = str_replace(['[Title]', '[Subtitle]', '[Author]'], [$value->Title, $value->Subtitle, trim("{$value->Author1Name}, {$value->Author2Name}, {$value->Author3Name}, {$value->Author4Name} ")], $Template['One']['Main']);
            $note->setRTF($rtf);

            copy("Storage/Catalogs/Christian/Data/Stock/stock.eps", "Storage/Catalogs/Christian/Data/Barcode/{$isbn}.eps");
            copy("Storage/Catalogs/Christian/Data/Stock/stock.jpg", "Storage/Catalogs/Christian/Data/Cover/{$isbn}.jpg");


            $Product = $xml->addChild("Product");
            $file = $note->formatRTF();
            if (!file_exists("Storage/Catalogs/Christian/Data/MainBody/{$isbn}.rtf")) {
               file_put_contents("Storage/Catalogs/Christian/Data/MainBody/{$isbn}.rtf", "{" . $file . "}");
               $Product->addChild("MainBody")->addAttribute('href', "file:///../Data/MainBody/{$isbn}.rtf");
            } else {
               file_put_contents("Storage/Catalogs/Christian/Data/MainBody/Dupe/{$isbn}.rtf", "{" . $file . "}");
               $Product->addChild("MainBody")->addAttribute('href', "file:///../Data/MainBody/Dupe/{$isbn}.rtf");
            }
            $Product->addChild("Descriptions")->addAttribute('href', "file:///../Data/Descriptions/{$isbn}.rtf");
            $Product->addChild("Cover")->addAttribute('href', "file:///../Data/Cover/{$isbn}.jpg");
            $Product->addChild("Specs")->addAttribute('href', "file:///../Data/Specs/{$isbn}.rtf");
            $Product->addChild("Barcode")->addAttribute('href', "file:///../Data/Barcode/{$isbn}.eps");
         }


         file_put_contents("Storage/Catalogs/Catalog.xml", $xml->asXML());
      }
   }

}
