<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet" type="text/css">
	<link href="src/css/w3.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	
    <title>Delete Products</title>
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
	?>
  
  <br>

  <center style="font-size:35px">LIST OF PRODUCTS [DELETE ACCESS]<br><br></center>
  
  <center>
	   <?php
		  if(isset($_SESSION['adminName'])){
			
			include 'db.php';
			
			$productsQuery="SELECT * FROM PRODUCTS;";
			$res=mysqli_query($dbc,$productsQuery);
			$count=mysqli_num_rows($res);
			if($count!=0){
		?>
		<table border="1" cellpadding=5>
		  <tr align="center" style="font-size:30px;">
			<td title="Sr. No." onclick="speak('Serial Number')">SR. NO.</td>
			 <td title="Id" onclick="speak(this.title)">ID</td>
			 <td title="Name" onclick="speak(this.title)">NAME</td>
			 <td title="Category" onclick="speak(this.title)">CATEGORY</td>
			 <td title="Description" onclick="speak(this.title)">DESCRIPTION</td>
			 <td title="Gender" onclick="speak(this.title)">GENDER</td>
			 <td title="Price" onclick="speak(this.title)">PRICE</td>
			 <!--<td>IMAGE</td>-->
			 <td title="Delete" onclick="speak(this.title)">DELETE</td>
		  </tr>
		<?php
			$i=0;
			 while($row=mysqli_fetch_array($res)){
				 $i++;
				 $modalID = 'modalDelete'.$row['Id'];
		?>
		  <tr>
			<td title="<?php echo$i;?>" onclick="speak(this.title)"><?php echo$i;?></td>
			 <td title="<?php echo$row['Id'];?>" onclick="speak(this.title)">P<?php echo$row['Id'];?></td>
			 <td title="<?php echo$row['Name']?>" onclick="speak(this.title)"><?php echo$row['Name'];?></td>
			 <td title="<?php echo$row['Category'];?>" onclick="speak(this.title)"><?php echo$row['Category'];?></td>
			 <td title="<?php echo$row['Description'];?>" onclick="speak(this.title)"><?php echo$row['Description'];?></td>
				<?php 
					if($row['Gender']=='male'){	
				?>
					<td title="Male" onclick="speak(this.title)">Male</td>
				<?php 
					}
					elseif($row['Gender']=='female'){
				?>
					<td title="Female" onclick="speak(this.title)">Female</td>
				<?php 
					}
					else{
				?>	
					<td title="Both" onclick="speak(this.title)">Both</td>
				<?php 
					}
				?>
			 <td title="Rs. <?php echo$row['Price'];?>" onclick="speak(this.title)">Rs. <?php echo$row['Price'];?></td>
			 <!--<td style="white-space:nowrap; height:5%; width:5%"><img src="<?php echo$row['ImageUrl'];?>" height="20%" width="100%" ></img></td>-->
			 <td align="center"><img src="src/images/Products/delete1.png" title="<?php echo $row['Id'];?>" onclick="showDeletePopup(this.title);">
			 
			 
			 <div id="<?php echo $modalID;?>" class="w3-modal">
				<div class="w3-modal-content">
				  <div align="center" class="w3-container">
					<span onclick="document.getElementById('<?php echo $modalID;?>').style.display='none'" class="w3-button w3-display-topright">&times;</span>
					<p>Are you sure you want to Delete Product P<?php echo $row['Id'];?>?</p>
					<table>
						<tr>
							<td></td>
							<td>
								<input type="button" class="loginBtn" value="Yes" name="" id="userLoginBtn" onclick="speak('Item Removed');window.location.href = 'DeleteProd.php?pdid=<?php echo $row['Id']; ?>';">
							</td>
							<td>    </td>
							<td>
								<input type="button" class="loginBtn" value=" No " name="" id="userLoginBtn" onclick="document.getElementById('<?php echo $modalID;?>').style.display='none'">
							</td>
						</tr>
					</table>
					<br>
				  </div>
				</div>
			</div>
			
			</td>
		  </tr>
		<?php
			 }
		?>
	   </table>
	   <?php		
		  }
		  else{		
		?>
		<center style="font-size:30px">
		  <br><br>
			Sorry. No Products Found!
		  <br><br><br><br><br><br>
		</center>
		<?php
		  }
		  }
		  else{
			header('location:AdminLogin.php');
		  }	
		  
		 ?>
	</center>
	
	<br>
		

	<br>
	<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
	   

</body>

<script>
function showDeletePopup(id){
	document.getElementById('modalDelete'+id).style.display='block';
}
</script>
<script src="src/js/fabrica.js"></script>
</html>	