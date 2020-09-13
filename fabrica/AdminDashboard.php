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

    <title>Admin Dashboard</title>
    <script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>
</head>
<body>

<?php
	include('AdminNavbar.php');
	
	if(isset($_SESSION['adminName'])){
		$userCount = 0;
		$orders = 0;
		$products = 0;
		$sales = 0;
		
		include 'db.php';
		
		$userQuery="SELECT COUNT(*) AS COUNT FROM CUSTOMER;";
		$res=mysqli_query($dbc,$userQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$userCount=$data['COUNT'];
		}
		
		$ordersQuery="SELECT COUNT(DISTINCT(ORDER_ID)) AS COUNT FROM ORDERS;";
		$res=mysqli_query($dbc,$ordersQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$orders=$data['COUNT'];
		}
		
		$productsQuery="SELECT COUNT(*) AS COUNT FROM PRODUCTS;";
		$res=mysqli_query($dbc,$productsQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$products=$data['COUNT'];
		}
		
		$salesQuery="SELECT SUM(Total_price) AS SALES FROM orders;";
		$res=mysqli_query($dbc,$salesQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$sales=$data['SALES'];
			if($sales==''){
				$sales = 0;
			}
			$sales = round($sales);
		}
		
	}
	else{
		header('location:AdminLogin.php');
	}
?>

 <br>

  <!-- Headings -->
  <div align="center">
  <table bgcolor="" style="font-size:25px;">
    <tr>
      <td width="" style="font-size:32px;" align="center" title="Hi <?php echo $_SESSION['adminName'];?>" onclick="speak(this.title)">Hi <?php echo $_SESSION['adminName'];?>!</td>
    </tr>
	<tr>
      <td width="" align="center" title="Total Registered Users : <?php echo $userCount;?>" onclick="speak(this.title)">Total Registered Users : <?php echo $userCount;?></td>
    </tr>
	<tr>
      <td width="" align="center" title="Total Orders Placed : <?php echo $orders;?>" onclick="speak(this.title)">Total Orders Placed : <?php echo $orders;?></td>
    </tr>
	<tr>
      <td width="" align="center" title="Total Products : <?php echo $products;?>" onclick="speak(this.title)">Total Products : <?php echo $products;?></td>
    </tr>
	<tr>
      <td width="" align="center" title="Total Sales : Rs.<?php echo $sales;?>" onclick="speak(this.title)">Total Sales : Rs.<?php echo $sales;?></td>
    </tr>
  </table>
  </div>
<br>
  <div align="center">
	<table border="0">
	<tr>
    <td width="5%"></td>
	<td width="">
	<div align="center">
	
	
	<div style="font-size:20px; display:inline-block; border-style: double; margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; padding-top:20px">
		<table>
		<tr>
			<td colspan="3" align="center">
				<img src="src/images/Products/add.png" title="Add Products" style="height:40%; width:40%" onclick="speak(this.title); window.open('AddProduct.php')";><br><br>
			</td>
		</tr>
	
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center">
				<br><input class="cart" type="button" value="Add Products" title="Add Products" onclick="speak(this.title); window.open('AddProduct.php');"/>	<br><br>
			</div>
			</td>
		</tr>
		
		</table>
	</div>
	
	
	<div style="font-size:20px; display:inline-block; border-style: double; margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; padding-top:20px">
		<table>
		<tr>
			<td colspan="3" align="center">
				<img src="src/images/Products/edit.png" title="Update Products" style="height:40%; width:40%" onclick="speak(this.title); window.open('ViewProducts.php')";><br><br>
			</td>
		</tr>
	
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center">
				<br><input class="cart" type="button" value="Update Products" title="Update Products" onclick="speak(this.title); window.open('ViewProducts.php')";/>	<br><br>
			</div>
			</td>
		</tr>
		
		</table>
	</div>
	
	<div style="font-size:20px; display:inline-block; border-style: double; margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; padding-top:20px">
		<table>
		<tr>
			<td colspan="3" align="center">
				<img src="src/images/Products/delete.png" title="Delete Products" style="height:40%; width:40%" onclick="speak(this.title); window.open('DeleteProducts.php');"><br><br>
			</td>
		</tr>
	
		<tr>
			<td colspan="3"  style="padding-left: 10px; padding-right: 10px;">
			<div align="center">
				<br><input class="cart" type="button" value="Delete Products" title="Delete Products" onclick="speak(this.title); window.open('DeleteProducts.php');"/>	<br><br>
			</div>
			</td>
		</tr>
		
		</table>
	</div>
	
	</div>	 
	</td>
	<td width="5%"></td>
	</tr>
  </table>
  </div>

<br>

<!-- Bottom Navbar -->
<?php
	include 'BottomNavbar.php';
?>

</body>

<script src="src/js/fabrica.js"></script>
</html>