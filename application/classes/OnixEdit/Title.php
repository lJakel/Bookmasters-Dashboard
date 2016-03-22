<?php

class Title {

   var $ONIX_NOSEQ;
   var $recordReference;
   var $title;
   var $isbn10;
   var $isbn13;
   var $ean;
   var $productForm;
   var $author;
   var $subject;
   var $saleDate;
   var $availability;
   var $productXml;
   var $extraFields;
   var $customFields;
   var $onixVersion;

   function __construct() {
      $this->ONIX_NOSEQ = $this->GUID();
   }

   function GUID() {
      if (function_exists('com_create_guid') === true) {
         return trim(com_create_guid(), '{}');
      }

      $data = openssl_random_pseudo_bytes(16);
      $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
      $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
      return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
   }

}

class ExtraField {
   
}

class CustomField {
   
}
