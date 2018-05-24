<?php
/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 9/6/2016
 * Time: 12:03 PM
 */

include "header.php";


?>
<center>

    <div style="margin-top: 120px">
        <a href="<?php print base_url()?>Reports/results"> <button class="btn" style="width: 150px;">تقرير إجمالي المبيعات</button></a>

        <a href="<?php print base_url()?>Reports/items_sales"> <button class="btn" style="width: 150px;">تقرير مبيعات الأصناف</button></a>


        <a href="<?php print base_url()?>Reports/item_sales"> <button class="btn" style="width: 150px;">تقرير مبيعات صنف معين</button></a>


<!--        <button class="btn" style="width: 100px;">تقرير المبيعات</button>-->
    </div>
</center>u