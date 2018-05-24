<?php

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 9/4/2016
 * Time: 1:00 PM
 */
class Reports extends CI_Controller
{


    function __construct()
    {

//        print "<html><body>";

        parent::__construct();


        $this->load->database();
        $this->load->library('session');

        // load library

        $this->load->helper(array('form', 'url', 'html'));

        $this->load->model('pos_model');


    }

    function index()
    {

        $output['priv'] = $this->session->userdata['emp']['priv'];
        $this->load->view('reports', $output);


    }

    function results( $date_from='', $date_to=''){

        $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`;';

        /*
        if($date!='')
            $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date="'.$date.'";';

        */
        if($date_from!='' )
            if($date_to!='')
                $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date>="'.$date_from.'" and _date<="'.$date_to.'";';

        else
            $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date>="'.$date_from.'";';


//        print $query;
        $result = $this->db->query($query)->result();

        $arr['data'] = $result[0];
        $arr['priv'] = $this->session->userdata['emp']['priv'];
        $this->load->view('results_report', $arr);

    }

    function resultsInDay($date=''){

        $query='';


        if($date!='') {
            $query = 'SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date="' . $date . '";';

            $result = $this->db->query($query)->result();

            $arr['data'] = $result[0];
            $this->load->view('results_report', $arr);
        }
    }


    function items_sales(){
//$date1=false, $date2=false
  //      if($date1==false) {

            $query = 'SELECT * FROM (SELECT item.id as id, item.code as code, sum(coalesce(bill_element.price, 0)) as total_price, 

concat((sum(coalesce(bill_element.price,0)) / (select sum(bill_element.price) from bill_element)*100), \' %\') as percentage

FROM item left join `bill_element` on item.code = bill_element.item
group by item.id ) as t
ORDER BY total_price DESC';
        /*}else{

            if($date_from!='' )
                if($date_to!='')
                    $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date>="'.$date_from.'" and _date<="'.$date_to.'";';

                else
                    $query='SELECT sum(total_price) as total, sum(after_discount) as after_discount, sum(paid) as paid, sum(remainder) as remained FROM `bill`
                 where _date>="'.$date_from.'";';


        }
*/

            $result = $this->db->query($query)->result();

      //      var_dump($result);

            $arr['data'] = $result;
        $arr['priv'] = $this->session->userdata['emp']['priv'];
            $this->load->view('items_sales_report', $arr);
        }


    function item_sales($item_code=false, $date_from=false, $date_to=false){

        //if($item_code!=false){
        $query = '';


        {
            $query = 'SELECT bill._date, item, price, quantity FROM `bill_element`, bill  
                WHERE bill_element.bill = bill.id and item="'.$item_code.'"';

            if($date_from!='' )
                if($date_to!='')
                    $query.='and bill._date>="'.$date_from.'" and _date<="'.$date_to.'";';

                else
                    $query.='and bill._date="'.$date_from.'";';


            $result = $this->db->query($query)->result();

            $arr['item'] = $result;
            $arr['priv'] = $this->session->userdata['emp']['priv'];
            $this->load->view('item_sales_report', $arr);
        }

    }




}


    ?>