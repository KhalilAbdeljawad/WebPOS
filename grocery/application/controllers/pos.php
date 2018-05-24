<?php
// Coded By Khalil Abdeljawad
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

	 function __construct()
    {
        parent::__construct();
 
 		
 
       //  $this->load->database();
		 $this->load->helper('url');
        $this->load->library('session');

        if(!isset($this->session->userdata['emp']['priv']))
            redirect('login');



    }
 
	
	
	public function index()
	{
	    //var_dump($this->session->userdata['emp']);
		$this->load->view('pos', $this->session->emp);
	}
}
