<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Handle_pos extends CI_Controller
{


    function __construct()
    {

//        print "<html><body>";

        parent::__construct();

        //$this->emp_level = $this->session->userdata('emp_level');

        ////
        $this->load->database();
        $this->load->library('session');
        // load library

        // load helper
        $this->load->helper(array('form', 'url', 'html'));

        if(!isset($this->session->userdata['emp']['priv']))
            redirect('login');


        //$userId = $this -> session -> userdata('user_id');

        $this->load->model('pos_model');



    }

    function index()
    {

        if(isset($_POST['item_id'])) {
            $item = $this->pos_model->get_item_by_id($_POST['item_id']);
            if($item=="ERROR") print '{"msg":"ERROR"}';
            else print '{"name":"'.$item->name_ .'", "id":'.$item->id.', "price":'.$item->price.'}';
        }else{
            print '{"msg":"ERROR"}';
        }

    }

    function get_item($item_id){
        if(isset($item_id)) {
            $item = $this->pos_model->get_item_by_code($item_id);
            if($item=="ERROR") print '{"msg":"ERROR"}';
            else print '{"name":"'.$item->name_ .'", "code":'.$item->code.', "price":'.$item->price.', "quantity":'.$item->quantity.'}';
        }else{
            print '{"msg":"ERROR"}';
        }
    }


    function getLowElementQuantity(){
        $query='SELECT item.id, code, quantity, `name` FROM `item`, room  WHERE quantity<=10 AND room.id = item.room;';

        $result = $this->db->query($query)->result();

        if($result) {
            $table = '<table><caption style="text-align: center">أصناف كميتها المتبقية قليلة</caption>';
            $table .= '<tr><th>رقم الصنف</th><th>الكود</th><th>الكمية المتبقية</th><th>المكان</th></tr>';
            foreach ($result as $value) {

                $table .= '<tr>';
                $table .= '<td style="text-align: center">' . $value->id . '</td><td style="text-align: center">' . $value->code . '</td><td style="text-align: center">' . $value->quantity . '</td><td style="text-align: center">' . $value->name . '</td><td>';
                $table .= '</tr>';

            }
            $table .= '</table>';

            print $table;
        }else{
            print 'false';
        }
    }

    function replace_item($bill_id, $prev_item_id, $price, $new_item_id, $new_item_price){

        //print '{"msg":"'.$prev_item_id.'"}';
        //return;
        if(isset($prev_item_id)) {
            $item = $this->pos_model->replace_item_in_bill($bill_id, $prev_item_id, $price, $new_item_id, $new_item_price);

            print '{"msg":"'.$item.'"}';
            return;
            if($item=="ERROR") print '{"msg":"ERROR"}';
            else print  $item;
        }else{
            print '{"msg":"ERROR"}';
        }
    }



    function return_item($bill_id, $prev_item_id, $price){

        //print '{"msg":"'.$prev_item_id.'"}';
        //return;
        if(isset($prev_item_id)) {
            $item = $this->pos_model->return_item_in_bill($bill_id, $prev_item_id, $price);

            print '{"msg":"'.$item.'"}';
            return;
            if($item=="ERROR") print '{"msg":"ERROR"}';
            else print  $item;
        }else{
            print '{"msg":"ERROR"}';
        }
    }

    function save_bill(){


     //  print_r($_POST);

    $_POST['user'] = $this->session->userdata['emp']['id'];
        $result = $this->pos_model->save_bill($_POST);


        echo json_encode($result);

        //echo '{"result":"'.$result.'"}';

//        print "Sent json = ".$json;
    }



    function test(){
        print '{"msg":"you sent to me: '.$_POST["id"].'   with name '.$_POST["name"].'"}';
    }


    function print_receipt($bill){

        $query = 'SELECT `names`.name_, `bill_element`.quantity, bill_element.price, bill_element.price*bill_element.quantity as total  FROM `bill_element`, `names`, `item`
WHERE bill_element.bill='.$bill.' AND item.name_ = `names`.id and bill_element.item = item.code;';
        $result = $this->db->query($query)->result();

        $data['data'] = $result;

        $query = 'SELECT _date as date, _time as time, total_price as total, discount, after_discount, paid, remainder,employee_name as `user` FROM bill, employee WHERE id ='.$bill.' and employee_id=user';

      //  var_dump($query);
        $data['bill_data']['data'] = $this->db->query($query)->result()[0];

        $data['bill_data']['bill_id'] = $bill;
        $data['name'] = $data['bill_data']['data']->user;
        $data['priv'] = $this->session->userdata['emp']['priv'];


        $this->load->view('receipt', $data);

    }


    function bills(){
        $this->load->view("bills", $this->session->userdata['emp']);
    }

    function get_bills($limit=100){
        print $this->pos_model->get_bills($limit);
    }


    function get_bill_elements($bill_id){
        if(isset($bill_id)) {
            $elem = $this->pos_model->get_bill_element($bill_id);
            if($elem=="ERROR") print '{"msg":"ERROR"}';
            print $elem;
            //else print '{"item":"'.$elem->item .'", "price":'.$elem->price.', "quantity":'.$elem->quantity.'}';
        }else{
            print '{"msg":"ERROR"}';
        }
    }








}

?>