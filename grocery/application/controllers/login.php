<?php
// Coded By Khalil Abdeljawad
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();



        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');


    }



    public function index()
    {
        $this->load->view('login');
    }


    public  function login()
    {
     
        $res = $this->db->query("select * from employee where employee_username='".$_POST['username']."' and employee_pwd='".$_POST['pass']."'");

        if(!empty($res->result())) {


            $emp = $res->result()[0];
            $this->session->set_userdata('emp', array(
                'name'=> $emp->employee_name,
                'id' => $emp->employee_id,
            'priv' =>  $emp->priv));

            redirect('pos');
        }else{

            $data['err'] = true;
            $this->load->view('login', $data );
        }

    }

    public  function logout()
    {
        //var_dump($_POST);


            unset($this->session->empName);
            unset($this->session->empId);
            unset($this->session->empPriv);

            redirect('login');


    }
}

