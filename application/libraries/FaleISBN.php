<?php

if (!defined('BASEPATH'))
   exit('No direct script access allowed');

require_once APPPATH . '/third_party/FaleISBN/Check.php';
require_once APPPATH . '/third_party/FaleISBN/Hyphens.php';
require_once APPPATH . '/third_party/FaleISBN/CheckDigit.php';
require_once APPPATH . '/third_party/FaleISBN/Translate.php';
require_once APPPATH . '/third_party/FaleISBN/Isbn.php';
require_once APPPATH . '/third_party/FaleISBN/Validation.php';

class FaleISBN extends Isbn\Isbn {

   public function __construct() {
      parent::__construct();
   }

}
