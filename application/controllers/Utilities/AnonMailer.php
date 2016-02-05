<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnonMailer extends Secure_Controller {

   var $app = [];

   function __construct() {
      parent::__construct();
      $this->app['links'] = get_class_methods($this);
      $this->app['appName'] = get_class($this);
      $this->app['viewFolder'] = 'Applications';
      $this->app['folder'] = 'Utilities';
      if (file_exists("application/models/{$this->app['folder']}Models/{$this->app['appName']}_Model.php")) {
         $this->load->model("{$this->app['folder']}/{$this->app['appName']}_Model", "{$this->app['appName']}_Model");
      }
   }

   public function Index() {
      $this->load->view("{$this->app['viewFolder']}/{$this->app['folder']}/{$this->app['appName']}/" . __FUNCTION__);
   }

   public function Send() {
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
      $this->email->to($this->input->post('to'));
      $this->email->set_mailtype("html");
      $this->email->subject($this->input->post('subject'));
      $this->email->message($this->input->post('message'));

      if ($this->email->send()) {
         $this->output
                 ->set_content_type('application/json')
                 ->set_status_header(200)
                 ->set_output(json_encode("Success"));
      } else {
         $this->output
                 ->set_content_type('application/json')
                 ->set_status_header(400)
                 ->set_output(json_encode("Error"));
      }
   }

}
