<?php

class Storage_Model extends ESM {

   public $StorageDir;
   public $AppControllerDir;
   public $OriginalUploadedFiles;
   public $UploadedFiles;

   /**
    * Returns storage path
    * @param boolean $ending
    * @return type
    */
   public function Path($ending = false) {
      if ($ending) {
         return $this->StorageDir . '/' . $this->AppControllerDir . '/';
      } else {
         return $this->StorageDir . '/' . $this->AppControllerDir;
      }
   }

   function __construct() {
      parent::__construct();
   }

   public function CreateFolder($folder) {
      $path = $this->Path(true) . $folder;

      if (!file_exists($path)) {
         mkdir($path, 0777, true);
      }
   }

   public function StorageInit() {
      $this->StorageDir = 'Storage';
      $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
      $this->AppControllerDir = $trace[1]['class'];
      $this->CreateFolder('');
   }

   /**
    * Adds file to apps storage folder
    * @param type $FolderName
    * @param type $FileName
    * @param array $File
    */
   public function AddToStorage($FolderName, $FileName, $File) {
      if (is_array($File)) {
         foreach ($File as $value) {
            
         }
      }
   }

   public function MoveFiles($folder) {
      $path = $this->Path(true) . $folder . '/';
      $this->CreateFolder($folder);

      $this->UploadedFiles = $this->OriginalUploadedFiles;
      foreach ($this->OriginalUploadedFiles as $key => $file) {
         copy($file['full_path'], $path . $file['file_name']);
         $this->UploadedFiles[$key]['full_path'] = realpath($path . $file['file_name']);
         $this->UploadedFiles[$key]['file_path'] = realpath(dirname($path . $file['file_name']));
      }
      return ($this->UploadedFiles);
   }

   public function DeleteFiles() {
      foreach ($this->OriginalUploadedFiles as $file) {
         unlink($file['full_path']);
      }
   }

   public function UploadFile($allowedtypes = "*") {

// we retrieve the number of files that were uploaded
      $number_of_files = sizeof($_FILES['uploadedfiles']['tmp_name']);

// considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
      $files = $_FILES['uploadedfiles'];

// first make sure that there is no error in uploading the files
      for ($i = 0; $i < $number_of_files; $i++) {
         if ($_FILES['uploadedfiles']['error'][$i] != 0) {
// save the error message and return false, the validation of uploaded files failed
            $this->newError("0000", "There was an error in your file upload.", $this, __FUNCTION__, "danger", null, false);
            return $this->generateResponse();
         }
      }

// we first load the upload library
      $this->load->library('upload');
      $UploadPath = "Uploads";
      $this->CreateFolder($UploadPath);
// next we pass the upload path for the images
      $config['upload_path'] = $this->Path(true) . $UploadPath;
// also, we make sure we allow only certain type of images
      $config['allowed_types'] = $allowedtypes;



      $uploaded;
// now, taking into account that there can be more than one file, for each file we will have to do the upload
      for ($i = 0; $i < $number_of_files; $i++) {
         $_FILES['uploadedfile']['name'] = $files['name'][$i];
         $_FILES['uploadedfile']['type'] = $files['type'][$i];
         $_FILES['uploadedfile']['tmp_name'] = $files['tmp_name'][$i];
         $_FILES['uploadedfile']['error'] = $files['error'][$i];
         $_FILES['uploadedfile']['size'] = $files['size'][$i];

//now we initialize the upload library
         $this->upload->initialize($config);
         if ($this->upload->do_upload('uploadedfile')) {
            $uploaded[$i] = $this->upload->data();
         } else {
            $this->newError("0000", "There was an error in your file upload.", $this, __FUNCTION__, "danger", null, false);
            return $this->generateResponse();
         }
      }
      $this->OriginalUploadedFiles = $uploaded;
      return $uploaded;
   }

}
