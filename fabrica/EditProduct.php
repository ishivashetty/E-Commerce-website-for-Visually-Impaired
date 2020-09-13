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
	
	<title>Update Product</title>	
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
		
		$productUpdated = "no";
		
		if(isset($_GET['pid'])){
			$uid = $_GET['pid'];
			$uname = '';
			$ucategory = '';
			$udescription = '';
			$uprice = 0;
			
			include 'db.php';
			
			$updateProductQuery="SELECT NAME, CATEGORY, DESCRIPTION, PRICE FROM PRODUCTS WHERE ID = '$uid';";
			$res=mysqli_query($dbc,$updateProductQuery);
			$count=mysqli_num_rows($res);
			if($count!=0){
				$data=mysqli_fetch_array($res);
				$uname=$data['NAME'];
				$ucategory=$data['CATEGORY'];
				$udescription=$data['DESCRIPTION'];
				$uprice=$data['PRICE'];
			}
		}
		
		if(isset($_POST['prodUpdate'])){
			$nid = $_POST['hiddenProdId'];
			$nname = $_POST['add_name'];
			$ncategory = $_POST['add_category'];
			$ndescription = $_POST['add_desc'];
			$nprice = $_POST['add_price'];
			
			include 'db.php';
			
			$updateProdQuery="UPDATE PRODUCTS SET NAME = '$nname', CATEGORY='$ncategory', DESCRIPTION='$ndescription', PRICE='$nprice' WHERE ID = '$nid';";
			$res=mysqli_query($dbc,$updateProdQuery);
			if($res){
				header('location:EditProduct.php?pid='.$nid.'&flow=updated');
			}
			else{
				echo "<script>alert('Record not Updated')</script>";
			}	
		}
		else if(isset($_GET['flow'])){
			$productUpdated = "updated";
		}
			
	}
	else{
		header('location:AdminLogin.php');
	}	
	?>
  
	<br>
  
		<center style="font-size:35px">
		UPDATE PRODUCT
		<br>
		</center>
		<br>
		<center style="font-size:20px">
		Enable Voice Input :  
		<input type="radio" name="voiceCheck" value="on" id="rdoYes">On
		<input type="radio" name="voiceCheck" value="off" id="rdoNo" checked>Off
		</center>
		<br>
        <form class="" method="post" autocomplete="off">
	
		<table cellpadding="5px" class="" style="margin-left:33%; margin-right:20%">
			<tr>
				<td style="font-size:20px; width:10%">Name</td>
				<td style="width:60%"><input type="text" class="login" id="add_name" name="add_name" maxlength="30" value="<?php echo$uname?>"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Category</td>
				<td style="width:60%"><input type="text" class="login" id="add_category" name="add_category" maxlength="30" value="<?php echo$ucategory?>"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Description</td>
				<td style="width:60%"><input type="text" class="login" id="add_desc" name="add_desc" maxlength="50" value="<?php echo$udescription?>"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Price</td>
				<td style="width:60%"><input type="text" class="login" id="add_price" name="add_price"  maxlength="8" value="<?php echo$uprice?>"/></td>
			</tr>
		</table>

        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:1%" class="valError">
			
		</div>
		
		<table style="margin-left:44%; margin-right:40%">
        <tr>
          <td width="35%">
            <input type="button" id="addBtn" class="loginBtn" value=" Update " name="" onclick="validateForm();">
			<input type="text" hidden name="hiddenProdId" id="hiddenProdId" value="<?php echo$uid?>"/>
			<input type="submit" hidden disabled value="prodUpdate" name="prodUpdate" id="updateProductFinal">
          </td>
          <td width="10%">
          <td width="35%">
            <input type="reset" id="resetBtn" class="loginBtn" value="Reset" name="" onclick="resetValidation();">
          </td>
        </tr>
		</table>
		</form>
		
<br>
<br>
  
<!-- Bottom Navbar -->
<?php
	include 'BottomNavbar.php';
?>

	<div id="prodUpdateModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('prodUpdateModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Product Updated Successfully</p>
		  </div>
		</div>
	</div>

</body>

<?php
if($productUpdated == "updated"){
	echo "<script>document.getElementById('prodUpdateModal').style.display='block';</script>";
}
?>

<script>

function getVoiceValue() {
	var ele = document.getElementsByName('voiceCheck'); 
	var res = "off";
	for(i = 0; i < ele.length; i++) { 
		if(ele[i].checked){
			res = ele[i].value;
		} 
	}
	return res;
}

const name = document.getElementById("add_name");
const category = document.getElementById("add_category");
const desc = document.getElementById("add_desc");
const price = document.getElementById("add_price");
	
name.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('add_name');
  }
});

category.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('add_category');
  }
});
 
desc.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('add_desc');
  }
});

price.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('add_price');
  }
});

function resetValidation(){
	document.getElementById("validationText").innerHTML = "";
	document.getElementById("add_name").style="";
	document.getElementById("add_category").style="";
	document.getElementById("add_desc").style="";
	document.getElementById("add_price").style="";
}

function validateForm(){
	resetValidation();

	var name = document.getElementById("add_name").value;
	var category = document.getElementById("add_category").value;
	var desc = document.getElementById("add_desc").value;
	var price = document.getElementById("add_price").value;
	
	if(isEmpty(name) && isEmpty(category) && isEmpty(desc) && isEmpty(price)){
		speak('All Fields are empty');
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("add_name").style="border-color:red;";
		document.getElementById("add_category").style="border-color:red;";
		document.getElementById("add_desc").style="border-color:red;";
		document.getElementById("add_price").style="border-color:red;";
	}
	else if(isEmpty(name)){
		speak('Name Empty');
		document.getElementById("validationText").innerHTML = "<br>Name Empty<br>";
		document.getElementById("add_name").style="border-color:red;";
	}
	else if(isNumber(name)){
		speak('Name Invalid');
		document.getElementById("validationText").innerHTML = "<br>Name Invalid<br>";
		document.getElementById("add_name").style="border-color:red;";
	}
	else if(isEmpty(category)){
		speak('Category Empty');
		document.getElementById("validationText").innerHTML = "<br>Category Empty<br>";		
		document.getElementById("add_category").style="border-color:red;";
	}
	else if(isEmpty(desc)){
		speak('Description Empty');	
		document.getElementById("validationText").innerHTML = "<br>Description Empty<br>";
		document.getElementById("add_desc").style="border-color:red;";
	}
	else if(isEmpty(price)){
		speak('Price Empty');
		document.getElementById("validationText").innerHTML = "<br>Price Empty<br>";
		document.getElementById("add_price").style="border-color:red;";
	}
	else if(!isPrice(price)){
		speak('rice should be numeric');
		document.getElementById("validationText").innerHTML = "<br>Price should be numeric<br>";
		document.getElementById("add_price").style="border-color:red;";
	}
	else{
		speak('Product Updated Successfully');
		document.getElementById('updateProductFinal').disabled = false;
		document.getElementById('updateProductFinal').click();
	}

}


</script>
<script src="src/js/fabrica.js"></script>
</html>