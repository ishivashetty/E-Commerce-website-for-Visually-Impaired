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
    <title>Login</title>
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
	
	$userLoginDone = "no";
	
	if(isset($_POST['UserLogin'])){
		include 'db.php';
		$email = $_POST['userEmail'];
		$password = $_POST['userPass'];
		$userLoginQuery="select name as name, customer_id as id from login where email='$email' and password='$password';";
		
		$res=mysqli_query($dbc,$userLoginQuery);

		$count=mysqli_num_rows($res);
		
		if($count!=0){
			$data = mysqli_fetch_array($res);
			$uname = $data['name'];
			$uname = explode(" ", $uname);
			$_SESSION['userNameX'] = $uname[0];
			$_SESSION['userIDX'] = $data['id'];
			header('location:index.php');
		}
		else{
			$userLoginDone = "failed";
		}
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
            <img src="src/images/products/14.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">2 / 4</div>
            <img src="src/images/products/11.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">3 / 4</div>
            <img src="src/images/products/10.jpg" style="width:100%">
          </div>
          <div class="mySlides fade">
            <div class="numbertext">4 / 4</div>
            <img src="src/images/products/13.jpg" style="width:100%">
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

      <!-- Login Section -->
      <td align="center">
        <div align="center" style="font-size:35px">LOGIN</div>
        <form method="post">
        <br>
		<input type="text" class="login" placeholder="Email ID" id="userEmail" name="userEmail" maxlength="50"/>
        <br><br>
		<input type="Password" class="login" placeholder="Password" id="userPass" name="userPass" maxlength="20"/>
        <div id="validationText" align="center" style="margin-top:0%; margin-bottom:3%" class="valError">
			
		</div>
		
        <table>
        <tr>
          <td width="45%">
			<input type="button" class="loginBtn" value="Login" name="" id="userLoginBtn" onclick="validateUserLogin();">
			<input type="submit" hidden disabled class="" value="UserLogin" name="UserLogin" id="userLoginFinal">
          </td>
          <td width="10%">
          <td width="45%">
			<input type="reset" class="loginBtn" value="Reset" name="" id="userResetBtn" onclick="resetUserValidation();">
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


	<div id="loginFailedModal" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('loginFailedModal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Invalid Credentials</p>
			<p>Please try again</p>
		  </div>
		</div>
	</div>
   
   
</body>

<?php
if($userLoginDone == "failed"){
	echo "<script>speak('Invalid Credentials');</script>";
	echo "<script>document.getElementById('loginFailedModal').style.display='block';</script>";
}
?>

<script>

document.getElementById("userEmail").focus();

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
  setTimeout(showSlides, 2000);
}

function resetUserValidation(){
	document.getElementById("validationText").innerHTML = "";
	document.getElementById("userEmail").style="";
	document.getElementById("userPass").style="";
}

function validateUserLogin(){
	resetUserValidation();
	
	var email = document.getElementById("userEmail").value;
	var pass = document.getElementById("userPass").value;
	
	if(isEmpty(email) && isEmpty(pass)){
		speak('All Fields are empty');
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("userEmail").style=" border-color:red;";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(isEmpty(email)){
		speak('Email ID Empty');
		document.getElementById("validationText").innerHTML = "<br>Email ID Empty<br>";
		document.getElementById("userEmail").style=" border-color:red;";
	}
	else if(!isEmail(email)){
		speak('Email ID Invalid');
		document.getElementById("validationText").innerHTML = "<br>Email ID Invalid<br>";		
		document.getElementById("userEmail").style=" border-color:red;";
	}
	else if(isEmpty(pass)){
		speak('Password Empty');
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(pass.length<6){
		speak('Password should contain minimum 6 characters');
		document.getElementById("validationText").innerHTML = "<br>Password should contain minimum 6 characters<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else if(!isPassword(pass)){
		speak('Password should be Alphanumeric');
		document.getElementById("validationText").innerHTML = "<br>Password should be Alphanumeric<br>";
		document.getElementById("userPass").style=" border-color:red;";
	}
	else{
		document.getElementById('userLoginFinal').disabled = false;
		document.getElementById('userLoginFinal').click();
	}

}

</script>
<script src="src/js/fabrica.js"></script>
</html>