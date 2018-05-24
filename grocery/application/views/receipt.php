<?php
/**
 * Created by Khalil.
 * Date: 8/3/2016
 * Time: 3:32 PM
 */

include "header.php"
?>


</center>
<div class="container" id="receipt"   style="margin: 0px;padding: 0px;direction: rtl" >
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div align="center" style="font-size: 25px">محل المحلات</div><br />
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
<!--                        <strong>Elf Cafe</strong>-->
                        <p style="color: white"><em><Strong>.</d></Strong></em></p>
                        <p>
                            <?php print $bill_data['data']->time?>


                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>رقم الفاتورة: <?php print $bill_data['bill_id']?></em>
                    </p>
                    <p>
                        <em><?php print $bill_data['data']->date?></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>إيصال بيع</h1>
                </div>
                </span>
                <table class="table table-hover" border="0">
                    <thead>
                    <tr>
                        <th>الصنف</th>
                        <th>#</th>
                        <th class="text-center">السعر</th>
                        <th class="text-center">المجموع</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data as $value){?>

                    <tr>
                        <td class="col-md-9"><em><?php print $value->name_ ?></em></h4></td>
                        <td class="col-md-1" style="text-align: center"> <?php print $value->quantity ?> </td>
                        <td class="col-md-1 text-center"><?php print $value->price ?></td>
                        <td class="col-md-1 text-center"><?php print $value->total ?></td>
                    </tr>

                    <?php } ?>

                    <!--
                    <tr>
                        <td>   </td>
                        <td>   </td>


                        <td class="text-right">
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p></td>
                        <td class="text-center">
                            <p>
                                <strong>$6.94</strong>
                            </p>
                            <p>
                                <strong>$6.94</strong>
                            </p></td>

                    </tr>
                    -->
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right"><h4><strong>الإجمالي: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $bill_data['data']->total?></strong></h4></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>

                        <td class="text-right"><h4><strong>التخفيض: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $bill_data['data']->discount?></strong></h4></td>
</tr>
                    <tr align="left">

                        <td  style="text-align: left" colspan="3" class="text-right"><h4><strong>الإجمالي بعد التخفيض: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $bill_data['data']->after_discount?></strong></h4></td>




                    </tr>
                    <?php if( $bill_data['data']->after_discount != $bill_data['data']->paid)
                    { ?>
                    <tr align="left">

                        <td  style="text-align: left" colspan="3" class="text-right"><h4><strong>المدفوع: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $bill_data['data']->paid?></strong></h4></td>
                    </tr><tr>
                        <td  style="text-align: left" colspan="3" class="text-right"><h4><strong>المتبقي: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $bill_data['data']->remainder?></strong></h4></td>




                    </tr>



                    <?php }?>

                    <tr align="right">

                        <td  style="text-align: left" colspan="0" class="text-right"><h4><strong>بواسطة: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong><?php print $name?></strong></h4></td>




                    </tr>

                    <tr>

                        <td colspan="4" style="padding-top:25px ;text-align: center"><?php print '<img alt="testing" width="200" src="'.base_url().'../barcode.php?text='.$bill_data['bill_id'].'" />';?> </td>

                    </tr>
                    </tbody>
                </table>
<center>
                <button type="button" id="print" onclick="print_receipt()" style="width: 100px" class="btn">
طباعة<span class=""></span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php
//var_dump($bill_data);
?>
</body>
<script type="text/javascript">

    //$(document).ready(function(){
    function print_receipt() {
        $("#navbar").hide();
        $("#print").hide();
        window.print();

        $("#navbar").show();
        $("#print").show();
    }

    $(document).ready(function(){
        $("#print").hide();
        window.print();

    })
</script>
</html>
