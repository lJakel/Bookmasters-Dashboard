<?php

class SalesTools_Modal extends ESM {

   function __construct() {
      parent::__construct();
      $this->di = $this->load->database('DataImports', TRUE);
   }

   function submitFeedback() {
//@count : number per page
//@page : 1-base page number
//@sortcol : name if not UnitsRank
//@sortdir : asc or desc
//      exec SalesReports

      if (isset($_POST['sortOrder']) && strtolower($_POST['sortOrder']) == 'dsc') {
         $_POST['sortOrder'] = 'desc';
      }

      $output = [
          'header' => [],
          'rows' => [],
          'pagination' => [],
          'sort' => [
              'sortBy' => $this->input->post('sortBy'),
              'sortOrder' => $this->input->post('sortOrder'),
          ],
      ];

      $queryResult = $this->di->count_all('dbo.SalesData');
      $output['pagination'] = [
          'count' => $this->input->post('count'),
          'page' => $this->input->post('page'),
          'pages' => ceil($queryResult / $this->input->post('count')),
          'size' => $queryResult,
      ];

      $queryResult = $this->di->query('exec SalesData_Query @count=?, @page=?, @sortcol=?, @sortdir=?', [
          $this->input->post('count'),
          $this->input->post('page'),
          $this->input->post('sortBy'),
          $this->input->post('sortOrder')
      ]);


      if ($queryResult && $queryResult->num_rows() && $data = $queryResult->result_object()) {
         $header = $queryResult->row_object();
         foreach ($header as $key => $value) {
            $output['header'][] = ['key' => $key, 'name' => $key];
         }
         $output['rows'] = $data;
         $queryResult->free_result();

         return ($this->generateResponse($output, ''));

      }
   }

}
