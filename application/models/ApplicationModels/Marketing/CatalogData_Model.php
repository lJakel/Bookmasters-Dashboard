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
      $newQuery = $this->jcDB->select('*')->where([
                  'Season' => $this->input->post('Season'),
                  'Year' => $this->input->post('Year'),
                  'Division' => $this->input->post('Division'),
              ])->get('catalog');

      //If catalog exists throw error to user
      if ($newQuery && $newQuery->num_rows()) {
         $this->newError("0000", "This catalog already exists.", $this, __FUNCTION__, "danger", null, false);
         return $this->GetAllCatalog();
      }
      //Insert if no error
      $newQuery = $this->jcDB->insert('catalog', $data);
      if ($this->jcDB->affected_rows() <= 0) {
         $this->newError("0000", "An error occured while creating the catalog.", $this, __FUNCTION__, "danger", null, false);
      }

      $CatalogBasePath = "Storage/Catalogs/{$this->input->post('Year')}/{$this->input->post('Season')}/{$this->input->post('Division')}/";
      $Paths = [
          'CatalogFolder' => "{$CatalogBasePath}/XML/",
          'CatalogFolder' => "{$CatalogBasePath}/Stock/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/Barcode/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/Cover/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/Descriptions/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/MainBody/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/Stock/",
          'CatalogFolder' => "{$CatalogBasePath}/Data/Specs/",
      ];
      foreach ($Paths as $value) {
         if (!file_exists($value)) {
            mkdir($value, 0777, true);
         }
      }

      return $this->GetAllCatalog();
   }

   public function GetAllCatalog() {
      $query = $this->jcDB->query('SELECT * FROM catalog');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         foreach ($queryResult as $value) {
            $CatalogTitleCountQuery = $this->jcDB->query('SELECT count(*) FROM titles WHERE Catalog = ?', [$value->id]);
            $CatalogTitleCountQueryResult = $CatalogTitleCountQuery->result_object();
            $value->Count = $CatalogTitleCountQueryResult;
         }
      } else {
         $this->newError("0000", "There was an error retrieving the catalogs, or there are no saved catalogs.", $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse(isset($queryResult) ? $queryResult : '');
   }

   public function GetAllCatalogWithTitles() {
      $query = $this->jcDB->select('Page PageRank PerPage ISBN Title Publisher')->where('Catalog', '16')->get('titles');
      if ($query && $query->num_rows() && $queryResult = $query->result_object()) {
         
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

   public function GetAllTitles() {


      $CatalogTitleCountQuery = $this->jcDB
              ->select('count(*) as CountTitle')
              ->from('titles')
              ->where('Catalog', $this->input->post('Catalog'))
              ->get();

      $CatalogTitleCountQueryResult = $CatalogTitleCountQuery->result_object();


      $TitleCount = $CatalogTitleCountQueryResult[0]->CountTitle;
      $Pages = ceil($TitleCount / $this->input->post('Limit'));
      $Limit = $this->input->post('Limit');
      $CurrentPage = $this->input->post('CurrentPage');
      $SqlPage = $this->input->post('Limit') * ($CurrentPage - 1);
      $Catalog = $this->input->post('Catalog');

      $Pagination = [
          'TitleCount' => $TitleCount,
          'CurrentPage' => $CurrentPage,
          'Limit' => $Limit,
          'PagesNum' => [],
          'Catalog' => $Catalog
      ];

      for ($index = 1; $index <= $Pages; $index++) {
         $Pagination['PagesNum'][] = $index;
      }

      $newQuery = $this->jcDB
              ->select('*')
              ->from('titles')
              ->where('Catalog', $Catalog)
              ->order_by('Page', 'ASC')
              ->order_by('PageRank', 'ASC')
              ->offset($SqlPage)
              ->limit($Limit)
              ->get();

      if ($newQuery && $newQuery->num_rows() && $newQuery_result = $newQuery->result_object()) {
         return $this->generateResponse(['Pagination' => $Pagination, 'Query' => $this->jcDB->last_query(), 'Result' => $newQuery_result]);
      }
   }

   public function UpdateTitle() {
      $id = $this->input->post('ID');

      $MainDesc = preg_replace("/<[\\/]{0,1}(span|SPAN)[^><]*>/", '', $this->input->post('MainDesc'));
      $MainDesc = preg_replace("/\\s+style=\"[a-zA-Z0-9:;\\.\\s\\(\\)\\-\\,]*\"/i", '', $this->input->post('MainDesc'));

      $Author1Bio = preg_replace("/<[\\/]{0,1}(span|SPAN)[^><]*>/", '', $this->input->post('Author1Bio'));
      $Author1Bio = preg_replace("/\\s+style=\"[a-zA-Z0-9:;\\.\\s\\(\\)\\-\\,]*\"/i", '', $this->input->post('Author1Bio'));

      $toReplace = [
          '‘',
          '’',
          '“',
          '”',
      ];
      $toReplaceWith = [
          "'",
          "'",
          '"',
          '"',
      ];
      $Author1Bio = str_replace($toReplace, $toReplaceWith, $Author1Bio);
      $MainDesc = str_replace($toReplace, $toReplaceWith, $MainDesc);


      $data = [
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
          'MainDesc' => $MainDesc,
          'Author1Name' => $this->input->post('Author1Name'),
          'Author1Bio' => $Author1Bio,
          'Author2Name' => $this->input->post('Author2Name'),
          'Author3Name' => $this->input->post('Author3Name'),
          'Author4Name' => $this->input->post('Author4Name'),
          'Discount' => $this->input->post('Discount'),
          'Updated' => $this->input->post('Updated'),
      ];

      $this->jcDB->set($data);
      $this->jcDB->where('ID', $id);
      $this->jcDB->update('titles');

//      $this->ExportTitle($id);

      $newQuery = $this->jcDB->where('ID', $id)->get('titles');
      if ($newQuery && $newQuery->num_rows() && $newQuery_result = $newQuery->result_object()) {
         return $this->generateResponse(['Result' => $newQuery_result]);
      }
   }

   public function ExportTitle($id) {



      $CatalogTemplateArr = [
          'One' => [
              'Main' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}}' .
                  '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red90\green90\blue90;}',
                  'Title' => '\viewkind4\uc1\pard\pagebb\hyphpar0\sl480\slmult0\cf1\f0\fs48 [Title]\par',
                  'Subtitle' => '\pard\hyphpar0\sb90\sl320\slmult0\cf3\fs32 [Subtitle]\par',
                  'Author' => '\pard\hyphpar0\sb90\sa180\sl288\slmult0\cf3\b\i\f1\fs24 [Author] \cf0\lang9\b0\i0\f2\fs22\par}'
              ],
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}' .
              '{\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa270\sl320\slmult0\qj\cf1\f0\fs20 [MainDes]\par
[AuthorDes]\par}',
              'Spec' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'Node' => '\viewkind4\uc1\pard\hyphpar0\sl340\slmult0\cf1\lang1033\f0\fs24 [SpecNode]\cf0\lang9\f1\fs22\par',
                  'End' => '}'
              ],
          ],
          'Two' => [
              'Main' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}}' .
                  '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red90\green90\blue90;}',
                  'Title' => '\viewkind4\uc1\pard\pagebb\hyphpar0\sl480\slmult0\cf1\f0\fs40 [Title]\par',
                  'Subtitle' => '\pard\hyphpar0\sb90\sl320\slmult0\cf3\fs28 [Subtitle]\par',
                  'Author' => '\pard\hyphpar0\sb90\sa180\sl260\slmult0\b\i\f1\cf3\fs22 [Author]\par}'
              ],
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}' .
              '{\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa180\sl280\slmult0\qj\cf1\f0\fs20 [MainDes]\par
[AuthorDes]\par}',
              'Spec' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'Node' => '\uc1\pard\hyphpar0\sl300\slmult0\cf1\lang1033\f0\fs20 [SpecNode]\cf0\lang9\f1\fs22\par',
                  'End' => '}'
              ],
          ],
          'Three' => [
              'Main' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}}' .
                  '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red90\green90\blue90;}',
                  'Title' => '\viewkind4\uc1\pard\pagebb\hyphpar0\sa30\sl288\slmult0\cf1\lang1033\f0\fs32 [Title]\par',
                  'Subtitle' => '\pard\hyphpar0\sb23\sl320\slmult0\cf3\fs28 [Subtitle]\par',
                  'Author' => '\pard\hyphpar0\sb90\sl280\slmult0\b\i\f1\cf3\fs22 [Author]\lang9\b0\i0\f0\par}',
              ],
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}' .
              '{\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa90\sl260\slmult0\qj\cf1\f0\fs20 [MainDes]\par
[AuthorDes]\par}',
              'Spec' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'Node' => '\pard\hyphpar0\sl280\slmult0\qr\cf1\f0\fs20 [SpecNode]\par',
                  'End' => '}'
              ],
          ],
          'Six' => [
              'Main' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}}' .
                  '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red90\green90\blue90;}',
                  'Title' => '\viewkind4\uc1\pard\pagebb\hyphpar0\sa90\sl320\slmult0\cf1\f0\fs32 [Title]\par',
                  'Subtitle' => '',
                  'Author' => '\pard\hyphpar0\sl240\slmult0\cf3\b\i\f1\fs22 [Author]\cf0\lang9\b0\i0\f2\par}'
              ],
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}' .
              '{\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa270\sl280\slmult0\qj\cf1\f0\fs20 [MainDes]\par
[AuthorDes]\par}',
              'Spec' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'Node' => '\pard\hyphpar0\sl240\slmult0\cf1\f0\fs18 [SpecNode]\par',
                  'End' => '}'
              ],
          ],
          'Ten' => [
              'Main' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 HelveticaNeueLT Std Med Cn;}{\f1\fnil\fcharset0 Minion Pro;}}' .
                  '{\colortbl ;\red38\green54\blue69;\red0\green0\blue0;\red90\green90\blue90;}',
                  'Title' => '\viewkind4\uc1\pard\pagebb\hyphpar0\sa43\sl240\slmult0\cf1\f0\fs24 [Title]\par',
                  'Subtitle' => '',
                  'Author' => '\pard\hyphpar0\sl240\slmult0\cf3\b\i\f1\fs20 [Author]\cf0\lang9\b0\i0\f2\par}'
              ],
              'Desc' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 Minion Pro;}} {\colortbl;\red0\green0\blue0;}' .
              '{\*\generator Msftedit 5.41.21.2510;}\viewkind4\uc1\pard\hyphpar0\sa270\sl280\slmult0\qj\cf1\f0\fs20 [MainDes]\par
[AuthorDes]\par}',
              'Spec' => [
                  'Main' => '{\rtf1\ansi\ansicpg1252\deff0\deflang1033 {\fonttbl {\f0\fnil\fcharset0 HelveticaNeueLT Std Cn;}} {\colortbl;\red0\green0\blue0;}',
                  'Node' => '\pard\hyphpar0\sl240\slmult0\cf1\f0\fs18 [SpecNode]\par',
                  'End' => '}'
              ],
          ],
      ];


      $this->load->library('FaleISBN');

      require_once APPPATH . '/third_party/Note.php';
      require_once APPPATH . '/third_party/Note/HTMLToRTF.php';
      require_once APPPATH . '/third_party/Note/RTFToHTML.php';
      require_once APPPATH . '/third_party/Note/BraceLexer.php';
      require_once APPPATH . '/third_party/Note/SectionLexer.php';
      require_once APPPATH . '/third_party/Catalog/CatalogTemplateArr.php';

      $newQuery = $this->jcDB->where('ID', $id)->get('titles');

      $CatalogQuery = '';

      if ($newQuery && $newQuery->num_rows() && $newQuery_result = $newQuery->result_object()) {

         $CatalogQuery = $this->jcDB->where('id', $newQuery_result[0]->Catalog)->get('catalog');
         $Catalog = $CatalogQuery->result_object()[0];

         $BasePath = "Storage/Catalogs/{$Catalog->Year}/{$Season}/{$Division}/";

         foreach ($newQuery_result as $value) {
            $PerPage = 'One';
            switch ($value->PerPage) {
               case 1:
                  $PerPage = 'One';
                  break;
               case 2:
                  $PerPage = 'Two';
                  break;
               case 3:
                  $PerPage = 'Three';
                  break;
               case 4:
                  $PerPage = 'Four';
                  break;
               case 6:
                  $PerPage = 'Six';
                  break;
               case 8:
                  $PerPage = 'Eight';
                  break;
               case 10:
                  $PerPage = 'Ten';
                  break;
               case 12:
                  $PerPage = 'Twelve';
                  break;

               default:
                  break;
            }
            $isbn = trim($value->ISBN);
            /////////////////////////////////////////////////////////
            ///////////////MAIN BODY RTF CONVERSION
            /////////////////////////////////////////////////////////
            $MainBody = new JoshRibakoff_Note();

            $RTFConverter = new JoshRibakoff_Note_HTMLToRTF();



            $MainBodyFileRTF = $CatalogTemplateArr[$PerPage]['Main']['Main'];


            if (isset($value->Title) && trim($value->Title) != '') {
               $value->Title = $RTFConverter->convert($value->Title);
               $MainBodyFileRTF .= str_replace('[Title]', $value->Title, $CatalogTemplateArr[$PerPage]['Main']['Title']);
            }
            if (isset($value->Subtitle) && trim($value->Subtitle) != '') {
               $value->Subtitle = $RTFConverter->convert($value->Subtitle);
               $MainBodyFileRTF .= str_replace('[Subtitle]', $value->Subtitle, $CatalogTemplateArr[$PerPage]['Main']['Subtitle']);
            }


            $Authors = '';
            if (isset($value->Author1Name) && trim($value->Author1Name) != '') {
               $Authors .= $value->Author1Name . ', ';
            }

            if (isset($value->Author2Name) && trim($value->Author2Name) != '') {
               $Authors .= $value->Author2Name . ', ';
            }

            if (isset($value->Author3Name) && trim($value->Author3Name) != '') {
               $Authors .= $value->Author3Name . ', ';
            }

            if (isset($value->Author4Name) && trim($value->Author4Name) != '') {
               $Authors .= $value->Author4Name . ', ';
            }
            $Authors = trim($Authors);
            $Authors = trim($Authors, ',');
            $Authors = trim($Authors);
            $Authors = trim($Authors, ',');
            $Authors = trim($Authors);


            $MainBodyFileRTF .= str_replace(['[Author]'], [ $Authors], $CatalogTemplateArr[$PerPage]['Main']['Author']);



            $MainBody->setRTF($MainBodyFileRTF);
            $MainBodyFile = $MainBody->formatRTF();

            $Module = 'MainBody';
            file_put_contents($BasePath . "Data/{$Module}/{$isbn}.rtf", "{" . $MainBodyFile . "}");
            /////////////////////////////////////////////////////////
            ///////////////DESCRIPTION RTF CONVERSION
            /////////////////////////////////////////////////////////
            $RTFConverter = new JoshRibakoff_Note_HTMLToRTF();
            $DescNote = new JoshRibakoff_Note();


            $MainDes = $RTFConverter->convert($value->MainDesc);
            $AuthorDes = $RTFConverter->convert($value->Author1Bio);

            $DescRTF = str_replace(['[MainDes]', '[AuthorDes]'], [$MainDes, $AuthorDes], $CatalogTemplateArr[$PerPage]['Desc']);
            $DescRTF = str_replace('  ', " ", $DescRTF);

            $DescNote->setRTF($DescRTF);
            $DescFile = $DescNote->formatRTF();

            $Module = 'Descriptions';
            file_put_contents($BasePath . "Data/{$Module}/{$isbn}.rtf", "{" . $DescFile . "}");
            /////////////////////////////////////////////////////////
            ///////////////COVER SETUP
            /////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////
            ///////////////SPEC RTF CONVERSION
            /////////////////////////////////////////////////////////
            $SpecNote = new JoshRibakoff_Note();

            $TrimW = trim($value->TrimW);
            $TrimH = trim($value->TrimH);



            $SpecRTF = $CatalogTemplateArr[$PerPage]['Spec']['Main'];
            $SpecRTF .= str_replace(['[SpecNode]'], [$value->Publisher], $CatalogTemplateArr[$PerPage]['Spec']['Node']);


            $isbnHyp = new FaleISBN;
            $isbn13 = $isbnHyp->hyphens->addHyphens($isbn);
            $SpecRTF .= str_replace(['[SpecNode]'], [$isbn13], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= str_replace(['[SpecNode]'], [$value->Format], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= str_replace(['[SpecNode]'], ["USD \${$value->USPrice} (CAN \${$value->CANPrice})"], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= str_replace(['[SpecNode]'], ["{$TrimW} x {$TrimH}, {$value->Pages} pages"], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= str_replace(['[SpecNode]'], [$value->BisacDesc], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= str_replace(['[SpecNode]'], [$value->PublicationDate], $CatalogTemplateArr[$PerPage]['Spec']['Node']);
            $SpecRTF .= $CatalogTemplateArr[$PerPage]['Spec']['End'];

            $SpecNote->setRTF($SpecRTF);
            $SpecFile = $SpecNote->formatRTF();

            $Module = 'Specs';
            file_put_contents($BasePath . "Data/{$Module}/{$isbn}.rtf", "{" . $SpecFile . "}");
            /////////////////////////////////////////////////////////
            /////////////////BARCODE SETUP
            /////////////////////////////////////////////////////////
         }
      }
      return;
   }

   public function IngestData() {

      $this->load->library('excel');

      $objReader = PHPExcel_IOFactory::createReader('Excel2007');
      $objPHPExcel = $objReader->load('Copy of Onix File Fall 2016 Catalog.xlsx');

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      $rowData = '';
      for ($row = 1; $row <= $highestRow; $row++) {



         if (strlen(trim($sheet->getCellByColumnAndRow(16, $row)->getValue())) < 11) {
            continue;
         }

         $rowData[] = $sheet->getCellByColumnAndRow(10, $row)->getValue();

         $IllustrationsCount = '';
         $IllustrationsType = '';


         if (trim($sheet->getCellByColumnAndRow(8, $row)->getValue()) != '') {

            $IllustrationsType = 'Color';
            $IllustrationsCount = trim($sheet->getCellByColumnAndRow(8, $row)->getValue());
         } else if (trim($sheet->getCellByColumnAndRow(7, $row)->getValue()) != '') {

            $IllustrationsType = 'Black and White';
            $IllustrationsCount = trim($sheet->getCellByColumnAndRow(7, $row)->getValue());
         } else {

            $IllustrationsCount = null;
            $IllustrationsType = null;
         }

         $data = [
             'ID' => null,
             'Page' => $sheet->getCellByColumnAndRow(2, $row)->getValue(),
             'PageRank' => $sheet->getCellByColumnAndRow(3, $row)->getValue(),
             'PerPage' => $sheet->getCellByColumnAndRow(1, $row)->getValue(),
             'Title' => $sheet->getCellByColumnAndRow(17, $row)->getValue(),
             'Subtitle' => $sheet->getCellByColumnAndRow(18, $row)->getValue(),
             'Publisher' => $sheet->getCellByColumnAndRow(19, $row)->getValue(),
             'Imprint' => $sheet->getCellByColumnAndRow(18, $row)->getValue(),
             'ISBN' => $sheet->getCellByColumnAndRow(16, $row)->getValue(),
             'Format' => $sheet->getCellByColumnAndRow(21, $row)->getValue(),
             'USPrice' => str_replace("\$", '', $sheet->getCellByColumnAndRow(34, $row)->getValue()),
             'CANPrice' => $sheet->getCellByColumnAndRow(36, $row)->getValue(),
             'TrimW' => trim($sheet->getCellByColumnAndRow(28, $row)->getValue()),
             'TrimH' => trim($sheet->getCellByColumnAndRow(29, $row)->getValue()),
             'Pages' => $sheet->getCellByColumnAndRow(38, $row)->getValue(),
             'BisacCode' => $sheet->getCellByColumnAndRow(30, $row)->getValue(),
             'BisacDesc' => $sheet->getCellByColumnAndRow(31, $row)->getValue(),
             'PublicationDate' => $sheet->getCellByColumnAndRow(22, $row)->getValue(),
             'IllustrationsCount' => $IllustrationsCount,
             'IllustrationsType' => $IllustrationsType,
             'AgeFrom' => $sheet->getCellByColumnAndRow(14, $row)->getValue(),
             'AgeTo' => $sheet->getCellByColumnAndRow(15, $row)->getValue(),
             'MainDesc' => $sheet->getCellByColumnAndRow(33, $row)->getValue(),
             'Author1Name' => $sheet->getCellByColumnAndRow(23, $row)->getValue(),
             'Author1Bio' => $sheet->getCellByColumnAndRow(32, $row)->getValue(),
             'Author2Name' => $sheet->getCellByColumnAndRow(24, $row)->getValue(),
             'Author2Bio' => 'Blank',
             'Author3Name' => $sheet->getCellByColumnAndRow(25, $row)->getValue(),
             'Author3Bio' => 'Blank',
             'Author4Name' => $sheet->getCellByColumnAndRow(26, $row)->getValue(),
             'Author4Bio' => 'Blank',
             'Author5Name' => null,
             'Author5Bio' => null,
             'Discount' => $sheet->getCellByColumnAndRow(39, $row)->getValue(),
             'Catalog' => '18',
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
      set_time_limit(60 * 20);
      $this->load->library('FaleISBN');
      $newQuery = $this->jcDB->where('Catalog', '18')->get('titles');
      if ($newQuery && $newQuery->num_rows() && $newQuery_result = $newQuery->result_object()) {

         $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\" ?><Root></Root>");

         foreach ($newQuery_result as $key => $value) {
            $isbn = trim($value->ISBN);
            $Product = $xml->addChild("Product");

            $Module = 'MainBody';
            $Product->addChild("{$Module}")->addAttribute('href', "file:///../Data/{$Module}/{$isbn}.rtf");
            /////////////////////////////////////////////////////////
            ///////////////DESCRIPTION RTF CONVERSION
            /////////////////////////////////////////////////////////
            $Module = 'Descriptions';
            $Product->addChild("{$Module}")->addAttribute('href', "file:///../Data/{$Module}/{$isbn}.rtf");
            /////////////////////////////////////////////////////////
            ///////////////COVER SETUP
            /////////////////////////////////////////////////////////
            $Product->addChild("Cover")->addAttribute('href', "file:///../Data/Cover/{$isbn}.jpg");
            /////////////////////////////////////////////////////////
            ///////////////SPEC RTF CONVERSION
            /////////////////////////////////////////////////////////
            $Module = 'Specs';
            $Product->addChild("{$Module}")->addAttribute('href', "file:///../Data/{$Module}/{$isbn}.rtf");
            /////////////////////////////////////////////////////////
            /////////////////BARCODE SETUP
            /////////////////////////////////////////////////////////
            $Product->addChild("Barcode")->addAttribute('href', "file:///../Data/Barcode/{$isbn}.eps");
         }
         file_put_contents("Storage/Catalogs/2016/Fall/AtlasBooks/XML/Catalog.xml", $xml->asXML());
      }
   }

   public function UpdateDescriptions() {
      set_time_limit(60 * 20);

      $this->JCCData = $this->load->database('JakeComputerCatalogData', TRUE);
      $this->JCCDesc = $this->load->database('JakeComputerCatalogDesc', TRUE);

      $GetDescQuery = $this->JCCDesc->get('title');

      if ($GetDescQuery && $GetDescQuery->num_rows() && $GetDescQueryResult = $GetDescQuery->result_object()) {
         foreach ($GetDescQueryResult as $value) {
            $this->JCCData->set([
                'MainDesc' => $value->MainDescription,
                'Author1Bio' => $value->AuthorBios,
            ]);
            $this->JCCData->where('ISBN', $value->ISBN);
            $this->JCCData->update('titles');
         }
      }



      $GetDescQuery = $this->JCCData->get('titles');
      if ($GetDescQuery && $GetDescQuery->num_rows() && $GetDescQueryResult = $GetDescQuery->result_object()) {
         foreach ($GetDescQueryResult as $value) {
            $this->ExportTitle($value->ID);
         }
         return true;
      }
   }

   public function ApplyTemplates() {
      set_time_limit(60 * 20);

      $this->JCCData = $this->load->database('JakeComputerCatalogData', TRUE);

//      $GetDescQuery = $this->JCCData->limit(40, 0)->get('titles');
      $GetDescQuery = $this->JCCData->get('titles');
      if ($GetDescQuery && $GetDescQuery->num_rows() && $GetDescQueryResult = $GetDescQuery->result_object()) {
         foreach ($GetDescQueryResult as $value) {
            $this->ExportTitle($value->ID);
         }
         return true;
      }
   }

   public function UploadCover() {

      $this->load->model('System/Storage_Model', "s_model");
      $this->s_model->StorageInit(get_class($this));
      $this->JCCData = $this->load->database('JakeComputerCatalogData', TRUE);
      $CatalogQuery = $this->JCCData->where('id', $this->input->post('catalog'))->get('catalog');

      if ($CatalogQuery && $CatalogQuery->num_rows() && $CatalogQueryResult = $CatalogQuery->result_object()) {
         $value = $CatalogQueryResult[0];
         $Path = "Storage/Catalogs/{$value->Year}/{$value->Season}/{$value->Division}/Data/Cover/";

         if (!file_exists($Path)) {
            mkdir($value, 0777, true);
         }

         $FileInfo = pathinfo($_FILES['file']['name']);
         $NewPath = "{$Path}{$this->input->post('isbn')}.{$FileInfo['extension']}";
         if (!move_uploaded_file($_FILES['file']['tmp_name'], $NewPath)) {
            $this->newError("00000", "There was an error uploading your file");
         }
         return $this->generateResponse($_FILES);
      } else {
         $this->newError("00000", "A database error has occured.");
      }

      return $this->generateResponse();
   }

}
