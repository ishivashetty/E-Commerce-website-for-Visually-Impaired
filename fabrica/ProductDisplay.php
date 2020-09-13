<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	
    <title>Shop @ Fabrica</title>
	<script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>
</head>
<body>

  <!--Top NavBar -->
  <?php
	include('Navbar.php');
  ?>


  <!-- Logo -->
  <div align="center">
      <img src="src/images/logo.png" title="Fabrica" onmousedown="speak(this.title)"  style="width:40%; height:50%">
  </div>
  
	<br>

  <div align="center">
  
  <?php
		  if(true){
			include 'db.php';
			
			$searchCriteria = '';
			$productQuery="SELECT * FROM PRODUCTS;";
			$label = 'Shop';
			$itemAdded = "no";
			$loginRequired = "no";
			$itemExists = "no";
			$displayExists = false;
			$searchExists = false;
			
			if(isset($_GET['display'])){
				$displayExists = true;
				$searchCriteria = strtolower($_GET['display']);
				if($searchCriteria=='all'){
					$productQuery="SELECT * FROM PRODUCTS;";
				}
				else if($searchCriteria=='latest'){
					$productQuery="SELECT * FROM PRODUCTS ORDER BY ID DESC LIMIT 20;";
					$label = 'New Arrivals';
				}
				else if($searchCriteria=='male'){
					$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'male';";
					$label = 'Men\'s Fashion';
				}
				else if($searchCriteria=='female'){
					$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'female';";
					$label = 'Women\'s Fashion';
				}
				else if($searchCriteria=='both'){
					$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'both';";
					$label = 'Customizations';
				}
			}
			else if(isset($_GET['search'])){
				$searchExists = true;
				$searchString = $_GET['search'];
				$label = "Showing Results for '".$searchString."'";
				
				//$productQuery = "SELECT * FROM PRODUCTS WHERE NAME LIKE '%".$searchString."%' OR DESCRIPTION LIKE '%".$searchString."%' OR CATEGORY LIKE '%".$searchString."%'";
				$productQuery = "SELECT * FROM PRODUCTS WHERE NAME LIKE '%".$searchString."%'";
				$resultSet = mysqli_query($dbc,$productQuery);
				$count = mysqli_num_rows($resultSet);
				
				if($count==0){
					$searchString = strtolower($_GET['search']);
					if((strpos($searchString, 'woman') !== false) or (strpos($searchString, 'women') !== false) or (strpos($searchString, 'girl') !== false) 
						or (strpos($searchString, 'lady') !== false) or (strpos($searchString, 'ladies') !== false) or (strpos($searchString, 'female') !== false) ){
						$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'female';";
					}
					else if((strpos($searchString, 'man') !== false) or (strpos($searchString, 'men') !== false) or (strpos($searchString, 'boy') !== false) 
						or (strpos($searchString, 'male') !== false) ){
						$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'male';";
					}
					else if((strpos($searchString, 'custom') !== false) ){
						$productQuery="SELECT * FROM PRODUCTS WHERE GENDER = 'both';";
					}
				}
			}
			
			if(isset($_GET['state'])){
				$stateX = $_GET['state'];
				
				if($stateX == 'added'){
					$itemAdded = "yes";
				}
				else if($stateX == 'loginRequired'){
					$loginRequired = "yes";
				}
				else if($stateX == 'itemExists'){
					$itemExists = "yes";
				}	
			}
			
			$resultSet=mysqli_query($dbc,$productQuery);
			$count=mysqli_num_rows($resultSet);
			if($count!=0){
		?>
		
		
	<table bgcolor="">
		<tr>
			<td width="" id="labelInfo" title="<?php echo $label;?>" onclick="speak(this.title);" style="font-size:33px"><?php echo $label;?> </td>
		</tr>
	</table>
  
	<table border="0">
	<tr>
    <td width="10%"></td>
	<td width="">
	<div align="center">
	<?php
			
			 while($row=mysqli_fetch_array($resultSet)){

				 $pid = $row['Id'];
				 $pname = $row['Name'];
				 $pprice = $row['Price'];
	?>
	
	
	<div style="font-size:20px; display:inline-block; border-style: double; margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">
	
		<?php
		if($searchExists){
		?>	
			<form method="post" action="ProcessAddToCart.php?search=<?php echo $_GET['search']?>">
		<?php
		}
		else if($displayExists){
		?>
			<form method="post" action="ProcessAddToCart.php?display=<?php echo $_GET['display']?>">
		<?php
		}
		else{
		?>
			<form method="post" action="ProcessAddToCart.php?display=all">
		<?php
		}	
		?>
		
		<table>
		
		<tr>
			<td colspan="3">
				<img src="<?php echo$row['ImageUrl'];?>" style="height:70%" title="<?php echo $row['Description'];?>" onclick="speak(this.title);" ></img><br><br>
			</td>
		</tr>
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center" title="<?php echo$pname;?>" onclick="speak(this.title)">
				<?php echo$pname;;?>
			</div><br>
			</td>
		</tr>
		<tr>
			<td width="30%"><div align="left" style="margin-left: 10px;" title="Rs. <?php echo$pprice;?>" onclick="speak(this.title)">Price : <br>Rs. <?php echo$pprice;?></div></td>
			<td width="42%"></td>
			<td width="28%">
				<div align="center" title="Quantity">Quantity : 
					<select name="productQty"> 
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4	</option>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center">
				<br><input class="cart" type="button" value="Add to Cart" title="<?php echo$pid;?>" onclick="showAddToCartPopup(this.title);"/>	<br><br>
				<input type="text" hidden name="productIDX" value="<?php echo$pid;?>">
				<input type="submit" hidden disabled name="addedToCart" value="addedToCart" id="cartFinalBtn<?php echo$pid;?>">
			</div>
			</td>
		</tr>
		
		</table>
		</form>
	</div>
	<?php
			 }
		?>
		

	</div>	 
	</td>
	<td width="10%"></td>
	</tr>
  </table>
  
  <?php		
		  }
		  else{		
		?>
		<center style="font-size:30px">
		  <br><br>
		  <?php
			$noResultsStr = '';
			if(isset($_GET['search'])){
				$noResultsStr = ' for \''.$_GET['search'].'\'';
			}
		  ?>
			<div title="No Results found" onclick="speak(this.title)">Sorry. No Results found<?php echo $noResultsStr;?>!</div>
		  <br><br><br><br><br><br>
		</center>
		<?php
		  }
		  }
		  
		 ?>
		 
  </div>

<br><br>
<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
   

	<div id="addToCartModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('addToCartModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Item added to your cart successfully!</p>
			<table>
				<tr>
					<td>
						<input type="button" class="loginBtn" value="OK" name="" id="userLoginBtn" onclick="document.getElementById('addToCartModal').style.display='none'">
					</td>			
				</tr>
			</table>
			<br>
		  </div>
		</div>
	</div>
	
	<div id="loginRequiredModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('loginRequiredModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>You need to Login first!</p>
			<table>
				<tr>
					<td>
						<input type="button" class="loginBtn" value="OK" name="" id="userLoginBtn" onclick="document.getElementById('loginRequiredModal').style.display='none'">
					</td>
				</tr>
			</table>
			<br>
		  </div>
		</div>
	</div>
	
	<div id="itemExistsModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('itemExistsModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Item already exists in your Cart!</p>
			<table>
				<tr>
					<td>
						<input type="button" class="loginBtn" value="OK" name="" id="userLoginBtn" onclick="document.getElementById('itemExistsModal').style.display='none'">
					</td>
				</tr>
			</table>
			<br>
		  </div>
		</div>
	</div>

   
</body>

<?php	
if($itemAdded == "yes"){
	echo "<script>speak('Item added to your cart successfully!');</script>";
	echo "<script>document.getElementById('addToCartModal').style.display='block';</script>";
}	
else if($loginRequired == "yes"){
	echo "<script>speak('You need to Login first!');</script>";
	echo "<script>document.getElementById('loginRequiredModal').style.display='block';</script>";
}
else if($itemExists == "yes"){
	echo "<script>speak('Item already exists in your Cart');</script>";
	echo "<script>document.getElementById('itemExistsModal').style.display='block';</script>";
}
else{
	echo "<script>document.getElementById('labelInfo').click();</script>";
}	
?>

<script>

function showAddToCartPopup(title){
	var titleID = 'cartFinalBtn' + title;
	document.getElementById(titleID).disabled = false;
	document.getElementById(titleID).click();
}
</script>
<script src="src/js/fabrica.js"></script>
</html>