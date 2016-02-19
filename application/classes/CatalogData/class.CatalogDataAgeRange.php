<?php

class CatalogDataAgeRange {

   var $From = '';
   var $To = '';

   public function __construct($data = []) {
      // Filter data 
      $data = array_intersect_key($data, get_class_vars(__CLASS__));
      foreach ($data as $key => $value) {
         $this->{$key} = $value;
      }
   }

}
