<?php

class MY_Model extends CI_Model {

   function __construct() {
      $_POST = json_decode(file_get_contents('php://input'), true);
   }

}

class ESM extends MY_Model {

   public $errors = [];
   var $errorDoc = "http://dashboard.bookmsaters.com/errors/";
   var $errorModel = [
       "message" => "",
       "method" => "",
       "type" => "",
       "timestamp" => "",
       "code" => "",
       "moreinfo" => "",
       "severity" => "",
   ];
   var $errorSuccessModel = [
       "data" => "",
       "errors" => [],
       "success" => true,
       "response" => ""
   ];

   function __construct() {
      parent::__construct();
   }

   /**
    * Adds an error to the error handler
    * @param message $message
    * @param method $method
    * @param type $type
    * @param timestamp $timestamp
    * @param code $code
    * @param moreinfo $moreinfo
    */
   public function newError($code = 00000, $message = null, $class = null, $function = null, $severity = null, $type = null, $moreinfo = false) {
      $newError = $this->errorModel;
      $newError['code'] = $code;
      $newError['message'] = $message;
      $newError['method'] = get_class($class) . ":" . $function;
      $newError['type'] = $type;
      $newError['timestamp'] = date("Y-m-d H:i:s");
      $newError['moreinfo'] = $moreinfo;
      $newError['severity'] = $severity;

      if ($moreinfo) {
         $newError['moreinfo'] = $this->errorDoc . $code;
      }
      $this->errors[] = $newError;
   }

   /**
    * Adds an error to the error handler
    * @param int $code
    * @param string $message
    * @param data $data
    * @param boolean $exit
    */
   public function generateResponse($data = null, $response = null, $httpcode = '400') {
      $output['errors'] = $this->errors;
      $output['data'] = $data;
      $output['response'] = $response;

      if (empty($this->errors)) {
         $output['status'] = 200;
         $this->output->set_status_header(200);
      } else {
         $output['status'] = $httpcode;
         $this->output->set_status_header($httpcode);
      }

      return $output;
   }

}
