<?php

class Auth_Model extends ESM {

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
           'message' => 'Logging in is currently disabled. Please try again later.',
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
   var $ClientInfo = [
       'DiscountCodes'
   ];

   function __construct() {
      parent::__construct();
      $this->load->library('session');
   }

   public function login($username, $password) {

      if (!$this->enabled['login']['state']) {
         $this->newError("0000", $this->enabled['login']['message'], $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      $queryResult = $this->db->query("exec GetUser @username=?", [$username]);

      if ($queryResult && $queryResult->num_rows() && $user = $queryResult->row_object()) {

         $queryResult->free_result();

         if ($user->IsActive != '1') {
            $this->newError("0000", "Your account is disabled", $this, __FUNCTION__, "danger", null, false);
            return $this->generateResponse();
         }

         $exploded = explode('_', $user->Password);
         $passwordSet = $this->create_password($password, $exploded[0]);
         if ($exploded[1] === $passwordSet['hash']) {

            $itemmaster = $this->load->database('itemmaster', TRUE);
            $clientGetQuery = $itemmaster->query("exec Client_Get_WithDiscountCodes @clientId=?", [$user->Id]);

            $clientGetResult = '';
            if ($clientGetQuery && $clientGetQuery->num_rows() && $clientGet = $clientGetQuery->result_object()) {
               $clientGetResult = $clientGet;
            }


            $AuthMaster = $this->load->database('default', TRUE);
            $claimGetQuery = $AuthMaster->query("exec SecurityClaim_GetForUser @userid=?", [$user->Id]);
            if ($claimGetQuery && $claimGetQuery->num_rows() && $claimGet = $claimGetQuery->result_object()) {
               $claims = [];
               foreach ($claimGet as $value) {
                  $claims[$value->Area][str_replace(" ", "", $value->Application)][] = [
                      "Application" => $value->Application,
                      "Claim" => $value->Claim,
                      "Created" => $value->Created,
                  ];
               }
            }



            $this->UserId = (isset($user->Id) ? $user->Id : null);
            $this->Username = (isset($user->Username) ? $user->Username : null);
            $this->Email = (isset($user->Email) ? $user->Email : null);
            $this->RegisteredKey = (isset($user->RegisteredKey) ? $user->RegisteredKey : null);
            $this->FirstName = (isset($user->FirstName) ? $user->FirstName : null);
            $this->MiddleName = (isset($user->MiddleName) ? $user->MiddleName : null);
            $this->LastName = (isset($user->LastName) ? $user->LastName : null);
            $this->Roles = (isset($user->Role) ? $user->Role : null);
            $this->Flags = (isset($claims) ? $claims : null);
            $this->Created = (isset($user->created) ? $user->created : null);
            $this->LastModified = (isset($user->lastmodified) ? $user->lastmodified : null);
            $this->IsActive = (isset($user->IsActive) ? $user->IsActive : null);
            $this->Issuer = (isset($user->Issuer) ? $user->Issuer : null);
            $this->ClientInfo = ['DiscountCodes' => (isset($clientGetResult) ? $clientGetResult : null)];


            $this->set_session();

            $data = $this->session->user;
            return $this->generateResponse($data, "Welcome {$this->Username}!");
         } else {
            $this->newError("0000", "There was a problem with the username and/or password you supplied.", $this, __FUNCTION__, "danger", null, false);
            return $this->generateResponse();
         }
      } else {
         $this->newError("0000", "There was a problem with the username you supplied or your account has been disabled.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }
   }

   function set_session() {
      $this->session->set_userdata(
              [
                  'user' => [
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
                      ],
                      'clientinfo' => $this->ClientInfo
                  ]
              ]
      );
   }

   function getUser() {
      if ($this->session->user == null) {
         $this->newError("0000", "User is not logged in.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse(null, null, 401);
      } else {
         return $this->generateResponse($this->session->user);
      }
   }

   function logout() {
      $this->session->set_userdata('user');
      $this->session->sess_destroy();
      return $this->generateResponse(null, "Logout successful.");
   }

   function create_new_user($username, $password, $email, $regkey) {


      if (!$this->enabled['create_new_user']['state']) {

         $this->newError("0000", $this->enabled['create_new_user']['message'], $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      $checkuser = $this->db->query("exec DashboardUser_Get @Username=?", [$username]);
      if ($checkuser && $checkuser->num_rows()) {
         $this->newError("0000", "This username is already in use.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      $checkregkey = $this->db->query("exec Registration_Get @regKey=?", [$regkey]);
      if ($checkregkey && $checkregkey->num_rows() && $checkregkey->row_object()->IsValid) {
         
      } else {
         $this->newError("0000", "The registration key does not exist or is invalid. Please try again or contact your representative.", $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      $passwordSet = $this->create_password($password);
      $role = $this->SecurityRoles[4];
      $createuser = $this->db->query("exec DashboardUser_Create @RegisteredKey=?, @Username=?, @Password=?, @role=?, @Email=?", [$regkey, $username, $passwordSet['combined'], $role, $email]);

      $userId = '';
      if ($this->db->error()['code'] == '00000') {
         if ($createuser && $createuser->num_rows() && $createuserReturn = $createuser->row_object()) {
            $userId = $createuserReturn->Id;
         }
      } else {

         $this->newError("0000", ['A database error has occured'], $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      $updateorigin = $this->db->query("exec Registration_UpdateOrigin @RegistrationKey=?, @UserId=?", [$regkey, $userId]);
      if ($this->db->error()['code'] == '00000') {
         if ($updateorigin && $updateorigin->num_rows() && $updateorigin->row_object()->IsValid) {
            
         }
      } else {
         $this->newError("0000", ['A database error has occured'], $this, __FUNCTION__, "danger", null, false);
         return $this->generateResponse();
      }

      return $this->generateResponse(null, "Registration successful.");
   }

   function reset_password($username, $email) {
      error_reporting(E_ALL);
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $newPassword = substr(str_shuffle($chars), 0, 10);
      $newPasswordHash = $this->create_password($newPassword);
      $updateuser = $this->db->query("exec DashboardUser_Update @userName=?, @setpwd=?, @changepwd=?", [$username, $newPasswordHash['combined'], 1]);

      $data = [$newPassword, $newPasswordHash];

      $this->load->library('email');

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'smtp201.domainlocal.com';
      $config['smtp_host'] = '10.10.10.9';
      $config['smtp_user'] = '';
      $config['smtp_pass'] = '';
      $config['smtp_port'] = '25';
      $config['charset'] = 'utf-8';
      $config['newline'] = "\r\n";
      $config['crlf'] = "\r\n";
      $config['mailtype'] = 'html';

      $this->email->initialize($config);

      $this->email->from('no-reply@bookmasters.com', 'No Reply');
      $this->email->to([$email]);

      $this->email->subject('Bookmasters - Forgotten Password');
      $this->email->message("Hello {$username}, It appears you have forgotten your password. Your temporary password is <i>{$newPassword}</i>.");

      $this->email->send();

      return $this->generateResponse($data, 'If this email is associated with this username a temporary password has been sent to this email address.');
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