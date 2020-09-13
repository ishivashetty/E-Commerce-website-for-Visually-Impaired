<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta Tages -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
	
    <title>Registration</title>
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
  ?>
  <div></div>
  <?php
	$emailexists = "no";
	$regDone = "no";
	
	if(isset($_POST['RegisterUser'])){
		include 'db.php';

		$u_email = $_POST['emailID'];

		$emailExistsQuery="SELECT NAME FROM CUSTOMER WHERE EMAIL = '$u_email'";
		$res=mysqli_query($dbc,$emailExistsQuery);
		$count=mysqli_num_rows($res);
		if($count!=0){
			header('location:Register.php?emailExists=true');
		}
		else{
			$u_name = $_POST['name'];
			$u_mob = $_POST['mobile'];
			$u_address = $_POST['address'];
			$u_city = $_POST['city'];
			$u_pin = $_POST['pincode'];
			$u_pass = $_POST['pass'];
			
			$registerQuery = "INSERT INTO CUSTOMER(NAME, MOBILE, EMAIL, ADDRESS, CITY, PINCODE) VALUES('$u_name', '$u_mob', '$u_email', '$u_address', '$u_city', '$u_pin');";
		
			$result = mysqli_query($dbc,$registerQuery);
			
			if($result){
				$loginQuery2 = "SELECT MAX(ID) AS ID FROM CUSTOMER;";
				$result1 = mysqli_query($dbc,$loginQuery2);
				$count1 = mysqli_num_rows($result1);
				if($count1!=0){
					$data = mysqli_fetch_array($result1);
					$u_ID=$data['ID'];
					if($u_ID==''){
						$u_ID = 0;
					}
					$u_ID = $u_ID++;
					$loginTableQuery = "INSERT INTO LOGIN(CUSTOMER_ID, NAME, EMAIL, PASSWORD) VALUES ('$u_ID','$u_name','$u_email','$u_pass');";
					$result2 = mysqli_query($dbc,$loginTableQuery);	
					if($result2){
						header('location:Register.php?flow=added');
					}
					else{
						echo "<script>alert('Record not Inserted1')</script>";
					}
				}
				else{
					echo "<script>alert('Record not Inserted2')</script>";
				}
			}
			else{
				echo "<script>alert('Record not Inserted3')</script>";
			}
		}
	}
	else if(isset($_GET['flow'])){
		$regDone = "yes";
	}
	else if(isset($_GET['emailExists'])){
		$emailexists="yes";
	}
	
  ?>


  <br> <br>

  <!-- Image Slideshow -->
  <table style="width:100%" bgcolor="">
    <tr>

      <td width="10%"></td>

      <td width="40%">
        <div class="slideshow-container">
          <div class="mySlides fade">
            <div class="numbertext">1 / 4</div>
            <img src="src/images/products/13.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">2 / 4</div>
            <img src="src/images/products/8.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <img src="src/images/products/12.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <img src="src/images/products/9.jpg" style="width:100%">
          </div>
        </div>
        <br>
        <div style="text-align:center">
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
          <span class="dot"></span> 
        </div>
      </td>

      <td width="5%"></td>

      <!-- Registration Section -->
      <td align="center">
        <div align="center" style="font-size:35px">REGISTRATION</div>
        <br>
		<center style="font-size:20px">
		Enable Voice Input :  
		<input type="radio" name="voiceCheck" value="on" id="rdoYes">On
		<input type="radio" name="voiceCheck" value="off" id="rdoNo" checked>Off
		</center>
		<br>
        <form autocomplete="off" method="post">
        <input type="text" class="register" id="name" name="name" maxlength="30" placeholder="Name" autocomplete="off"/>
        <br><br>
        <input type="text" class="register" id="mobile" name="mobile" maxlength="10" placeholder="Mobile Number"/>
        <br><br>
        <input type="Email" class="register" id="emailID" name="emailID" maxlength="30" placeholder="Email ID"/>
        <br><br>
        <input type="text" class="register" id="address" name="address" maxlength="70" placeholder="Address"/>
        <br><br>
		<input type="text" class="register" id="city" name="city" maxlength="25" placeholder="City"/>
        <br><br>
		<input type="text" class="register" id="pincode" name="pincode" maxlength="6" placeholder="Pincode"/>
        <br><br>
        <input type="Password" class="register" id="pass" name="pass" maxlength="20" placeholder="Password"/>
        <br><br>
        <input type="Password" class="register" id="cnfPass" name="cnfPass" maxlength="20" placeholder="Confirm Password"/>
		<br>
		
        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:3%" class="valError">
		</div>

        <table>
        <tr>
          <td width="45%">
            <input type="button" class="registerBtn" value="Register" name="" id="userRegBtn" onclick="validateForm();">
			<input type="submit" hidden disabled value="RegisterUser" name="RegisterUser" id="registerUserFinal">
          </td>
          <td width="10%">
          <td width="45%">
            <input type="reset" class="registerBtn" value="Reset" name="" id="userReset">
          </td>
        </tr>
      </form>
      </table>
      <td width="5%"></td>

     
    </tr>
  </table>
<br>
<br>

<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
	
	<div id="emailExistsModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('emailExistsModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Email ID already exists</p>
			<p>Please try again with a new Email Id.</p>
		  </div>
		</div>
	</div>
	
   <div id="regDoneModal" class="w3-modal">
	<div class="w3-modal-content">
	  <div align="center" class="w3-container">
		<span onclick="document.getElementById('regDoneModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
		<p>Registration Done Successfully!</p>
		<table>
			<tr>
				<td></td>
				<td>
					<input type="button" class="loginBtn" value="Login" name="" id="" onclick="window.location.href = 'Login.php';">
				</td>
				<td>    </td>
				<td>
					<input type="button" class="loginBtn" value=" Close " name="" id="" onclick="document.getElementById('regDoneModal').style.display='none'">
				</td>
			</tr>
		</table>
		<br>
	  </div>
	</div>
</div>
	
</body>

<?php
if($emailexists == "yes"){
	echo "<script>speak('Email ID already exists');</script>";
	echo "<script>document.getElementById('emailExistsModal').style.display='block';</script>";
}
else if($regDone == "yes"){
	echo "<script>speak('Registration Done Successfully');</script>";
	echo "<script>document.getElementById('regDoneModal').style.display='block';</script>";
}

?>

<script>

document.getElementById("name").focus();

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}

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

const name = document.getElementById("name");
const mobile = document.getElementById("mobile");
const email = document.getElementById("emailID");
const address = document.getElementById("address");
const city = document.getElementById("city");
const pincode = document.getElementById("pincode");
const pass = document.getElementById("pass");
const cnfPass = document.getElementById("cnfPass");


name.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('name');
  }
});

mobile.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('mobile');
  }
});
 
email.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('emailID');
  }
});

address.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('address');
  }
});

city.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('city');
  }
});

pincode.addEventListener('click', (event) => {
  if(getVoiceValue()=='on'){
	listen('pincode');
  }
});

function resetValidation(){
	document.getElementById("validationText").innerHTML = "";
	document.getElementById("name").style="";
	document.getElementById("mobile").style="";
	document.getElementById("emailID").style="";
	document.getElementById("address").style="";
	document.getElementById("city").style="";
	document.getElementById("pincode").style="";
	document.getElementById("pass").style="";
	document.getElementById("cnfPass").style="";
}

function validateForm(){
	resetValidation();

	var name = document.getElementById("name").value;
	var mobile = document.getElementById("mobile").value;
	var emailID = document.getElementById("emailID").value;
	var address = document.getElementById("address").value;
	var city = document.getElementById("city").value;
	var pincode = document.getElementById("pincode").value;
	var pass = document.getElementById("pass").value;
	var cnfPass = document.getElementById("cnfPass").value;
	
	if(isEmpty(name) && isEmpty(mobile) && isEmpty(emailID) && isEmpty(address) && isEmpty(city) && isEmpty(pincode) && isEmpty(pass) && isEmpty(cnfPass)){
		speak('All Fields are empty');
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("name").style="border-color:red;";
		document.getElementById("mobile").style="border-color:red;";
		document.getElementById("emailID").style="border-color:red;";
		document.getElementById("address").style="border-color:red;";
		document.getElementById("city").style="border-color:red;";
		document.getElementById("pincode").style="border-color:red;";
		document.getElementById("pass").style="border-color:red;";
		document.getElementById("cnfPass").style="border-color:red;";
	}
	else if(isEmpty(name)){
		speak('Name Empty');
		document.getElementById("validationText").innerHTML = "<br>Name Empty<br>";
		document.getElementById("name").style="border-color:red;";
	}
	else if(isNumber(name)){
		speak('Name Invalid');
		document.getElementById("validationText").innerHTML = "<br>Name Invalid<br>";
		document.getElementById("name").style="border-color:red;";
	}
	else if(isEmpty(mobile)){
		speak('Mobile Number Empty');
		document.getElementById("validationText").innerHTML = "<br>Mobile Number Empty<br>";		
		document.getElementById("mobile").style="border-color:red;";
	}
	else if(!isNumber(mobile)){
		speak('Mobile Number Invalid');
		document.getElementById("validationText").innerHTML = "<br>Mobile Number Invalid<br>";		
		document.getElementById("mobile").style="border-color:red;";
	}
	else if(mobile.length!=10){
		speak('Mobile Number should contain exact 10 digits');	
		document.getElementById("validationText").innerHTML = "<br>Mobile Number should contain exact 10 digits<br>";
		document.getElementById("mobile").style="border-color:red;";
	}
	else if(isEmpty(emailID)){
		speak('Email ID Empty');
		document.getElementById("validationText").innerHTML = "<br>Email ID Empty<br>";
		document.getElementById("emailID").style="border-color:red;";
	}
	else if(!isEmail(emailID)){
		speak('Email ID Invalid');
		document.getElementById("validationText").innerHTML = "<br>Email ID Invalid<br>";
		document.getElementById("emailID").style="border-color:red;";
	}
	else if(isEmpty(address)){
		speak('Address Empty');
		document.getElementById("validationText").innerHTML = "<br>Address Empty<br>";
		document.getElementById("address").style="border-color:red;";
	}
	else if(address.length<10){
		speak('Address should contain minimum 10 characters');
		document.getElementById("validationText").innerHTML = "<br>Address should contain minimum 10 characters<br>";
		document.getElementById("address").style="border-color:red;";
	}
	else if(isEmpty(city)){
		speak('City Empty');
		document.getElementById("validationText").innerHTML = "<br>City Empty<br>";
		document.getElementById("city").style="border-color:red;";
	}
	else if(isEmpty(pincode)){
		speak('Pincode Empty');
		document.getElementById("validationText").innerHTML = "<br>Pincode Empty<br>";		
		document.getElementById("pincode").style="border-color:red;";
	}
	else if(!isNumber(pincode)){
		speak('Pincode Invalid');
		document.getElementById("validationText").innerHTML = "<br>Pincode Invalid<br>";		
		document.getElementById("pincode").style="border-color:red;";
	}
	else if(pincode.length!=6){
		speak('Pincode should contain exact 6 digits');	
		document.getElementById("validationText").innerHTML = "<br>Pincode should contain exact 6 digits<br>";
		document.getElementById("pincode").style="border-color:red;";
	}
	else if(isEmpty(pass)){
		speak('Password Empty');
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else if(pass.length<6){
		speak('Password should contain minimum 6 characters');
		document.getElementById("validationText").innerHTML = "<br>Password should contain minimum 6 characters<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else if(!isPassword(pass)){
		speak('Password should be Alphanumeric');
		document.getElementById("validationText").innerHTML = "<br>Password should be Alphanumeric<br>";
		document.getElementById("pass").style=" border-color:red;";
	}
	else if(isEmpty(cnfPass)){
		speak('Password Empty');
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("cnfPass").style=" border-color:red;";
	}
	else if(pass!=cnfPass){
		speak('Passwords do not match');
		document.getElementById("validationText").innerHTML = "<br>Passwords do not match<br>";
		document.getElementById("pass").style=" border-color:red;";
		document.getElementById("cnfPass").style=" border-color:red;";
	}
	else{
		document.getElementById('registerUserFinal').disabled = false;
		document.getElementById('registerUserFinal').click();
	}

}

</script>
<script src="src/js/fabrica.js"></script>
</html>