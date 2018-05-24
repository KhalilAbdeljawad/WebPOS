<?php
include 'header.php';
?>


<center>

<!--    <div class="w2ui-field" id="dates">-->
<!---->
<!--        <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--            &nbsp; من<input id="date1" type="date1"> إلى <input id="date2" type="date1"> </div>-->
<!--        <button id="make_report" class="btn" style="width: 100px"  onclick="makeReport()">إنشاء التقرير</button>-->
<!---->
<!--    </div>-->

<br />
    <div id="results" align="center">
        <div>تقرير مبيعات الأصناف</div>
        <br />
        <table id="results_table" border="1" style="border: 1px #2a62bc solid;border-collapse: collapse">
            <tr>
                <th>الصنف</th>
                <th>الكود</th>
                <th>مجموع المبيعات</th>
                <th>نسبة المبيعات</th>
            </tr>
            <?php foreach ($data as $value){?>
            <tr>
                <td><?php print $value->id ?></td>
                <td><?php print $value->code ?></td>
                <td><?php print $value->total_price ?></td>
                <td><?php print $value->percentage ?></td></tr>
            <?php }?>
        </table>
        <br /><br />
        <button id="print" class="btn" onclick="printRep()">طباعة</button>
    </div>


</center>
<script type="text/javascript">

    //$(document).ready(function(){
    function printRep() {
        $("#navbar").hide();
        $("#print").hide();
        $("#dates").hide();
        window.print();

        $("#navbar").show();
        $("#print").show();
        $("#dates").show();
    }

    function makeReport() {

        //alert("Reports/result/"+$("#date1").val()+"/"+$("#date2").val())
        window.location="<?php print base_url()?>Reports/item_sales/"+$("#date1").val()+"/"+$("#date2").val()
    }
    //})

    $(function () {
        var month = (new Date()).getMonth() + 1;
        var year  = (new Date()).getFullYear();


        $('input[type=date1]').w2field('date', { format: 'yyyy-mm-dd'});

    });
</script>

