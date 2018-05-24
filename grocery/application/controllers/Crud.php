<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Crud extends CI_Controller {
 
 
 private $crud;

    public $primary_key = 0;
    function __construct()
    {
        parent::__construct();



        $this->load->database();
		 $this->load->helper('url');
        /* ------------------ */




        $this->load->library('grocery_CRUD');
        $this->load->library('session');
        if(!isset($this->session->userdata['emp']['priv']))
            redirect('login');



        $this->crud = new grocery_CRUD();
		//$this->needed_software();


    }
 
    public function index()
    {
    	print '<center><img src="'.base_url().'assets/images/logo.png" />';
        echo "<center><h1>Welcome to the world of LTNET Systems</h1>";//Just an example to ensure that we get into the function
        print "<a  href='".base_url()."software/ticket_sys/add'><h2>منظومة الدعم الفني</h2></a>";
		print "<a   href='".base_url()."software/needed_software/add'><h2>منظومة طلبات البرامج</h2></a>";
        //die();
    }
	
	public function employee()
    {
		$crud = new grocery_CRUD();
		$crud->set_subject("الموظفون");
        $crud->set_table('employee');
		
		$crud->display_as('employee_name','اسم الموظف');
		$crud->display_as('employee_id','رقم الموظف');
        $crud->display_as('priv','الصلاحية');
		$crud->display_as('employee_username','اسم المستخدم');
		$crud->display_as('employee_pwd','كلمة المرور');
		$crud->display_as('management_id','الإدارة');
		$crud->display_as('division_id','القسم');
		$crud->display_as('employee_email','البريد الإلكتروني');
		$crud->display_as('employee_state_id','الوصف الوظيفي');
		//$crud->columns("TICKET", 'PRODUCT','PRICE');
		//$crud->fields("TICKET", 'LINE', 'product','price');
		//$crud->set_relation('management_id','management','management_name');
		//$crud->set_relation('employee_state_id','employee_state','employee_state_name');
        $output = $crud->render();
		$this->to_view($output);
		
		return $output;        
 		
      /*  echo "<pre>";
        print_r($output);
        echo "</pre>";
        die();
		*/
    }


	public function needed_software()
    {
		$this->item();
	//	$this->bill();
    }
	
	function to_view($output = null)
 
    {
        $output->   priv = $this->session->userdata['emp']['priv'];
        $this->load->view('crud_viewer.php',$output);    
    }

    function show_item($output = null)

    {
        $output['priv'] = $this->session->userdata['emp']['priv'];
        $this->load->view('view_item',$output);
    }


	
	
	
	public function item(){
		$crud = $this->crud;
		$crud->set_subject("الأ صناف");
        $crud->set_table('item');
		$crud->display_as('code','الكود');
        $crud->display_as('prev_code','الكود السابق');
		$crud->display_as('sizes','الأرقام');
		$crud->display_as('room','غرفة التخزين');
		$crud->display_as('note','ملاحظات');
        $crud->display_as('price','السعر');
        $crud->display_as('name_','النوع');
        $crud->display_as('quantity','الكمية');
        $crud->display_as('image','صورة الصنف');
        $crud->display_as('pprice_ae','سعر الشراء (درهم)');
        $crud->display_as('pprice_ly','سعر الشراء (دينار)');
        $crud->display_as('item_date','تاريخ الدخول');

        $crud->set_field_upload('image','assets/uploads/files');
	//	$crud->columns('employee_id', 'software_name','software_description');
		//$crud->fields("TICKET", 'LINE', 'product','price');
		
		//$crud->unset_back_to_list();


        $crud->callback_after_insert(array($this, '_item_after_insert'));



        //$crud->add_fields('employee_id','needed_software','software_description');
		$crud->set_relation('room','room','name');
        $crud->set_relation('name_','names','name_');



        $crud->set_lang_string('insert_success_message',
            'تمت إضافة الصنف بنجاح
		 <script type="text/javascript">
              window.location = "'.base_url().'../usebarcode.php?text='.$this->primary_key.'";
		 </script>
		 <div style="display:none">
		 '
        );


		//$crud->set_relation('employee_id_by_ip','employee','employee_name');
		
		//if($this->get_ip_address()!="127.0.0.1" and $this->get_ip_address()!="::1" and $this->get_ip_address()!="172.16.10.59" and $this->get_ip_address()!="172.16.10.69")
         //$crud->unset_list();
        
		/*
		try{
    $crud->render();
} catch(Exception $e) {
    show_error($e->getMessage());
}*/
    //$crud->set_theme('datatables');
    
   ///////////////
/*
    $crud->callback_after_insert(function(){

    	print "<script type='text/javascript'>alert('شكرا،، تم إرسال طلبك');</script>";
    });*/
	//////////////////////////
        $output = $crud->render();
		
		$this->to_view($output);
		//return $output;        
	}

    function _item_after_insert($post_array,$primary_key){
        //print "<script type='text/javascript'>alert('شكرا،، تم إرسال طلبك');</script>";
        //header("Location: http://khalil.tech/number=".$post_array['code']);
        //print "<script>window.location='http://khalil.tech/number=".$post_array['code']."'</script>";

        //exit;
       /* foreach ($post_array as $key => $value)
        file_put_contents("data___.txt", $key.' = '.$value, FILE_APPEND);
        file_put_contents("data___2.txt", $primary_key);
        var_dump($post_array);
        var_dump($primary_key);
       */

       $this->primary_key = $primary_key;


    }

	public function  bill(){
		$crud = new grocery_CRUD();
		//$crud = $this->crud;
		$crud->set_subject("الفواتير");
        $crud->set_table('bill');
		$crud->display_as('_date','التاريخ');
		$crud->display_as('_time','الوقت');
		$crud->display_as('user','المستخدم');
		$crud->display_as('total_price','الإجمالي');
        $crud->display_as('discount','قيمة التخفيض');
        $crud->display_as('after_discount','الإجمالي بعد التخفيض');
        $crud->display_as('paid','المدفوع');
        $crud->display_as('remainder','المتبقي');
        $crud->display_as('status','حالة الفاتورة');
	//	$crud->columns('employee_id', 'software_name','software_description');
		//$crud->fields("TICKET", 'LINE', 'product','price');

		//$crud->unset_back_to_list();

	
		//$crud->add_fields('employee_id','needed_software','software_description');
		//$crud->set_relation('room','room','name');
		//$crud->set_relation('employee_id_by_ip','employee','employee_name');

		/*
		try{
    $crud->render();
} catch(Exception $e) {
    show_error($e->getMessage());
}*/
    //$crud->set_theme('datatables');
    
   ///////////////
    $crud->callback_after_insert(function(){
    	print "<script type='text/javascript'>alert('شكرا،، تم إرسال طلبك');</script>";
    });

        //$crud2 = $this->bill_itmes();
	//////////////////////////
        $output = $crud->render();
		
		$this->to_view($output);

        //$crud->add_action('Bill Element', '', 'coba/employee');
        $crud->add_action('Detail', '', '','',array($this,'for_items'));


        return $output;
	//
	        
	}


    public function for_items($itemCode){

        $crud = new grocery_CRUD();
        $crud->set_table('bill_element');
        $crud->where('id', $itemCode);

        //$crud->callback_before_insert(array($this,'before_insert_employee'));

        $output = $crud->render();
        $this->to_view($output);

    }


    public function bill_items(){
        $crud = $this->crud;
        $crud->set_subject("الأ صناف");
        $crud->set_table('bill_element');
        $crud->display_as('code','الكود');
        $crud->display_as('sizes','الأرقام');
        $crud->display_as('room','غرفة التخزين');
        $crud->display_as('note','ملاحظات');
        $crud->display_as('price','السعر');
        $crud->display_as('name_','النوع');
        $crud->display_as('quantity','الكمية');
        //	$crud->columns('employee_id', 'software_name','software_description');
        //$crud->fields("TICKET", 'LINE', 'product','price');

//        $crud->unset_back_to_list();


        //$crud->add_fields('employee_id','needed_software','software_description');
        //$crud->set_relation('room','room','name');
        //$crud->set_relation('name_','names','name_');
        //$crud->set_relation('employee_id_by_ip','employee','employee_name');

        //if($this->get_ip_address()!="127.0.0.1" and $this->get_ip_address()!="::1" and $this->get_ip_address()!="172.16.10.59" and $this->get_ip_address()!="172.16.10.69")
        //$crud->unset_list();

        /*
        try{
    $crud->render();
} catch(Exception $e) {
    show_error($e->getMessage());
}*/
        //$crud->set_theme('datatables');

        ///////////////
        $crud->callback_after_insert(function(){
            print "<script type='text/javascript'>alert('شكرا،، تم إرسال طلبك');</script>";
        });
        //////////////////////////

//        return $crud;
        $output = $crud->render();

        $this->to_view($output);
        //return $output;
    }
	 /**
  * Retrieves the best guess of the client's actual IP address.
  * Takes into account numerous HTTP proxy headers due to variations
  * in how different ISPs handle IP addresses in headers between hops.
  */
 public function get_ip_address() {
  // Check for shared internet/ISP IP
  if (!empty($_SERVER['HTTP_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_CLIENT_IP']))
   return $_SERVER['HTTP_CLIENT_IP'];

  // Check for IPs passing through proxies
  if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
   // Check if multiple IP addresses exist in var
    $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
    foreach ($iplist as $ip) {
     if ($this->validate_ip($ip))
      return $ip;
    }
   }
  
  if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_X_FORWARDED']))
   return $_SERVER['HTTP_X_FORWARDED'];
  if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
   return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
  if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
   return $_SERVER['HTTP_FORWARDED_FOR'];
  if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_FORWARDED']))
   return $_SERVER['HTTP_FORWARDED'];

  // Return unreliable IP address since all else failed
  return $_SERVER['REMOTE_ADDR'];
 }

 /**
  * Ensures an IP address is both a valid IP address and does not fall within
  * a private network range.
  *
  * @access public
  * @param string $ip
  */
 public function validate_ip($ip) {
     if (filter_var($ip, FILTER_VALIDATE_IP, 
                         FILTER_FLAG_IPV4 | 
                         FILTER_FLAG_IPV6 |
                         FILTER_FLAG_NO_PRIV_RANGE | 
                         FILTER_FLAG_NO_RES_RANGE) === false)
         return false;
     self::$ip = $ip;
     return true;
 }





    public function fees(){
        $crud = $this->crud;
        $crud->set_subject("المصاريف اليومية");
        $crud->set_table('fees');
        $crud->display_as('fee_id','رقم');
        $crud->display_as('fee_date','التاريخ');
        $crud->display_as('user_id','الموظف');
        $crud->display_as('fee_text','المصروف');

        $crud->display_as('fee_price','التكلفة');


        $crud->add_fields(array('fee_text','fee_price','fee_date','user_id'));
        $crud->edit_fields(array('fee_text','fee_price','fee_date','user_id'));

        $crud->set_relation('user_id','employee','employee_name');


        $crud->change_field_type('fee_date','invisible');
        $crud->change_field_type('user_id','invisible');

        $crud->unset_delete();
        $crud->unset_edit();

        $crud->set_lang_string('insert_success_message',
            'تمت إضافة الصنف بنجاح
		 
		 <div style="display:none">
		 '
        );


        $crud->callback_before_insert(array($this,'insert_fee'));

        $output = $crud->render();

        $this->to_view($output);
        //return $output;
    }

    function insert_fee($post_array) {
        //$this->load->library('encrypt');
       // $key = 'super-secret-key';
      //  $post_array['password'] = $this->encrypt->encode($post_array['password'], $key);

        $post_array['fee_date'] = date('Y-d-m');
        $post_array['user_id'] = $this->session->userdata['emp']['id'];
        //print '<script> console.log("'.var_dump($post_array).'");</script>';

        //exit;
        return $post_array;
    }
}
 
/* End of file main.php */
/* Location: ./application/controllers/main.php */
 
 