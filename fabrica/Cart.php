<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
	
    <title>Cart</title>
    <script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>
</head>
<body>

  
  <?php
	include('Navbar.php');
  ?>

  <!-- Logo -->
  <div align="center">
	<div style="font-size:15px; float:right; margin-right:5%" id="cartInfoDiv"><br><br>
		[Press 1 to hear your Cart Size] <br>
		[Press 2 to hear your Cart Total] <br>
		[Press 3 to place this Order]
	</div>
      <img src="src/images/logo.png" title="Fabrica" onmousedown="speak(this.title)" id="fabricaImage"  style="margin-left:18%; width:40%; height:50%">
	  
	  
			
  </div>

  
	<?php
		  if(isset($_SESSION['userIDX'])){
			
			$cartUserIDX = $_SESSION['userIDX'];
			$isCartEmpty = "no";
			
			include 'db.php';
			
			$cartQuery = "SELECT * FROM CART WHERE CUSTOMER_ID = '$cartUserIDX';";
			$res = mysqli_query($dbc,$cartQuery);
			$count = mysqli_num_rows($res);
			if($count!=0){
			$cartAmount = 0;
		?>
   
  <div align="center">
  <table bgcolor="">
    <tr>
      <td width="" id="itemsInfo" title="Items in Cart : <?php echo $count;?>" style="font-size:30px" onclick="speak(this.title)">Items in Cart (<?php echo $count;?>)
	  </td>
    </tr>
  </table>
  </div>
   
<br>
  <div align="center">
	<table border="0">
	<tr>
    <td width="10%"></td>
	<td width="">
	<div align="center">
	
	<?php
			
			 while($row=mysqli_fetch_array($res)){
				 $pID = $row['Product_id'];
				 $qty = $row['Quantity'];
				 $remvoeCartModalId = "removeFromCart".$pID;
				 
				 $pQuery = "SELECT IMAGEURL AS URL, PRICE AS PRICE, NAME AS NAME FROM PRODUCTS WHERE ID = '$pID';"; 
				 $pRes = mysqli_query($dbc,$pQuery);
					$c = mysqli_num_rows($pRes);
					if($c!=0){
						$pData = mysqli_fetch_array($pRes);
						$pPrice = $pData['PRICE'];
						$pName = $pData['NAME'];
						$amt = $pPrice*$qty;
						$cartAmount+= $amt;
						$modalID = 'modalDelete'.$row['Id'];
		?>
		
	<div style="display:inline-block; border-style: double; margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">
		<table>
		<tr>
			<td colspan="3">
				<img src="<?php echo $pData['URL'];?>" style="height:70%" title="<?php echo$pName;?>" onclick="speak(this.title)"></img><br><br>
			</td>
		</tr>
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center" title="<?php echo$pName;?>" onclick="speak(this.title)">
				<?php echo$pName;;?>
			</div><br>
			</td>
		</tr>
		<tr style="font-size:18px;" align="">
			<td width="">
				<div align="" style="margin-left: 10px;" title="Unit Price : Rs. <?php echo $pPrice;?>" onclick="speak(this.title)" >[Unit Price : Rs. <?php echo $pPrice;?>]</div><br></td>
			<td width="">
				<div align="center" style="padding-left: 80px;" title="Quantity : <?php echo $qty;?>" onclick="speak(this.title)">[Quantity : <?php echo $qty;?>]</div><br>
			</td>
		</tr>
		<tr style="font-size:26px;">
			<td colspan="3"  style="padding-left: 25px; padding-right: 25px;">
			<div align="center" title="Price : Rs.<?php echo$amt;?>" onclick="speak(this.title)" >
				Price : Rs. <?php echo $amt;?>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="3"  style="padding-left: 20%; padding-right: 20%;">
			<div align="center">
				<br><input class="cart" type="button" value="Remove from Cart" onclick="showRemoveFromCartPopup(<?php echo $pID;?>)"/>	<br><br>
			</div>
			</td>
		</tr>
		</table>
		
		<div id="<?php echo $remvoeCartModalId;?>" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('<?php echo $remvoeCartModalId;?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Are you sure to remove this item from your Cart?</p>
			<table>
				<tr>
					<td></td>
					<td>
						<input type="button" class="loginBtn" value="Yes" name="" id="" 
						onclick="window.location.href = 'ProcessRemoveFromCart.php?removeUID=<?php echo $cartUserIDX;?>&removePID=<?php echo $pID;?>';">
					</td>
					<td>    </td>
					<td>
						<input type="button" class="loginBtn" value=" No " name="" id="" onclick="document.getElementById('<?php echo $remvoeCartModalId;?>').style.display='none'">
					</td>
				</tr>
			</table>
			<br>
		  </div>
		</div>
	</div>
	
	</div>
	
	
	<?php
			 }}
		?>

	</div>	 
	</td>
	<td width="10%"></td>
	</tr>
  </table>
  <br>
  <hr>
  <div align="center" id="priceInfo" style="font-size:30px" title="Cart Total : Rs.<?php echo$cartAmount;?>" onclick="speak(this.title)" ><br>[Cart Total : Rs. <?php echo $cartAmount;?>]</div><br>
	
	<form method="post" action="Order.php">
		<div align="center" style="padding-left: 40%; padding-right: 40%;">
			<input type="hidden" name="orderItems" value="<?php echo $count;?>">
			<input type="hidden" name="orderAmount" value="<?php echo$cartAmount;?>">
			<input class="cart" type="submit" id="orderItemsBtn" value="ORDER ITEMS" />	<br><br>
		</div>
	</form>
	<hr>
  
  <?php		
		  }
		  else{
			$isCartEmpty = "yes";
		?>
		<center style="font-size:30px">
		  <br><br>
			<div title="Cart is Empty!" onclick="speak(this.title)">Cart is Empty!</div>
		  <br><br><br><br><br><br>
		</center>
		<?php
		  }
		  }
		  else{
			header('location:Login.php');
		  }	
		  
		 ?>
		 
  <br>
  
  
 
  </div>
  
   
<br>
<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
	
</body>

<?php
	if($isCartEmpty == "yes"){
		echo "<script>document.getElementById('fabricaImage').style = 'margin-left:0%'; document.getElementById('cartInfoDiv').style.display = 'none';</script>";
	}	
?>

<script>

document.addEventListener("keypress", function(event) {
	if(document.activeElement !== document.getElementById("searchbar")) {
		if (event.keyCode == 49) {
			document.getElementById("itemsInfo").click();
		}
		if (event.keyCode == 50) {
			document.getElementById("priceInfo").click();
		}
		if (event.keyCode == 51) {
			document.getElementById("orderItemsBtn").click();
		}
	}
});



function showRemoveFromCartPopup(id){
	var removalModalID = "removeFromCart"+id;
	document.getElementById(removalModalID).style.display='block';
}
</script>
<script src="src/js/fabrica.js"></script>
</html>