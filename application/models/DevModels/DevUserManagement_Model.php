<?php

class DevUserManagement_Model extends CI_Model {

   var $UserId;

   function __construct() {
      parent::__construct();
      $this->load->library('session');
   }


   function viewUsers() {

      $userquery = $this->db->select('Id, Email, IsActive, Username, Created, LastModified, RegisteredKey, RoleId'); 
      $userquery = $this->db->order_by('Id', 'ASC'); 
      $userquery = $this->db->get('dbo.DashboardUsers'); 

      if ($userquery && $userquery->num_rows() && $userresult = $userquery->result_object()) {
         return $userresult;
      } else {
         return false;
      }
   }

}
