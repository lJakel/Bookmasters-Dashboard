<?php

class ErrorSuccess_Model extends CI_Model {

   function __construct() {
      parent::__construct();
   }

   /**
    * Outputs an error
    * @param int $code
    * @param string $message
    * @param boolean $exit
    */
   static public function error($code, $message = null, $exit = false) {
      $output = '';

      $this->output->set_status_header($code);

      if ($message != null) {
         $this->output->set_header('Content-Type: application/json');

         $output['message'] = ['Error' => $message];
         return json_encode($output);
      } else {
         exit;
      }
      if ($exit) {
         
      }
   }

   /**
    * Output a success
    * @param int $code
    * @param string $message
    * @param data $data
    * @param boolean $exit
    */
   static public function success($code = 200, $message = null, $data = null) {
      $output = '';

      $this->output->set_status_header($code);

      if ($message != null) {
         $this->output->set_header('Content-Type: application/json');
         $output['message'] = ['success' => $message];
      }
      if ($data != null) {
         $output['data'] = json_encode($data);
      }

      if ($data || $message) {
         echo json_encode($output);
      }

      return $output;
   }

}
