<?php

class user_m extends CI_Model {

   var $UserId;
   var $Username;
   var $Email;
   var $RegisteredKey;
   var $FirstName;
   var $MiddleName;
   var $LastName;
   var $Roles;
   var $Flags;
   var $Created;
   var $LastModified;
   var $IsActive;
   var $Issuer;
   var $DBMethods = [

       'GetUser' => 'GetUser',
       'RegisterUser' => 'RegisterUser',
       'CreateRole' => null,
       'CreateClaim' => null
   ];

   function __construct() {
      parent::__construct();
      $this->load->library('session');
   }

   public function login($username, $password) {
      // Build a query to retrieve the user's details
      // based on the received username and password
      $queryResult = $this->db->query("exec {$this->DBMethods['GetUser']} ?, ?", [ null, $username]);


      if ($queryResult && $queryResult->num_rows() && $user = $queryResult->row_object()) {

         $queryResult->free_result();


         //found account, proceed
         if ($user->IsActive !== '1') {
            return ['message' => ['error' => 'Your account is disabled.']];
         }

         //create password using the hash from DB
         $exploded = explode('_', $user->Password);

         $passwordSet = $this->create_password($password, $exploded[0]);

         if ($exploded[1] === $passwordSet['hash']) {


            //set session
            $this->UserId = (isset($user->Id) ? $user->Id : null);
            $this->Username = (isset($user->Username) ? $user->Username : null);
            $this->Email = (isset($user->Email) ? $user->Email : null);
            $this->RegisteredKey = (isset($user->RegisteredKey) ? $user->RegisteredKey : null);
            $this->FirstName = (isset($user->FirstName) ? $user->FirstName : null);
            $this->MiddleName = (isset($user->MiddleName) ? $user->MiddleName : null);
            $this->LastName = (isset($user->LastName) ? $user->LastName : null);
            $this->Roles = (isset($user->Roles) ? $user->Roles : null);
            $this->Flags = (isset($user->Flags) ? $user->Flags : null);
            $this->Created = (isset($user->created) ? $user->created : null);
            $this->LastModified = (isset($user->lastmodified) ? $user->lastmodified : null);
            $this->IsActive = (isset($user->IsActive) ? $user->IsActive : null);
            $this->Issuer = (isset($user->Issuer) ? $user->Issuer : null);


            $this->set_session();
            return [ 'message' => [ 'success' => 'Welcome!'], 'data' => [ 'user' => $this->session->userdata]];
         } else {
            return ['message' => ['error' => 'There was a problem with the username and/or password you supplied.']];
         }
      } else {
         return [ 'message' => [ 'error' => 'There was a problem with the username you supplied or your account has been disabled.']];
      }
   }

   function set_session() {
      // session->set_userdata is a CodeIgniter function that
      // stores data in CodeIgniter's session storage.  Some of the values are built in
      // to CodeIgniter, others are added.  See CodeIgniter's documentation for details.
      $this->session->set_userdata(
              [
                  'user' =>
                  [
                      'credentials' => [
                          'userid' => $this->UserId,
                          'username' => $this->Username,
                          'email' => $this->Email,
                          "registeredkey" => $this->RegisteredKey,
                      ],
                      'user' => [
                          'firstname' => $this->FirstName,
                          'middlename' => $this->MiddleName,
                          'lastname' => $this->LastName,
                      ],
                      'roles' => [ $this->Roles],
                      'flags' => [$this->Flags],
                      'accountinfo' => [
                          'created' => $this->Created,
                          'lastmodified' => $this->LastModified,
                          'isactive' => $this->IsActive,
                          'issuer' => $this->Issuer,
                      ]
                  ]
              ]
      );
   }

   function getUser() {
      if ($this->session->user == null) {
         return [ 'message' => [ 'error' => 'User is not logged in.']];
      } else {
         return $this->session->user;
      }
   }

   function logout() {
      $this->session->set_userdata('user');
      $this->session->sess_destroy();

      return [ 'message' => [ 'success' => 'Registration successful.']];
   }

   function create_new_user($username, $password, $email, $regkey) {

      $passwordSet = $this->create_password($password);
      //insert new user into db

      $registerquery = $this->db->query("exec {$this->DBMethods['RegisterUser']} ?, ?, ?, ?", [ $regkey, $username, $passwordSet['salt'] . "_" . $passwordSet['hash'], $email]);
      $registersuccess = $this->db->query("exec {$this->DBMethods['GetUser']} ?, ?", [ null, $username]);

      if ($registerquery && $registerquery->num_rows() && $registersuccess && $registersuccess->num_rows() && $newuser = $registersuccess->row_object()) {
         $registerquery->free_result();
         $registersuccess->free_result();
         return [ 'message' => [ 'success' => 'Registration success.']];
      } else {
         $registerquery->free_result();
         $registersuccess->free_result();
         return [ 'message' => [ 'error' => 'Registration failed.']];
      }
   }

   function isValueOrNull($value) {
      $value = trim($value);

      if ($value == null || empty($value)) {
         $value == null;
      }

      return $value;
   }

   public static function create_password($password, $baseSalt = null) {

      if ($baseSalt == null) {
         $salt = mcrypt_create_iv(512 / 8, MCRYPT_DEV_URANDOM); //IV
         $baseSalt = base64_encode($salt); //Base the salt
      } $finalpass = base64_encode(hash_pbkdf2('sha512', $password, $baseSalt, 40000, 100, false)); //Create hash
      return [
          'salt' => $baseSalt,
          'hash' => $finalpass
      ];
   }

}
