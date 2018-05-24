<?php
include 'header.php';
?>


<div style="position: relative; height: 300px;">


    <div id="bill_details" style="position: absolute; top:70%; ; left: 0px;width: 49.9%; height: 300px; direction: rtl"></div>
    <div id="grid1" style="position: absolute; right:  0px; width: 49.9%; height: 300px; direction: rtl;"></div>
    <div id="layout" style="position: absolute;width: 50%; left: 0px;  height: 200px; direction: rtl"></div>

    <div id="buttons" class="w2ui-buttons" style="position: absolute; right:  300px; top: 400px; width: 20.9%; height: 300px; direction: rtl">
        <button id="return" class="btn" style="margin-left: 50px" onclick="return_item()"   >إرجاع</button>
        <button id="replace" class="btn" onclick="getSelectedRows()"  >استبدال</button>
        <br /><br />
        <button id="print_receipt" class="btn" style="width: 210px" onclick="print_receipt()"  >طباعة الإيصال</button>
    </div>
</div>



    <div id="pos_desk" align="center" style="border: solid 0px;display:none;width:400px;height: 400px;margin: 100px;overflow:hidden">
        <br /><br />
        <div id="input_barcode" style="margin-right: 40px;width: 300px;text-align: center" align="center" >
            <input type="text" autofocus id="item_data" style="direction: ltr;text-align: center"   onchange="getAndAddItem()"  />
            <br />
            <div id="ret_item" style="margin-top: 50px;border: solid 0px; height: auto"></div>
            <br /><br />
            <button id="close_pos_desk" class="btn" onclick="replace_item()" >استبدال</button>


        </div>


    </div>


<script type="text/javascript">


    function print_receipt() {

        if(bill == undefined || bill == '')
        bill = w2ui['grid1'].last.search;


        if(bill == undefined || bill == '') alert('لم يتم البحث عن فاتورة')
        else {
            window.location = 'print_receipt/'+bill;
        }

    }
    function ret_table(header, data) {
        var table = "<center><table style='width: 100%'><tr>";
        for(key in header)
            table+="<th style='text-align: center'>"+header[key]+"</th>";

        table+="</tr><tr>";
        //for(var key in data)
            table+="<td style='text-align: center;margin: 20px;padding: 20px'>"+data['name']+"</td><td style='text-align: center'>"+data['price']+"</td>";

        table+="</tr></table><center>   ";

        return table;


    }

    function  return_item() {

        bill_item = w2ui['bill_details'].getSelection();
        item_data = w2ui['bill_details'].records[selectedRow];

        bill = w2ui['grid1'].getSelection();

        if(bill == '' || bill_item == '')
            alert("يجب اختيار فاتورة وعنصر مبيعات أولا");




        if( item_data == undefined)
        {
            alert('لم يتم اختيار العنصر المرجع');
            return;
        }

        console.log(item_data)
        console.log(item_data['code'])
        console.log("return_item/" + bill+"/"+item_data['code']+"/"+item_data['price']);
        $.postJSON("return_item/" + bill+"/"+item_data['code']+"/"+item_data['price'],{}, function (data) {

            console.log(data)
            console.log(data.msg)
            if (data.msg != undefined && data.msg == "ERROR") {

                //  alert("Error")
                $("#w2ui-popup  #ret_item").html("خطأ، لم يتم إرجاع الصنف");


            } else {

                alert("تم إرجاع الصنف بنجاح")
                console.log(data);
                w2popup.close();
            }



        });





    }

    function replace_item(){

/*
        console.log(bill+"  "+bill_item+"   "+selectedRow)
        console.log(item_data)

*/

      //  item_data = w2ui['bill_details'].records[selectedRow];

        console.log(item_data)
        if( item_data == undefined)
        {
            alert('لم يتم اختيار العنصر المستبدل');
            return;
        }

        $.postJSON("replace_item/" + bill+"/"+item_data['code']+"/"+item_data['price']+"/"+$("#w2ui-popup #item_data").val()+"/"+new_item_price,{}, function (data) {

            console.log(data)
            if (data.msg != undefined && data.msg == "ERROR") {

              //  alert("Error")
                $("#w2ui-popup  #ret_item").html("خطأ، لم يتم استبدال الصنف");


            } else {

                alert("تم استبدال الصنف بنجاح")
                console.log(data);
                w2popup.close();
            }



        });



    }
    function getAndAddItem() {


        var item = $("#w2ui-popup #item_data").val() ;

        var item_arr = item.split(" ");



        {


            $.postJSON("get_item/" + item_arr[0],{}, function (data) {

                if (data.msg != undefined && data.msg == "ERROR") {

                    $("#w2ui-popup  #ret_item").html("لا يوجد صنف بهذا الرقم");


                } else {

                    console.log("Here :");

                    new_item_price = data.price;
                    console.log(new_item_price);
                     var table = ret_table(["البيان","السعر",], data);
                    $("#w2ui-popup #ret_item").html(table);

                }



            });
        }

        //$("#item_data").val("");

    }


    var selectedRow = -1;
    $(function () {


        $('#bill_details').w2grid({

            header: 'Details',
            show: { header: true, columnHeaders: true },
            name: 'bill_details',
            columns: [
                { field: 'recid', caption: '#', size: '50px', sortable: true, attr: 'align=center' },
                { field: 'code', caption: 'كود', size: '50px', sortable: true, attr: 'align=center' },
                { field: 'item', caption: 'البيان', size: '100px',  attr: "align=right" },
                { field: 'price', caption: 'السعر', size: '100px' },
                { field: 'quantity', caption: 'الكمية', size: '100px' }
            ],

            onClick: function (event) {
              //  alert("Rec id = "+event.recid)


                selectedRow = event.recid-1;
               // console.log(w2ui['bill_details'].records[selectedRow])
             //   console.log($('#bill_details').records[selectedRow])
            }
            });


        $('#grid1').w2grid({
            name: 'grid1',
            header: 'الفواتير',
            show: { header: true , toolbar:true, footer:true},
            searches:[{field:"recid", type:'int'}],
            columns: [
                { field: 'recid', caption: 'رقم الفاتورة', size: '100px', sortable: true, attr: 'align=center' },
                // { field: 'id', caption: 'ID', size: '50px', sortable: true, attr: 'align=center' },
                { field: '_date', caption: 'التاريخ', size: '30%', sortable: true },
                { field: 'total_price', caption: 'الإجمالي', size: '30%', sortable: true },
                { field: 'paid', caption: 'المدفوع', size: '40%' }

            ],
            records:
                [ //{ recid: "115", _date: 'John', total_price: 'doe', paid: 'jdoe@gmail.com'},
                    //{ recid: "155", _date: 'John', total_price: 'doe', paid: 'jdoe@gmail.com'},
                    //{ recid: "255", _date: 'John', total_price: 'doe', paid: 'jdoe@gmail.com'}

                ]// bills
            ,
            onClick: function (event) {

                var record = this.get(event.recid);
                bill = event.recid;
                var discount = record.discount;
                if(discount!=0 && record.total_price - record.discount != record.after_discount)
                    discount="%"+discount;
                var table = "<table style='width: 100%'><tr>" +
                    "<td style='width: 15%'>الإجمالي</td><td style='width: 15%'>" + record.total_price+"</td>"+
                    "<td style='width: 15%'>التخفيض</td><td style='width: 15%'>" +  discount+"</td>"+
                    "<td style='width: 25%'>الإجمالي بعد التخفيض</td><td style='width: 15%'>" + record.after_discount+"</td>"+
                    "</tr><tr>"+
                    "<td>المدفوع</td><td>" + record.paid+"</td>"+
                    "<td>المتبقي</td><td>"+record.remainder+ "</td></tr></table>"
                w2ui['layout'].content('top', table)

                w2ui['bill_details'].header = 'أصناف الفاتورة رقم '+event.recid;

                console.log("get_bill_elements/" + event.recid)
                $.postJSON("get_bill_elements/" + event.recid ,{}, function (data) {
                    console.log(data)
                    if (data.msg != undefined && data.msg == "ERROR") {
                        alert("Nooooooooooo")
                    } else {
                        //     console.log(data)

                        w2ui['bill_details'].clear();
                        //var record = this.get(event.recid);
                        console.log(data)
                        w2ui['bill_details'].add(data);
                        //   addRec(data.name, data.id, data.price);
                        // id_quantity[data.id] = data.quantity;
                    }



                });



            },
            onSearch : function (event) {
                //alert("Hay")
                console.log(event.searchData[0].value)
                w2ui['grid1'].click(event.searchData[0].value);
            },
            onChange : function (event) {
                alert("Way")

            }
        });

    });


    function show_pos() {
            $('#pos_desk').w2popup();

        var winH = $("#w2ui-popup #input_barcode").height();
        var winW = $("#w2ui-popup #input_barcode").width();
        //Set the popup window to center
        $("#w2ui-popup #input_barcode").css('top',  winH/2-$("#w2ui-popup #input_barcode").height()/2);
        $("#w2ui-popup #input_barcode").css('left', winW/2-$("#w2ui-popup #input_barcode").width()/2);


        $("#w2ui-popup #item_data").focus() ;



    }

    var bill;
    var bill_item;
    var item_data = [];

    var new_item_price=0;


    function getSelectedRows() {
        bill_item = w2ui['bill_details'].getSelection();
        item_data = w2ui['bill_details'].records[selectedRow];
        console.log(bill_item)

        bill = w2ui['grid1'].getSelection();
        console.log(bill)


        if(bill == '' || bill_item == '')
            alert("يجب اختيار فاتورة وعنصر مبيعات أولا")
        else {
            console.log('bill = ' + bill + '  bill item = ' + bill_item)
            show_pos()
        }
    }

    $.postJSON("get_bills/"+"0",{}, function (data) {
        if (data.msg != undefined && data.msg == "ERROR") {
            alert("Nooooooooooo")
        } else {

            w2ui['grid1'].add(data);

            //   console.log(data)
            //addRec(data.name, data.id, data.price);
            //id_quantity[data.id] = data.quantity;
        }



    });



    $(function () {
        var pstyle = 'border: 1px solid #dfdfdf; padding: 5px;';
        $('#layout').w2layout({
            name: 'layout',
            panels: [
                { type: 'top', size: 200, resizable: true, style: pstyle, content: ''	, title: 'بيانات الفاتورة' },

            ]
        });
    });


</script>



</body>
</html>