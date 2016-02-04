<?php

class API_Model extends ESM {

   function __construct() {
      parent::__construct();
   }

   /*    * getBisacGroupCodes
    * 
    * @param type $group
    * @return type
    */

   function getFixedReferences() {
      $itemmaster = $this->load->database('itemmaster', TRUE);

      $refMediaTypesQuery = $itemmaster->get('dbo.refProductTypes');
      $output['FixedProductTypes'] = $refMediaTypesQuery->result_object();
      $refMediaTypesQuery->free_result();

      $refContributorRolesQuery = $itemmaster->select('Id, Name')->get('dbo.rfContributorRoles');
      $output['FixedAuthorRoles'] = $refContributorRolesQuery->result_object();
      $refContributorRolesQuery->free_result();

      $refAudienceTypesQuery = $itemmaster->query('exec AudienceType_Get');
      $output['FixedAudienceTypes'] = $refAudienceTypesQuery->result_object();
      $refAudienceTypesQuery->free_result();

      $refAgeRangeQuery = $itemmaster->query('exec AgeRange_Get');
      $output['FixedAgeRanges'] = $refAgeRangeQuery->result_object();
      $refAgeRangeQuery->free_result();

      $refEditionTypesQuery = $itemmaster->select('Id, Name')->get('dbo.rfEditionTypes');
      $output['FixedEditionTypes'] = $refEditionTypesQuery->result_object();
      $refEditionTypesQuery->free_result();

      $refPublicationStatusesQuery = $itemmaster->select('Id, Name')->get('dbo.rfPublicationStatuses');
      $output['FixedPublicationStatuses'] = $refPublicationStatusesQuery->result_object();
      $refPublicationStatusesQuery->free_result();

      $refBisacGroupsQuery = $itemmaster->select('Id, Prefix, Name, YearVersion')->get('dbo.BisacGroups');
      $output['FixedBisacGroups'] = $refBisacGroupsQuery->result_object();
      $refBisacGroupsQuery->free_result();

      $refISOCountryCodesQuery = $itemmaster->query('exec ISO3166Country_Get');
      $output['FixedISOCountryCodes'] = $refISOCountryCodesQuery->result_object();
      $refISOCountryCodesQuery->free_result();

      $refISOLanguageCodesQuery = $itemmaster->query('exec ISOLanguages_Get');
      $output['FixedISOLanguageCodes'] = $refISOLanguageCodesQuery->result_object();
      $refISOLanguageCodesQuery->free_result();


      return $this->generateResponse($output);
   }

   function getBisacGroupCodes($group) {
      $itemmaster = $this->load->database('itemmaster', TRUE);
      $bisacQuery = $itemmaster->query('exec BisacCode_Get @groupId=?', [$group]);

      if ($bisacQuery && $bisacQuery->num_rows() && $bisacResult = $bisacQuery->result_object()) {
         
      } else {
         $this->newError("0000", 'There was an error retrieving Bisac Group Codes.', $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse($bisacResult);
   }

   function getAllBisacGroups() {
      $itemmaster = $this->load->database('itemmaster', TRUE);

      $bisacQuery = $itemmaster->query('exec BisacGroup_Get');
      if ($bisacQuery && $bisacQuery->num_rows() && $bisacResult = $bisacQuery->result_object()) {
         return ['message' => ['success' => ''], 'data' => $bisacResult];
      } else {
         return ['message' => ['error' => 'There was an error retrieving All Bisac Groups.']];
      }
   }

   function getAllIsoCodes($cache = '') {

      $itemmaster = $this->load->database('itemmaster', TRUE);
      $isoCodeQuery = $itemmaster->query('exec ISO3166Country_Get');

      if ($isoCodeQuery && $isoCodeQuery->num_rows() && $isoCodeResult = $isoCodeQuery->result_object()) {
         
      } else {
         $this->newError("0000", 'There was an error retrieving All ISO Codes.', $this, __FUNCTION__, "danger", null, false);
      }
      return $this->generateResponse($isoCodeResult);
   }

   function getAllLanguageIsoCodes($cache = '') {

      $itemmaster = $this->load->database('itemmaster', TRUE);
      $isoCodeQuery = $itemmaster->query('exec ISOLanguages_Get');
      if ($isoCodeQuery && $isoCodeQuery->num_rows() && $isoCodeResult = $isoCodeQuery->result_object()) {
         return ['message' => ['success' => ''], 'data' => ['codes' => $isoCodeResult]];
      } else {
         return ['message' => ['error' => 'There was an error retrieving All ISO Codes.']];
      }
   }

}
