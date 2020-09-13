<?php session_start();?>
<?php
	if(!isset($_SESSION['adminName']))
	{
		header('location:AdminLogin.php');
	}
?>
<table style="width:100%" bgcolor="#707070">
    <tr>
	  <td width="30%" title="Fabrica" onclick="speak(this.title)"><img src="src/images/logo.png" height="40%" width="60%"></td>
      <td width="55%"><div style="font-size:35px; margin-left:22%" title="Admin Dashboard" onclick="speak('Admin Dashboard');">Admin Dashboard</div></td> 
      <td width="5%" onclick="window.open('AdminDashboard.php');" title="Admin Dashboard" onmousedown="speak(this.title)" ><img src="src/images/user.png" height="10%" width="65%"></td>
      <td width="1%"></td>
      <td width="5%"><img src="src/images/logout.png" title="Logout" onmousedown="speak(this.title)" onclick="showLogoutPopup()" height="4.5%" width="60%"></td>
      <td width="4%"></td>
    </tr>
 </table>
	
<div id="modalLogout" class="w3-modal">
	<div class="w3-modal-content">
	  <div align="center" class="w3-container">
		<span onclick="document.getElementById('modalLogout').style.display='none'" class="w3-button w3-display-topright">&times;</span>
		<p>Are you sure you want to logout, <?php echo $_SESSION['adminName'];?>?</p>
		<table>
			<tr>
				<td></td>
				<td>
					<input type="button" class="loginBtn" value="Yes" name="" id="userLoginBtn" onclick="window.location.href = 'AdminLogout.php';">
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
