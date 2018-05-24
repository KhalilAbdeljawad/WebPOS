<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
 
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
 
<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}

a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover*
{
    text-decoration: underline;
}

div{
	direction: rtl;
}



</style>
<link type="text/css" rel="stylesheet" href="<?php print base_url()."assets/admin-custom.css"?>" />

</head>
<body>
<!-- Beginning header 
    <div>
        <a href='<?php echo site_url('examples/offices_management')?>'>Offices</a> | 
        <a href='<?php echo site_url('examples/employees_management')?>'>Employees</a> |
        <a href='<?php echo site_url('examples/customers_management')?>'>Customers</a> |
        <a href='<?php echo site_url('examples/orders_management')?>'>Orders</a> |
        <a href='<?php echo site_url('examples/products_management')?>'>Products</a> | 
        <a href='<?php echo site_url('examples/film_management')?>'>Films</a>
 
    </div>
<!-- End of header-->
	
    <div align='center' style='height:20px;font-size:28px;height:160px'>
    
    <br /><br />
    منظومة</div>  
    <br /><br />
    <div>
        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
<div></div>
<!-- End of Footer -->
</body>
</html>