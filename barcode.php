<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body>
	<div style="margin-left: 5%">
		<?php
		include 'barcode128.php';
		$product = $_POST['product'];
		$product_id = $_POST['product_id'];
		$rate = $_POST['rate'];

		for($i=1;$i<=$_POST['print_qty'];$i++){
			echo "<p class='inline'><span ><b>Item: $product</b></span>".bar128(stripcslashes($_POST['product_id']))."<span ><b>Price: ".$rate." </b><span></p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>