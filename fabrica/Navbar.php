<?php
session_start();
if(isset($_SESSION['userNameX'])){
	$loggedInName = $_SESSION['userNameX'];
?>
	<table style="width:100%" bgcolor="#707070">
    <tr>
	  <td width="30%"><div style="margin-left:5%; color:black; font-size:33px" title="Hi, <?php echo $loggedInName;?>" onclick="window.open('index.php');">Hi, <?php echo $loggedInName;?></div></td>
      <td width="">
		<input style="width:55%; margin-top:2%; margin-bottom:2%;" type="text" id="searchbar" title="Search in Fabrica (T-Shirts, Apparels and many more..)"
		placeholder="Search in Fabrica (T-Shirts, Apparels and many more..)" value="<?php if(isset($_GET['search'])) echo $_GET['search'];?>" />
		&nbsp;
		<span><img src="src/images/micoff.png" height="4%" width="3.4%" style="margin-top:1%" id="micSearch" title="Mic Off" onclick="toggleMic(this.title)"></span>
	  </td>
	  <td width="5%"><img src="src/images/cart.png" onclick="window.open('Cart.php');" title="Cart" onmousedown="speak(this.title)" height="11%" width="68%"></td>
      <td width="1%"></td>
      <td width="5%"><img src="src/images/logout.png" onclick="showLogoutPopup()" title="Logout" onmousedown="speak(this.title)"  height="4%" width="45%"></td>
      <td width="4%"></td>
    </tr>
	</table>


	<div id="modalLogout" class="w3-modal">
		<div class="w3-modal-content">
		  <div align="center" class="w3-container">
			<span onclick="document.getElementById('modalLogout').style.display='none'" class="w3-button w3-display-topright">&times;</span>
			<p>Are you sure you want to logout, <?php echo $loggedInName;?>?</p>
			<table>
				<tr>
					<td></td>
					<td>
						<input type="button" class="loginBtn" value="Yes" name="" id="userLoginBtn" onclick="window.location.href = 'Logout.php';">
					</td>
					<td>    </td>
					<td>
						<input type="button" class="loginBtn" value=" No " name="" id="userLoginBtn" onclick="document.getElementById('modalLogout').style.display='none'">
					</td>
				</tr>
			</table>
			<br>
		  </div>
		</div>
	</div>
<?php	
}
else{
?>	
	<table style="width:100%" bgcolor="#707070">
		<tr>
		  <td width="30%" onclick="window.open('index.php');"><img src="src/images/logo.png" height="38%" width="60%"></td>
		  <td width="">
			<input style="width:55%" type="text" id="searchbar" title="Search in Fabrica (T-Shirts, Apparels and many more..)"
			placeholder="Search in Fabrica (T-Shirts, Apparels and many more..)" value="<?php if(isset($_GET['search'])) echo $_GET['search'];?>" />
			&nbsp;
			<span><img src="src/images/micoff.png" height="4%" width="3.4%" style="margin-top:1%" id="micSearch" title="Mic Off" onclick="toggleMic(this.title)"></span>
		  </td>
		  <td width="5%"><img src="src/images/user.png" title="Registration" height="9%" width="60%" onmousedown="speak(this.title)" onclick="window.open('Register.php');"></td>
		  <td width="1%"></td>
		  <td width="5%"><img src="src/images/login.png" title="Login" onmousedown="speak(this.title)" onclick="window.open('Login.php');" height="10%" width="65%"></td>
		  <td width="4%"></td>
		</tr>
	</table>
<?php
}	
?>
