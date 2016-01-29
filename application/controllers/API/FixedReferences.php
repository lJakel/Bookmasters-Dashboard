<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FixedReferences extends CI_Controller {

   function __construct() {
      parent::__construct();
      //$this->Auth_Model->authorizeApplication('Developer');
      $this->load->model('API/API_Model');
      $this->output->set_header('Content-Type: application/json');
   }

   public function GetAllReferences() {
      
      $itemmaster = $this->load->database('itemmaster', TRUE);

      $refMediaTypesQuery = $itemmaster->get('dbo.refProductTypes');
      $output['MediaTypes'] = $refMediaTypesQuery->result_object();
      $refMediaTypesQuery->free_result();

      $refContributorRolesQuery = $itemmaster->select('Id, Name')->get('dbo.rfContributorRoles');
      $output['ContributorRoles'] = $refContributorRolesQuery->result_object();
      $refContributorRolesQuery->free_result();

      $refAudienceTypesQuery = $itemmaster->select('Id, FormEnabled, Name')->get('dbo.rfAudienceTypes');
      $output['AudienceTypes'] = $refAudienceTypesQuery->result_object();
      $refAudienceTypesQuery->free_result();

      $refEditionTypesQuery = $itemmaster->select('Id, Name')->get('dbo.rfEditionTypes');
      $output['EditionTypes'] = $refEditionTypesQuery->result_object();
      $refEditionTypesQuery->free_result();

      $refPublicationStatusesQuery = $itemmaster->select('Id, Name')->get('dbo.rfPublicationStatuses');
      $output['PublicationStatuses'] = $refPublicationStatusesQuery->result_object();
      $refPublicationStatusesQuery->free_result();

      $refBisacGroupsQuery = $itemmaster->select('Id, Prefix, Name, YearVersion')->get('dbo.BisacGroups');
      $output['BisacGroups'] = $refBisacGroupsQuery->result_object();
      $refBisacGroupsQuery->free_result();

      echo json_encode($output);
   }

}
