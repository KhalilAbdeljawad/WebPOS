<?php
include 'header.php';
?>


<center>

    <div class="w2ui-field" id="dates">

        <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;كود الصنف <input id="code" type="text"></div>
        <br />
            &nbsp; من<input id="date1" type="date1"> إلى <input id="date2" type="date1"> </div>
        <button id="make_report" class="btn" style="width: 100px"  onclick="makeReport()">إنشاء التقرير</button>

    </div>

    <div id="results" align="center" style="text-align: center;border: solid 0px;width:500px;margin: 100px;overflow:hidden">
        <div>تقرير الإجمالي</div>
        <br />
        <table id="result_table" border="1" style="border: 1px #2a62bc solid;border-collapse: collapse">
<tr>
<th>كود الصنف</th><th>السعر</th><th>الكمية</th><th>التاريخ</th>
</tr>        <?php

            $total=0;
            $qu = 0;
            foreach ($item as $data){
                ?>
            <tr><td><?php print $data->item ?></td>
            <td><?php $total+=$data->price; print $data->price ?></td>
            <td><?php $qu+=$data->quantity; print $data->quantity ?></td>
            <td><?php print $data->_date ?></td>

                </tr>
        <?php }?>

            <tr><td>الإجمالي:</td>
                <td><?php print $total ?></td>
                <td><?php print $qu ?></td>
                <td></td>
    </table>
    </div>
    <button id="print" class="btn" onclick="printRep()">طباعة</button>
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
        window.location="<?php print base_url()?>Reports/item_sales/"+$("#code").val()+"/"+$("#date1").val()+"/"+$("#date2").val()
    }
    //})

    $(function () {
        var month = (new Date()).getMonth() + 1;
        var year  = (new Date()).getFullYear();


        $('input[type=date1]').w2field('date', { format: 'yyyy-mm-dd'});

    });
</script>

<?php
//var_dump($data);

?>