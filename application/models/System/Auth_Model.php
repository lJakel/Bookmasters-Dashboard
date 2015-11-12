<?php

class Auth_Model extends CI_Model {

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
   var $enabled = [
       'login' => [
           'state' => true,
           'message' => 'Logging in is disabled for the moment. ',
       ],
       'create_new_user' => [
           'state' => true,
           'message' => 'Registration is disabled. Please try again later.'
       ]
   ];
   var $SecurityRoles = [
       0 => 'General Manager',
       1 => 'Developer',
       2 => 'Administrator',
       3 => 'CSR Manager',
       5 => 'CSR',
       4 => 'Client'
   ];
   var $DBMethods = [
       'GetUser' => 'GetUser',
       'RegisterUser' => 'RegisterUser',
       'CreateRole' => null,
       'CreateClaim' => null
   ];

   function __construct() {
      parent::__construct();
      $this->load->library('session');
      //
   }

   public function login($username, $password) {
      if (!$this->enabled['login']['state']) {
         return ['message' => ['error' => $this->enabled['login']['message']]];
      }

// Build a query to retrieve the user's details
// based on the received username and password
      $queryResult = $this->db->query("exec {$this->DBMethods['GetUser']} ?, ?", [null, $username]);


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
            $this->Roles = (isset($user->Role) ? $user->Role : null);
            $this->Flags = (isset($user->Flags) ? $user->Flags : null);
            $this->Created = (isset($user->created) ? $user->created : null);
            $this->LastModified = (isset($user->lastmodified) ? $user->lastmodified : null);
            $this->IsActive = (isset($user->IsActive) ? $user->IsActive : null);
            $this->Issuer = (isset($user->Issuer) ? $user->Issuer : null);


            $this->set_session();
            return ['message' => ['success' => 'Welcome!'], 'data' => ['user' => $this->session->userdata]];
         } else {
            return ['message' => ['error' => 'There was a problem with the username and/or password you supplied.']];
         }
      } else {
         return ['message' => ['error' => 'There was a problem with the username you supplied or your account has been disabled.']];
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
                      'roles' => [$this->Roles],
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
         return ['message' => ['error' => 'User is not logged in.']];
      } else {
         return $this->session->user;
      }
   }

   function logout() {
      $this->session->set_userdata('user');
      $this->session->sess_destroy();

      return ['message' => ['success' => 'Registration successful.']];
   }

   function create_new_user($username, $password, $email, $regkey) {


      if (!$this->enabled['create_new_user']['state']) {
         return ['message' => ['error' => $this->enabled['create_new_user']['message']]];
      }

      $checkuser = $this->db->query("exec DashboardUser_get ?, ?", [null, $username]);
      if ($checkuser && $checkuser->num_rows()) {
         return ['message' => ['error' => 'This username is already in use.']];
      }

      $checkregkey = $this->db->query("exec Registration_Get ?", [$regkey]);
      if ($checkregkey && $checkregkey->num_rows() && $checkregkey->row_object()->IsValid) {
         
      } else {
         return ['message' => ['error' => 'The registration key does not exist or is invalid. Please try again or contact your representative.']];
      }

      $passwordSet = $this->create_password($password);
      $role = $this->SecurityRoles[4];
      $createuser = $this->db->query("exec DashboardUser_Create ?, ?, ?, ?, ?", [$regkey, $username, $passwordSet['combined'], $role, $email]);

      $userId = '';
      if ($this->db->error()['code'] == '00000') {
         if ($createuser && $createuser->num_rows() && $createuserReturn = $createuser->row_object()) {
            $userId = $createuserReturn->Id;
         }
      } else {
         return ['message' => ['error' => 'A database error has occured']];
      }

      $updateorigin = $this->db->query("exec Registration_UpdateOrigin ?, ?", [$regkey, $userId]);
      if ($this->db->error()['code'] == '00000') {
         if ($updateorigin && $updateorigin->num_rows() && $updateorigin->row_object()->IsValid) {
            
         }
      } else {
         return ['message' => ['error' => 'A database error has occured']];
      }

      return ['message' => ['success' => 'Registration successful.']];
   }

   function authorizeApplication($role) {
      if (in_array($role, $this->session->user['roles'], true)) {
         //allowed
      } else {
         $this->output->set_status_header('403');
         exit;
      }

      return true;
   }

   public static function create_password($password, $baseSalt = null) {

      if ($baseSalt == null) {
         $salt = mcrypt_create_iv(512 / 8, MCRYPT_DEV_URANDOM); //IV
         $baseSalt = base64_encode($salt); //Base the salt
      }
      $finalpass = base64_encode(hash_pbkdf2('sha512', $password, $baseSalt, 40000, 100, false)); //Create hash
      return [
          'salt' => $baseSalt,
          'hash' => $finalpass,
          'combined' => $baseSalt . '_' . $finalpass
      ];
   }

}
