<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet" type="text/css">
	<link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
	
    <title>Order</title>
	<script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>
</head>
<body>

  <!-- Top Navbar -->
 <?php
	include('Navbar.php');
	
	if((isset($_SESSION['userIDX'])) and (isset($_POST['orderAmount']))){
		$orderuID = $_SESSION['userIDX'];
		$orderAmt = 0;
		$orderQty = 0;
		include 'db.php';
		$getCustomerQuery = "SELECT NAME AS NAME, CITY AS CITY, PINCODE AS PIN FROM CUSTOMER WHERE ID = '$orderuID';"; 
		$cRes = mysqli_query($dbc,$getCustomerQuery);
		$n = mysqli_num_rows($cRes);
		if($n!=0){
			$cData = mysqli_fetch_array($cRes);
			$cName = $cData['NAME'];
			$cCity = $cData['CITY'];
			$cPin = $cData['PIN'];
			$orderDate = date("d-m-Y");
			$deliveryDate = date('d-m-Y', strtotime($orderDate. ' + 4 days'));
			$currentTimeInMS = round(microtime(true) * 1000);
			$orderID = '#F'.$orderuID.'T'.$currentTimeInMS;
			
			$cartQuery = "SELECT PRODUCT_ID AS PID, QUANTITY AS QTY, PRICE AS UNIT_PRICE FROM CART C JOIN PRODUCTS P ON C.PRODUCT_ID = P.ID WHERE CUSTOMER_ID = '$orderuID'";
			$cartRes = mysqli_query($dbc,$cartQuery);
			$count = mysqli_num_rows($cartRes);
			$orderQty = $count;
			if($count!=0){
				while($row=mysqli_fetch_array($cartRes)){
					$pID = $row['PID'];
					$qty = $row['QTY'];
					$unitPrice = $row['UNIT_PRICE'];
					$iPrice = $unitPrice * $qty;
					$orderAmt+= $iPrice;
					$orderQuery = "INSERT INTO ORDERS (ORDER_ID, CUSTOMER_ID, PRODUCT_ID, QUANTITY, UNIT_PRICE, TOTAL_PRICE) VALUES('$orderID', '$orderuID', '$pID', '$qty', '$unitPrice', '$iPrice' );";
					$oRes = mysqli_query($dbc,$orderQuery);

					if($oRes){
						$cartEmptyQuery = "DELETE FROM CART WHERE CUSTOMER_ID = '$orderuID';";
						$rs = mysqli_query($dbc,$cartEmptyQuery);
						if($rs){
							//
						}
						else{
							echo "<script>alert('Cart Record not Deleted')</script>";
						}
					}
					else{
						echo "<script>alert('Order Record not Inserted')</script>";
					} 		
				}
			}
			else{
				header('location:Cart.php');
			}		
		}
	}
	else{
		header('location:Login.php');
	}	
		
  ?>
	<br>
  <center>
	

	<table border="1" cellpadding=5>
		<tr>
			<th colspan="2" style="font-size:30px" title="ORDER INVOICE" onclick="speak(this.title)">ORDER INVOICE</th>
		</tr>
		<tr>
			<td width="55%" title="Order ID" onclick="speak(this.title)">Order ID</td>
			<td width="45%" align="right" title="<?php echo$orderID;?>" onclick="speak(this.title)"><?php echo $orderID; ?></td>
		</tr>
		<tr>
			<td width="70%" title="Customer Name" onclick="speak(this.title)">Customer Name</td>
			<td width="30%" align="right" title="<?php echo$cName;?>" onclick="speak(this.title)"><?php echo$cName;?></td>
		</tr>
		<tr>
			<td width="70%" title="Total Amount" onclick="speak(this.title)">Total Amount</td>
			<td width="30%" align="right" title="Rs. <?php echo $orderAmt;?>" onclick="speak(this.title)">Rs. <?php echo$orderAmt;?></td>
		</tr>
		<tr>
			<td width="70%" title="Number of Items" onclick="speak(this.title)">No. of Items</td>
			<td width="30%" align="right" title="<?php echo $orderQty;?>" onclick="speak(this.title)"><?php echo$orderQty;?></td>
		</tr>
		<tr>
			<td width="70%" title="Order Date" onclick="speak(this.title)">Order Date</td>
			<td width="30%" align="right" title="<?php echo $orderDate;?>" onclick="speak(this.title)"><?php echo $orderDate;?></td>
		</tr>
		<tr>
			<td width="70%" title="Delivery Date" onclick="speak(this.title)">Delivery Date</td>
			<td width="30%" align="right" title="<?php echo $deliveryDate;?>" onclick="speak(this.title)"><?php echo $deliveryDate;?></td>
		</tr>
		<tr>
			<td width="70%" title="Delivery City" onclick="speak(this.title)">Delivery City</td>
			<td width="30%" align="right" title="<?php echo$cCity;?>" onclick="speak(this.title)"><?php echo$cCity;?></td>
		</tr>
		<tr>
			<td width="70%" title="City Pincode" onclick="speak(this.title)">City Pincode</td>
			<td width="30%" align="right" title="<?php echo$cPin;?>" onclick="speak(this.title)"><?php echo$cPin;?></td>
		</tr>
	</table>
	</center>
	<br>
	
  <hr>

  <div align="center" title="Shipping Policy" onclick="speak(this.title)">
    <font size="6">SHIPPING POLICY</font>
  </div>

  <p title="Shipping Policy" onclick="speak(this.title)">
    <font size="4">
      All orders in India are shipped through registered domestic courier companies and /or speed post only. Orders are shipped within 3-6 working days or as per the delivery date agreed during the time of order confirmation and delivering of the shipment subject to Courier Company / Post Office norms.
     </font>
  </p>

  <hr>

  <div align="center" title="Contact Us" onclick="speak(this.title)">
    <font size="6">CONTACT US</font>
  </div>

  <p style="text-align:center;" title="Feel free to mail us at support@fabrica.in" onclick="speak(this.title)">
    <font size="4">
      Feel free to mail us at <font color="orange"><i>support@fabrica.in</i></font>
      <br>
      &reg;&nbsp;&apos;Fabrica&apos;
     </font>
  </p>

  <hr>

<br>
<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>

   
</body>

<script src="src/js/fabrica.js"></script>
<script>
	speak('Order Placed Succesfully');
</script>
</html>