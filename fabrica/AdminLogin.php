<?php
	session_start();
	$loginDone = "no";
	
	if(isset($_POST['Login']))
	{
		include 'db.php';
		$email = $_POST['adminEmail'];
		$password = $_POST['adminPass'];
		$que="select name from admin where email='$email' and password='$password';";
		
		$res=mysqli_query($dbc,$que);

		$count=mysqli_num_rows($res);
		
		if($count!=0){
			$data=mysqli_fetch_array($res);
			$_SESSION['adminName']=$data['name'];
			header('location:AdminDashboard.php');
		}
		else{
			$loginDone = "failed";
		}		
	}
?>

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
	
    <title>Admin Login</title>
    <script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>
</head>
<body>

  
	<div align="center">
      <img src="src/images/logo.png" title="Fabrica" onclick="speak(this.title)" style="width:40%; height:50%">
	</div>
  
      <!-- Login Section -->

		<center><span style="font-size:35px" title="Admin Login" onclick="speak(this.title)">ADMIN LOGIN</span><br>
        <form name="adminLoginForm" method="post">
        <br>
        <input type="text" class="login" placeholder="Email ID" id="adminEmail" name="adminEmail" title="Email ID" maxlength="50" style="width:30%"/>
        <br><br>
        <input type="Password" class="login" placeholder="Password" id="adminPass" name="adminPass" title="Password" maxlength="20" style="width:30%"/>

		
		<div id="validationText" align="center" style="margin-top:0%; margin-bottom:1%" class="valError">
			
		</div>
		
        <table style="width=100%">
        <tr>
          <td width="35%">
            <input type="button" class="loginBtn" value="Login" name="" id="adminLoginBtn" title="Login"  onclick="validateAdminLogin();">
			<input type="submit" hidden disabled value="Login" name="Login" id="adminLoginFinal">
          </td>
          <td width="10%">
          <td width="35%">
            <input type="reset" class="loginBtn" value="Reset" name="" id="adminResetBtn" title="Reset" onclick="speak(this.title); resetAdminValidation();">
          </td>
        </tr>
		</table>
		</form>
		</center>
		
	
<br>
<br>
<br>
  
<!-- Bottom Navbar -->

<?php
	include 'BottomNavbar.php';
?>


	<div id="modal1" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('modal1').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Invalid Credentials</p>
			<p>Please try again</p>
		  </div>
		</div>
	</div>
   
</body>

<?php
if($loginDone == "failed"){
	echo "<script>speak('Invalid Credentials');</script>";
	echo "<script>document.getElementById('modal1').style.display='block';</script>";
}
?>

<script>
document.getElementById("adminEmail").focus();

function resetAdminValidation(){
	document.getElementById("validationText").innerHTML = "";
	document.getElementById("adminEmail").style="width:30%;";
	document.getElementById("adminPass").style="width:30%;";
}

function validateAdminLogin(){
	resetAdminValidation();
	
	var email = document.getElementById("adminEmail").value;
	var pass = document.getElementById("adminPass").value;
	
	if(isEmpty(email) && isEmpty(pass)){
		speak('All Fields are empty');
		document.getElementById("validationText").innerHTML = "<br>All Fields are empty<br>";
		document.getElementById("adminEmail").style="width:30%; border-color:red;";
		document.getElementById("adminPass").style="width:30%; border-color:red;";
	}
	else if(isEmpty(email)){
		speak('Email ID Empty');
		document.getElementById("validationText").innerHTML = "<br>Email ID Empty<br>";
		document.getElementById("adminEmail").style="width:30%; border-color:red;";
	}
	else if(!isEmail(email)){
		speak('Email ID Invalid');
		document.getElementById("validationText").innerHTML = "<br>Email ID Invalid<br>";		
		document.getElementById("adminEmail").style="width:30%; border-color:red;";
	}
	else if(isEmpty(pass)){
		speak('Password Empty');
		document.getElementById("validationText").innerHTML = "<br>Password Empty<br>";
		document.getElementById("adminPass").style="width:30%; border-color:red;";
	}
	else if(pass.length<6){
		speak('Password should contain minimum 6 characters');
		document.getElementById("validationText").innerHTML = "<br>Password should contain minimum 6 characters<br>";
		document.getElementById("adminPass").style="width:30%; border-color:red;";
	}
	else if(!isPassword(pass)){
		speak('Password should be Alphanumeric');
		document.getElementById("validationText").innerHTML = "<br>Password should be Alphanumeric<br>";
		document.getElementById("adminPass").style="width:30%; border-color:red;";
	}
	else{
		document.getElementById('adminLoginFinal').disabled = false;
		document.getElementById('adminLoginFinal').click();
	}

}


</script>
<script src="src/js/fabrica.js"></script>
</html>