<?php

class CatalogData_Model extends ESM {

   function __construct() {
      parent::__construct();
      $this->load->model('System/Storage_Model', 's_model');
   }

   public function LoadCatalogs() {

      $this->s_model->StorageInit(get_class($this));
      $Dir = $this->s_model->Path(true);
      
      $Everything = [];
      $Years = array_diff(scandir($Dir), ['.', '..']);

      foreach ($Years as $YearKey => $YearValue) {
         $Everything[$YearValue] = [];
         $Season = array_diff(scandir($Dir . $YearValue), ['.', '..']);

         foreach ($Season as $SeasonKey => $SeasonValue) {
            $Everything[$YearValue][$SeasonValue] = [];
            $Division = array_diff(scandir("{$Dir}{$YearValue}/{$SeasonValue}"), ['.', '..']);
            
            foreach ($Division as $DivisionKey => $DivisionValue) {
               $Everything[$YearValue][$SeasonValue][] = $DivisionValue;
            }
         }
      }
      ksort($Everything, SORT_NUMERIC);

      return array_reverse($Everything, true);
   }

}
