<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'application/classes/CatalogData/class.CatalogDataAgeRange.php';
require 'application/classes/CatalogData/class.CatalogDataAuthor.php';
require 'application/classes/CatalogData/class.CatalogDataBisac.php';
require 'application/classes/CatalogData/class.CatalogDataIllustration.php';
require 'application/classes/CatalogData/class.CatalogDataPrice.php';
require 'application/classes/CatalogData/class.CatalogDataSpec.php';
require 'application/classes/CatalogData/class.CatalogDataTitle.php';
require 'application/classes/CatalogData/class.CatalogDataTrim.php';

class CatalogData extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->load->model('ApplicationModels/Marketing/CatalogData_Model', 'cd_model');
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Marketing';
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Index2() {

      
      $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
      $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
      $this->output->set_header("Pragma: no-cache");

      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Index_1");
   }

   public function DeleteCatalog() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->DeleteCatalog()));
   }

   public function CreateCatalog() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->CreateCatalog()));
   }

   public function GetAllCatalog() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->GetAllCatalog()));
   }

   public function View() {
      $Catalogs = $this->cd_model->LoadCatalogs();
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Index", ['Catalogs' => $Catalogs]);
   }

   public function Test2() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->ExportToCatalog()));
   }

   public function Test3() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->UpdateDescriptions()));
   }

   public function Test4() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->GetAllCatalogWithTitles()));
   }

   public function IngestData() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->IngestData()));
   }

   public function GetAllTitles() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->GetAllTitles()));
   }

   public function UpdateTitle() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->UpdateTitle()));
   }

   public function ApplyTemplates() {
      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->ApplyTemplates()));
   }

   public function UploadCover() {

      $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($this->cd_model->UploadCover()));
   }

}
