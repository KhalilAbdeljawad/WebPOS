<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
	<title>
		Pos Sys
	</title>
	<link type="text/css" rel="stylesheet" href="<?php print base_url()."assets/admin-custom.css"?>" />


	<?php

	if(isset($css_files)){
	foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>

		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; }?>


	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/w2ui/w2ui.css"?> />
	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/css/buttons_style.css"?> />
<!--	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">-->


	<script src="<?php print base_url()."assets/jquery.js"?>"></script>
	<script src="<?php print base_url()."assets/w2ui/w2ui.js"?>"></script>
	<script src="<?php print base_url()."assets/js/helper.js"?>"></script>


	<!--  Menu bar and notification -->
	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/css/menu_bar.css"?> />
	<script src="<?php print base_url()."assets/js/notification.js"?>"></script>

	<!-- for numpad -->
	<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
	<!-- Bootstrap -->



	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/css/bootstrap.min.css"?> />
	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/css/bootstrap-theme.min.css"?> />
	<link rel="stylesheet" type="text/css" href=<?php print base_url()."assets/css/jquery.numpad.css"?> />

	<!--	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">-->

	<script src="<?php print base_url()."assets/js/bootstrap.min.js"?>"></script>
	<script src="<?php print base_url()."assets/js/jquery.numpad.js"?>"></script>


	<style type="text/css">
		.nmpd-grid {border: none; padding: 20px}
		.nmpd-grid>tbody>tr>td {border: none;}

		/* Some custom styling for Bootstrap */
		.qtyInput {display: block;
			width: 100%;

			padding: 6px 12px;
			color: #555;
			background-color: white;
			border: 1px solid #ccc;
			border-radius: 4px;
			-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
			-webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
			transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
		}
	</style>


	<style>


	 *{
		font-size:18px;

	 }



	button{

		width:1%;
		font-size: 48px;
		height:50px;

		margin: 10px;
	}

	.btntext{
		color: #0066FF;;
		font-size: 56px;
		line-height: 30px;
	}


	#pos_keypad{

		height: 400px;
		padding:20px;
	}

	.space{
		margin: 10px;

	}

	#grid{
		overflow-y: auto;
		overflow-x: hidden;
	}


    #results_table td, th{

        width: 200px;
        text-align: center;
        padding: 10px;
    }

     #result_table td, th{

         width: 200px;
         text-align: center;
         padding: 15px;
     }

     .report-btn{
		width: 100px;
	}


     @media screen
     {
         #receipt{
             width: 166mm;
         }

         *{

             margin: 0px;
             padding: 0px;
         }
     }

     @media print
     {
		 #navbar, #ulnavbar{
			 display: none;
		 }
         #receipt{
             width: 400px;

         }


         *{

             margin: 0px;
             padding: 0px;
         }
         body{
             direction: rtl;

             margin: 0px;
             padding: 0px;
         }
     }
     @media screen, print
     {
         p.bodyText {font-size:10pt}
     }
</style>






</head>
<body dir="rtl">

<!-- Menu bar -->
<div id="navbar">
	<ul id="ulnavbar">
		<li><a href="<?php print base_url()."pos"?>">الرئيسية</a></li>
		<li><a href="<?php print base_url()."handle_pos/bills"?>">الفواتير</a></li>
        <?php if($priv=='manager'){?>
		<li><a href="<?php print base_url()."Crud/item"?>">الأصناف</a></li>
        <?php }?>

		<li><a href="<?php print base_url()."Reports"?>">التقارير</a></li>

        <?php if($priv=='manager'){?>
        <li><a href="<?php print base_url()."Crud/employee"?>">الموظفون</a></li>
<?php }?>
        <li><a href="<?php print base_url()."login/logout"?>">خروج</a></li>


		<li ><a href="#" ></a></li>
		<li id="noti_Container">
			<div id="noti_Counter"></div>   <!--SHOW NOTIFICATIONS COUNT.-->

			<!--A CIRCLE LIKE BUTTON TO DISPLAY NOTIFICATION DROPDOWN.-->
			<div id="noti_Button"  style="background-color: red"></div>

			<!--THE NOTIFICAIONS DROPDOWN BOX.-->
			<div id="notifications" >
				<h3>تنبيهات</h3>
				<div id="noti_text" style="height:300px;overflow-y: auto;">

				</div>
<!--				<div class="seeAll"><a href="#">See All</a></div>-->
			</div>
		</li>
		<li><a href="#"></a></li>
	</ul>
</div>
<!--/////////////////////-->
