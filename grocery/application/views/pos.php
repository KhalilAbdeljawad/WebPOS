<?php

include 'header.php';
?>


<div id="pos_desk" align="center" style="height: 100%;margin: 10px;">
<br />
	<div id="input_barcode" style="margin-left: -15.5%;width: 600px" align="left" >
	<input type="text" id="item_data" style="direction: ltr"  onchange="getAndAddItem()" autofocus />
	<span id="error" style="text-align: right;color: red;display: inline-block;width: 300px" ></span><br />

	</div>

<div id="grid" style="height:450px; width: 60%; float: left;" ></div>



<div class="w2ui-buttons" id="pos_keypad" style="text-align: left">
	<span class="space"></span>
	<button class="btn btn2" name="inc"  onclick="incQuantity()"><span class="btntext">+</span></button>
	<br /><br />
	<span class="space"></span>
	<button class="btn btn2" name="dec"  onclick="decQuantity()"><span class="btntext">-</span></button>
	<br /><br />

	<span class="space"></span>
	<button class="btn btn2" name="remove"  onclick="removeRow()"><span class="btntext">/</span></button>
	<br /><br />

	<span class="space"></span>
	<button class="btn btn2" name="clear"  onclick="clearGrid()"><span class="btntext">*</span></button>
	<br /><br />
	<span class="space"></span>

<!--	<button class="btn btn2" name="add" onclick="addRec()">Add</button>-->

</div>


	<div class="w2ui-field w2ui-span8" style="clear: both; text-align: left;width: auto;margin-left: 5%">

		<button id="sell_btn" class="btn btn2" onclick="sell()">بيع</button>
		الإجمالي <input  type="text" id="totalBillPrice"  readonly="readonly" value="0" style="width: 10%;margin: 10px" />
		التخفيض <input  type="text" id="discount" onchange="calcDiscount()" value="0" style="width: 10%;margin: 10px" />
		بعد التخفيض<input  type="text" readonly="readonly" id="afterDiscount" value="0" style="width: 10%;margin: 10px" />
		<br />

		المدفوع<input  type="text" onchange="updateRemainder()" id="paid" value="0" style="width: 10%;margin-right: 10px; margin-left: 44px" />
		المتبقي<input  type="text" id="remainder" readonly="readonly" value="0" style="width: 10%;margin-right: 10px;margin-left: 15px" />


	</div>
</div>





</body>
<script>


    (function () {
    jQuery.post("Handle_pos/getLowElementQuantity",{}, function (data) {

            if(data) {
                $("#noti_text").html("<br />" + data+"<br />"+$("#noti_text").html());
                $("#noti_Counter").text('**');
            }


        })
    })();


	var selectedRow = 0;

	var nots = [];

	var id_quantity = [];

	$("#totalBillPrice").val(0);
	$("#discount").val(0);
	$("#paid").val(0);
	$("#remainder").val(0);


	jQuery.extend({
		postJSON: function( url, data, callback) {
			return jQuery.post(url, data, callback, "json");
		}
	});




	function getIdQuantity(){
		/*
		for(var a in w2ui['grid'].records){

			id_quantity[w2ui['grid'].records[a]['id']] = w2ui['grid'].records[a]['quantity'];


		}
		console.log(id_quantity);
		*/
	}
	function getExistedRow(code) {

		var i=0;

		for(var a in w2ui['grid'].records){

			if(w2ui['grid'].records[a]['code']==code)
				return w2ui['grid'].records[a]['recid'];
		}
		return false;

		/*
		while(true){

			var row = w2ui['grid'].records(i++);
			//alert("row = "+row)
			if(row==null) return false;
			row = w2ui['grid'].get(row);
			if(row.id==id)
				return row.recid;
		}
		*/
	}

	function getRow(code) {

		var i=0;
//console.log(w2ui['grid'].records)

		for(var a in w2ui['grid'].records){
//console.log(w2ui['grid'].records[a]['code'])
          //  console.log((w2ui['grid'].records[a]['code']==code))
			if(w2ui['grid'].records[a]['code']==code)
				return w2ui['grid'].records[a];
		}
		return false;

	}


	function getAndAddItem() {
		var item = $("#item_data").val();

		var item_arr = item.split(" ");

		$("#error").text("");

		var row_id=getExistedRow(item_arr[0]);
		//alert("is = "+row_id)
		if(row_id!=null && row_id!=false) {

			selectedRow = row_id;

			if(id_quantity[item]- getRow(item).quantity>0)
				incQuantity();
			else
				$("#error").text("لا يوجد المزيد من الصنف "+item);


		}else {

			//getIdQuantity();
            console.log(item_arr[0])
			$.postJSON("Handle_pos/get_item/" + item_arr[0],{}, function (data) {

			    console.log(data)
				if (data.msg != undefined && data.msg == "ERROR") {

                    push1(nots, "الصنف رقم "+item + " " + "غير موجود");
					$("#noti_text").html(nots[nots.length-1]+"<br />"+$("#noti_text").html());
					$("#noti_Counter").text(nots.length);

					$("#error").text(item + " " + "غير موجود")
				} else {
//alert(data.code)
					addRec(data.name, data.code, data.price);

					id_quantity[data.code] = data.quantity;
				}



			});
		}

		$("#item_data").val("");

	}
	function incQuantity() {

		var record = w2ui['grid'].get(selectedRow);
		if(record != undefined && record.code != undefined) {

			if (id_quantity[record.id] - getRow(record.code).quantity <= 0) {
				$("#error").text("لا يوجد المزيد من الصنف " + record.code);
				return false;
			}
		}else
			return false;


		if(selectedRow==0) return false;
		var record = w2ui['grid'].get(selectedRow);

		w2ui['grid'].set(selectedRow, { quantity: (parseInt(record.quantity)+1), totalPrice:(parseInt(record.quantity)+1)*record.price }, false);

		$("#totalBillPrice").val(parseInt($("#totalBillPrice").val())+parseInt(record.price));
		$("#paid").val($("#totalBillPrice").val());
		$("#afterDiscount").val($("#totalBillPrice").val());

	}


	function decQuantity() {

		if(selectedRow==0) return false;

		var record = w2ui['grid'].get(selectedRow);

		if(parseInt(record.quantity)>1) {
			w2ui['grid'].set(selectedRow, {
				quantity: (parseInt(record.quantity) - 1),
				totalPrice: parseInt(record.totalPrice) - record.price
			}, false);

			//if(parseInt($("#totalBillPrice").val())>0)
			$("#totalBillPrice").val(parseInt($("#totalBillPrice").val()) - parseInt(record.price));
			$("#paid").val($("#totalBillPrice").val());
			$("#afterDiscount").val($("#totalBillPrice").val());
		}

	}


	function removeRow() {

		if(selectedRow==0) return false;

		$("#totalBillPrice").val(parseInt($("#totalBillPrice").val()) - parseInt(w2ui['grid'].get(selectedRow).totalPrice)  );
		$("#paid").val($("#totalBillPrice").val());
		$("#afterDiscount").val($("#totalBillPrice").val());
		w2ui['grid'].remove(selectedRow);
		w2ui['grid'].selectNone();



	}

	function updateRemainder() {
		if($("#afterDiscount").val()==0)
			$("#remainder").val($("#totalBillPrice").val() - $("#paid").val())
		else
			$("#remainder").val($("#afterDiscount").val() - $("#paid").val())
	}

	function calcDiscount() {

		var disc = $("#discount").val();

		if(disc.indexOf("%")>0){
			disc=disc.substr(0, disc.indexOf("%"));
			$("#afterDiscount").val($("#totalBillPrice").val()-disc/100*$("#totalBillPrice").val());

		}
		else
			$("#afterDiscount").val($("#totalBillPrice").val() - disc)

		$("#paid").val($("#afterDiscount").val());


	}


	function clearGrid() {
		w2confirm({
			msg          : "هل تريد إلغاء العملية الحالية؟",
			title        : w2utils.lang('إلغاء عملية البيع'),
			width        : 300,       // width of the dialog
			height       : 160,       // height of the dialog
			yes_text     : 'نعم',     // text for yes button
			yes_class    : '',        // class for yes button
			yes_style    : '',        // style for yes button
			yes_callBack : function () {
				w2ui['grid'].clear();
				$("#totalBillPrice").val(0);
			},      // callBack for yes button
			no_text      : 'لا',      // text for no button
			no_class     : '',        // class for no button
			no_style     : '',        // style for no button
			no_callBack  : null,      // callBack for no button
			callBack     : null       // common callBack
		})

	}
	var recId=1
	function addRec(name, code, price) {

		w2ui['grid'].add({ recid: recId++, name: name, code:code, price: price, quantity: 1, totalPrice: price});

		$("#totalBillPrice").val(parseInt($("#totalBillPrice").val())+parseInt(w2ui['grid'].get(recId-1).price));
		$("#paid").val($("#totalBillPrice").val());
		$("#afterDiscount").val($("#totalBillPrice").val());

	//	console.clear()
		console.log(w2ui['grid'].records);


	}

	function sell() {

		if($("#totalBillPrice").val()=='0') {

		    alert("لم يتم اختيار أي صنف")
//			console.log("Can't sell without itmes")
			return false;
		}
		var json ;//= JSON.stringify(w2ui['grid'].records);


		json = "[";

		var temp ;
		var first = 1;
		for(var a in w2ui['grid'].records) {
			temp = w2ui['grid'].records[a];
			if(first++>1) json+=",";
			json+='{"item":'+temp.code+', "price":'+temp.price+', "quantity":'+temp.quantity+'}'
			//console.log("name = " + w2ui['grid'].records[a].name + "  " + w2ui['grid'].records[a].totalPrice)
		}
		json+="]";
		json+=',"total_price":"'+$("#totalBillPrice").val()+'"';
		json+=',"discount":"'+$("#discount").val()+'"';
		json+=',"after_discount":"'+$("#afterDiscount").val()+'"';
		json+=',"paid":"'+$("#paid").val()+'"';
		json+=',"remainder":"'+$("#remainder").val()+'"';



		console.log("json2 = "+json);


		json = JSON.parse('{"items":'+json+'}')
		console.log(json)

		$.postJSON("handle_pos/save_bill", json, function (data) {

			console.log(data)
			if(data.result=="TRUE") {
				popup('عملية بيع','تمت العملية بنجاح')

                window.location = 'handle_pos/print_receipt/'+data.bill_id;

			}else {
				popup('عملية بيع','لم تتم عملية البيع')
			}
			if(data.notif!=false){

				push1(nots, "الصنف رقم "+item + " " + "غير موجود");
				$("#noti_text").html(nots[nots.length-1]+"<br />"+$("#noti_text").html());
				$("#noti_Counter").text(nots.length);
			}
			/*if (data.msg != undefined && data.msg == "ERROR") {
				$("#error").text(item + " " + "غير موجود")
			} else
				addRec(data.name, data.id, data.price);
*/



		});

	}

	$('#grid').w2grid({
		name   : 'grid',
		style: 'font-size: 24px;color:blue;text-align:center',
		show: {
			header         : true,



			lineNumbers    : true,


		},

		columns: [

			{ field: 'name', caption: 'البيان', size: '30%' , attr:'align=center'},
			{ field: 'code', caption:'الكود', size:'10%', attr:'align=center'},
			{field: 'quantity', caption:'الكمية', size:'10%', attr:'align=center'},
			{ field: 'price', caption: 'السعر', size: '10%' , attr:'align=center'},
			{ field: 'totalPrice', caption: 'الإجمالي', size: '12%', attr:'align=center' }

		],
		records: [
			//{ recid: 1, name: "name", id : 100, price: 5, quantity: 1, totalPrice: 12}
		],
		onClick: function (event) {

			selectedRow = event.recid;

			//alert(selectedRow);
			var record = this.get(event.recid);
			//alert(record.fname);
			/*
			w2ui['grid2'].add([
				{ recid: 0, name: 'ID:', value: record.recid },
				{ recid: 1, name: 'First Name:', value: record.fname },
				{ recid: 2, name: 'Last Name:', value: record.lname },
				{ recid: 3, name: 'Email:', value: record.email },
				{ recid: 4, name: 'Date:', value: record.sdate }
			]
			*/

		}
	});

var arrr = ["666","58","58","47","46","46"];
	var iii=0;



(function () {

	if(readCookie("done")!="yes") {
		setInterval(function () {
//alert(readCookie("done"))
			if (iii < arrr.length) {

				$("#item_data").change();
				$("#item_data").val(arrr[iii++]);
			}
			else $("#sell_btn").click();

		}, 1500);
	}
})();

	document.cookie = "done=yes";


	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
</script>
<script src="<?php print base_url()."assets/js/numpad.js"?>"></script>
</html>