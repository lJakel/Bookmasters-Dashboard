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
      $Catalogs = $this->cd_model->LoadCatalogs();
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__, ['Catalogs' => $Catalogs]);
   }
   public function View() {
      $Catalogs = $this->cd_model->LoadCatalogs();
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Index", ['Catalogs' => $Catalogs]);
   }

   public function Test() {
      $TitleArr = [
          'Title' => 'Lol',
          'Subtitle' => 'Lol',
      ];
      $Title = new CatalogDataTitle($TitleArr);

      $Title->Authors[] = new CatalogDataAuthor(['Prefix' => 'Mr']);
      $Title->Prices[] = new CatalogDataPrice(['Prefix' => 'Mr']);
      $Title->Trim[] = new CatalogDataTrim(['Prefix' => 'Mr']);
      $Title->Bisac[] = new CatalogDataBisac(['Prefix' => 'Mr']);
      $Title->Illustrations[] = new CatalogDataIllustration(['Prefix' => 'Mr']);
      $Title->AgeRange[] = new CatalogDataAgeRange(['Prefix' => 'Mr']);

      echo json_encode($Title);
   }

   public function OnePer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

   public function TwoPer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

   public function ThreePer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

   public function FourPer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

   public function SixPer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

   public function EightPer() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/Pages/" . __FUNCTION__);
   }

}
