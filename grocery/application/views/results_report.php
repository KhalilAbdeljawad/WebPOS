<?php
include 'header.php';
?>


<center>

    <div class="w2ui-field" id="dates">

        <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp; من<input id="date1" type="date1"> إلى <input id="date2" type="date1"> </div>
        <button id="make_report" class="btn" style="width: 100px"  onclick="makeReport()">إنشاء التقرير</button>

    </div>


    <div id="results" align="center" style="text-align: center;border: solid 0px;width:400px;height: 400px;margin: 100px;overflow:hidden">
        <div>تقرير الإجمالي</div>
        <br />
        <table id="results_table" border="1" style="border: 1px #2a62bc solid;border-collapse: collapse">

            <tr><td>الإجمالي</td><td><?php print $data->total ?></td></tr>
            <tr><td>الإجمالي بعد التخفيض</td><td><?php print $data->after_discount ?></td></tr>
            <tr><td>المدفوع</td><td><?php print $data->paid ?></td></tr>
            <tr><td>المتبقي</td><td><?php print $data->remained ?></td></tr>
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
        window.location="<?php print base_url()?>Reports/results/"+$("#date1").val()+"/"+$("#date2").val()
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