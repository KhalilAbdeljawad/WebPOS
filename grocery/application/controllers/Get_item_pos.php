<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Get_item_pos extends CI_Controller
{


    function __construct()
    {

//        print "<html><body>";

        parent::__construct();

        //$this->emp_level = $this->session->userdata('emp_level');

        ////
        $this->load->database();
        // load library

        // load helper
        $this->load->helper(array('form', 'url', 'html'));
        //$userId = $this -> session -> userdata('user_id');

        $this->load->model('pos_model');



    }

    function index()
    {

        if(isset($_GET['item_id'])) {
            $item = $this->pos_model->get_item_by_id($_GET['item_id']);
            if($item=="ERROR") print '{"msg":"ERROR"}';
            else print '{"name":"'.$item->name_ .'", "id":'.$item->id.', "price":'.$item->price.'}';
        }else{
            print '{"msg":"ERROR"}';
        }

    }

}

    ?>