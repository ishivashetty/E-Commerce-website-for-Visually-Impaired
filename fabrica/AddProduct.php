<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
	<title>Add Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
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
	
	$productAdded = "no";
	
	if(isset($_GET['flow'])){
		$productAdded = "yes";
	}
	
	if(isset($_POST['AddProduct'])){
		include 'db.php';
		
		$p_name = $_POST['add_name'];
		$p_cat = $_POST['add_category'];
		$p_desc = $_POST['add_desc'];
		$p_price = $_POST['add_price'];
		$p_gender = $_POST['add_gender'];
		$p_imageurl = '';
		$imageCounter = 0;
		$srcpath = 'src/images/products/';
		
		$imageQuery="SELECT MAX(Id) AS COUNT FROM products WHERE Gender = '$p_gender'";
		$res=mysqli_query($dbc,$imageQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$imageCounter=$data['COUNT'];
		}
		
		if($imageCounter==''){
			$imageCounter = 0;
		}
		
		if($p_gender=='male'){
			$imageCounter = $imageCounter%6;
			$p_imageurl = $srcpath."male/".$imageCounter.".jpg";
		}
		elseif($p_gender=='female'){
			$imageCounter = $imageCounter%4;
			$p_imageurl = $srcpath."female/".$imageCounter.".jpg";
		}
		else{
			$imageCounter = $imageCounter%10;
			$p_imageurl = $srcpath."both/".$imageCounter.".jpg";
		}
		
		$que = "INSERT INTO products(Name, Category, Description, Price, Gender, ImageUrl) VALUES('$p_name', '$p_cat', '$p_desc', '$p_price', '$p_gender', '$p_imageurl' );";
		
		$res = mysqli_query($dbc,$que);
		
		if($res){
			header('location:AddProduct.php?flow=added');
		}
		else{
			echo "<script>alert('Record not Inserted')</script>";
		}	
	}
	?>

  
	<br>
  
		<center style="font-size:35px">
		ADD PRODUCT
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
				<td style="width:60%"><input type="text" class="login" id="add_name" name="add_name" maxlength="30"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Category</td>
				<td style="width:60%"><input type="text" class="login" id="add_category" name="add_category" maxlength="30"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Suitable Gender</td>
				<td style="width:60%">
					<input type="radio" name="add_gender" value="male" id="rdoMale">Male &nbsp;&nbsp;
					<input type="radio" name="add_gender" value="female" id="rdoFemale">Female &nbsp;&nbsp;
					<input type="radio" name="add_gender" value="both" id="rdoBoth" checked>Both
				</td>
			</tr>
			<tr>
				<td style="font-size:20px">Description</td>
				<td style="width:60%"><input type="text" class="login" id="add_desc" name="add_desc" maxlength="50"/></td>
			</tr>
			<tr>
				<td style="font-size:20px">Price</td>
				<td style="width:60%"><input type="text" class="login" id="add_price" name="add_price" maxlength="8"/></td>
			</tr>
			
		</table>

        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:1%" class="valError">
			
		</div>
		
		<table style="margin-left:44%; margin-right:40%">
        <tr>
          <td width="35%">
            <input type="button" id="addBtn" class="loginBtn" value="  Add  " name="" onclick="validateForm();">
			<input type="submit" hidden disabled value="AddProduct" name="AddProduct" id="addProductFinal">
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

	<div id="productModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('productModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Product Added Successfully</p>
		  </div>
		</div>
	</div>
   
</body>

<?php
if($productAdded == "yes"){
	echo "<script>document.getElementById('productModal').style.display='block';</script>";
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
		speak('Product Added Successfully');
		document.getElementById('addProductFinal').disabled = false;
		document.getElementById('addProductFinal').click();
	}

}


</script>
<script src="src/js/fabrica.js"></script>
</html>