 
 
<script>

function print_page(){
	
	document.getElementById("btnn").style.display = 'none';
	window.print();
	document.getElementById("btnn").style.display = 'block';
}
</script>

 <?php
 
 $text = isset($_GET['text']) ? $_GET['text'] : "";
 
print '<img id="barcode" alt="barcode" width="200" style="margin-left:-15px;" height="70" src="barcode.php?text='.$text.'" />';




?>

<br />

<br />

<br />

<button style="margin-left:35px;width:100px; height:70" class="btn" id='btnn' onclick='print_page()'>طباعة</button>
