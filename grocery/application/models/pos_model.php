<?php
// Coded By Khalil Abdeljawad
class Pos_model extends CI_Model {

    private $table = 'item';

    function __construct() {
        parent::__construct();
    }

    function list_all() {
        $this -> db -> order_by('id', 'asc');
        return $this -> db -> get($this->table);
    }

    function count_all() {
        return $this -> db -> count_all($this -> table);
    }

    function getQuery($query) {
        return $this -> db -> query($query) -> result();
    }

    function get_paged_list($limit = 10, $offset = 0) {
        $this -> db -> order_by('id', 'asc');
        return $this -> db -> get($this->table, $limit, $offset);
    }

    function get_by_id($id) {
        $this -> db -> where('id', $id);
        return $this -> db -> get($this -> table);
    }

    function save($table, $row) {
        //	var_dump($document);
        $this -> db -> insert($table, $row);
        return $this -> db -> insert_id();
    }

    function update($id, $row) {
        $this -> db -> where('id', $id);
        return $this -> db -> update($this -> table, $row);
    }

    function delete($id) {
        $this -> db -> where('doc_id', $id);
        $this -> db -> delete($this -> table);
    }

    function get_doc_persons($doc_id) {

        $query = "select  emp1.employee_name  as 'doc_from' , emp2.employee_name as 'doc_to', emp3.employee_name as doc_place, emp3.employee_id as doc_place_emp_id
                   from employee as emp1, employee as emp2  , employee as emp3, document as doc,  document_track as dt
                   where   emp1.employee_id= doc.document_from and emp2.employee_id = doc.document_to
					and doc.document_id = " . $doc_id . "
					and emp3.employee_id = dt.document_place 
					and dt.document_id = doc.document_id 
					and dt.track_id = (select max(document_track.track_id) from document_track where document_track.document_id = " . $doc_id . "  );";
        //
        $query = $this -> db -> query($query) -> result();
        //var_dump($query[0]);
        return $query[0];
    }

    function get_item_by_code($code) {
        $query = "SELECT `names`.name_, item.id, item.code, price, quantity FROM `item`, `names`
        WHERE `code` ='" . $code . "' AND `names`.id = item.name_ and quantity>0;";

        $data = $this -> db -> query($query) -> result();
//        var_dump($data);

        if(!isset($data[0]) or empty($data[0])) return "ERROR";
        return $data[0];
    }

    function get_item_by_id($id) {
        $query = "SELECT `names`.name_, item.id, price, quantity FROM `item`, `names`
        WHERE item.id ='" . $id . "' AND `names`.id = item.name_ and quantity>0";

        $data = $this -> db -> query($query) -> result();
        if(empty($data)) return "ERROR";
        return $data[0];
    }


    function get_bills($limit) {
        $query = "SELECT id as 'recid', _date, total_price ,paid, discount, after_discount, remainder FROM `bill`
        order by id desc";

         if($limit!=0)
            $query.=" limit $limit";

        $data = $this -> db -> query($query) -> result();
        if(empty($data)) return "ERROR";


        return json_encode($data);
    }

    function get_bill_element($id) {
        $query = "SELECT @a:=@a+1 `recid`, bill_element.item as 'code', bill, `names`.name_ as item, bill_element.price, bill_element.quantity
        FROM `bill_element` , `names`, item, (SELECT @a:= 0) AS a
        WHERE bill='" . $id . "' AND `names`.id = item.name_ AND bill_element.item = item.code";


        $data = $this -> db -> query($query) -> result();
//var_dump($data);
        if(empty($data)) return "ERROR";
        return json_encode($data);
    }
    function get_item_quantity($id) {
        $query = "SELECT quantity FROM `item` 
        WHERE item.id ='" . $id . "'";

        $data = $this -> db -> query($query) -> result();
        if(empty($data)) return "ERROR";
        return $data[0]->quantity;
    }

    function replace_item_in_bill($bill_id, $bill_item, $price, $item_id, $new_item_price){


        $this->db->trans_start();

        $data = array(
            'quantity' => '`quantity`-1'

        );
        $query = 'UPDATE bill_element SET quantity = quantity-1 WHERE bill='.$bill_id.' and id='.$bill_item.' AND quantity > 0';

        //file_put_contents("update.txt", $query.'  ');
        $res = $this -> db -> query($query);

        if($this->db->affected_rows() <= 0) return 'ERROR';



        //file_put_contents("update.txt", $query."\n".$res."\n".$this->db->affected_rows());

        $query = 'select price from item where id='.$item_id.' and quantity>0';



        $res2 = $this -> db -> query($query)->result();

        file_put_contents("update.txt",  $res2[0]->price);


        $query = 'SELECT total_price FROM bill WHERE id='.$bill_id;

        $totalPrice = $this -> db -> query($query)->result()[0]->total_price;

        $totalPrice = $totalPrice - $price + $new_item_price;

        $query = 'insert into bill_element (bill, item, price, quantity) values ('.$bill_id.','.$item_id.','.$new_item_price.',1)';

        $res = $this -> db -> query($query);

        $query = 'update bill set total_price = '.$totalPrice.' where id='.$bill_id;

        $res = $this -> db -> query($query);


   //    file_put_contents("update.txt",  $totalPrice);




        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return 'ERROR';


        return "OK";


        //$new item_price =



        //$this->db->where('bill', $bill_id);
        //$this->db->where('id', $bill_item);


        //file_put_contents("update.txt", $this->db->set($data)->get_compiled_update('bill_element'));
        //$sql = $this->db->update('bill_element', $data);

        //$sql = $this->db->set($data)->get_compiled_update('bill_element');

    //    return $sql;
     //   return '{"msg":"'.$sql.'"}';



  //      $this->db->update('bill_element', $data);

//return "True";


//        return '{"OK": "'.$bill_id.'", "bill item": "'.$bill_item.'" , "item id": "'.$item_id.'"}';



    }

    function return_item_in_bill($bill_id, $bill_item, $price){


        $this->db->trans_start();

        $data = array(
            'quantity' => '`quantity`-1'

        );
        $query = 'UPDATE bill_element SET quantity = quantity-1 WHERE bill='.$bill_id.' and item='.$bill_item.' AND quantity > 0';

        //file_put_contents("update.txt", $query.'  ');
        $res = $this -> db -> query($query);


        if($this->db->affected_rows() <= 0) return 'ERROR';



        //file_put_contents("update.txt", $query."\n".$res."\n".$this->db->affected_rows());



        $query = 'SELECT total_price FROM bill WHERE id='.$bill_id;

        $totalPrice = $this -> db -> query($query)->result()[0]->total_price;

        $totalPrice = $totalPrice - $price;


        $query = 'update bill set total_price = '.$totalPrice.', after_discount = '.$totalPrice.', paid = '.$totalPrice.'  where id='.$bill_id;

        $res = $this -> db -> query($query);


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return 'ERROR';


        return "OK";


        //$new item_price =



        //$this->db->where('bill', $bill_id);
        //$this->db->where('id', $bill_item);


        //file_put_contents("update.txt", $this->db->set($data)->get_compiled_update('bill_element'));
        //$sql = $this->db->update('bill_element', $data);

        //$sql = $this->db->set($data)->get_compiled_update('bill_element');




        //      $this->db->update('bill_element', $data);

//return "True";


//        return '{"OK": "'.$bill_id.'", "bill item": "'.$bill_item.'" , "item id": "'.$item_id.'"}';



    }


    function save_bill($data){


        $this->db->trans_start();

        $status = "done";

        if($data['remainder']!=0)
            $status = "suspended";

        $insertData=array(
            'user' => $data['user'],
            'total_price' => $data['total_price'],
            'discount' => $data['discount'],
            'after_discount' => $data['after_discount'],
            'paid' => $data['paid'],
            'remainder' => $data['remainder'],
            'status' => $status,


        );

        $this->db->insert('bill', $insertData);

        $bill_id = $this->db->insert_id();

        $insertData = array();

        $notif = false;


        foreach ($_POST['items'] as $key => $value) {
            foreach ($value as $k => $val) {
                $insertData[$key][$k] = $val;
            }
            $insertData[$key]['bill'] = $bill_id;
            $this->db->insert('bill_element', $insertData[$key]);

            //if($this->get_item_quantity($_POST[$key]['item'])==0)

        }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
            return 'FALSE';


        $arr['result'] = "TRUE";
        $arr['bill_id'] = $bill_id;

        return $arr;

    }



}
?>