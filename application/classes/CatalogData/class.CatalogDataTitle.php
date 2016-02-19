<?php

class CatalogDataTitle {

   var $Title = '';
   var $Subtitle = '';
   var $Authors = [];
   var $Cover = '';
   var $Publisher = '';
   var $Imprint = '';
   var $Format = '';
   var $Prices = [];
   var $Trim = [];
   var $Pages = 0;
   var $Bisac = [];
   var $PublicationDate = '';
   var $Discount = '';
   var $Illustrations = [];
   var $AgeRange = [];

   public function __construct($data = []) {

      // Filter data 
      $data = array_intersect_key($data, get_class_vars(__CLASS__));

      foreach ($data as $key => $value) {
         $this->{$key} = $value;
      }
   }


}
