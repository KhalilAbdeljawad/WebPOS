<?php
include 'header.php';
?>
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

        *,td, th{

            font-family: Arial;
            font-size: 16px;
        }

        a {
            color: blue;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover
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
    <div align='center' style='height:20px;font-size:28px;height:160px; direction: rtl'>
   
    <div>
        <?php echo $output; ?>
 
    </div>
<!-- Beginning footer -->
</div>
<!-- End of Footer -->
</body>
</html>