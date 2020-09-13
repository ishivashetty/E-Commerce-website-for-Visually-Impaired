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
	
    <title>Gallery</title>
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

  <br> <br>

  <!-- Gallery Section -->

  <div align="center" style="font-size:35px">GALLERY</div>

  <br>

  <table style="" bgcolor="">
    <tr>
      <td width="5%"></td>
      <td width="10%" height="10%" width="20%">
        <img src="src/images/products/2.jpg">
      </td>
      <td width="10%">
        <img src="src/images/products/10.jpg">
      </td>     
    </tr>
  </table>

  <br> <br>

  <table style="" bgcolor="">
    <tr>
      <td width="5%"></td>
      <td width="10%" height="10%" width="20%">
        <img src="src/images/products/12.jpg">
      </td>
      <td width="10%">
        <img src="src/images/products/16.jpg">
      </td>     
    </tr>
  </table>

  <br> <br>

  <table style="" bgcolor="">
    <tr>
      <td width="5%"></td>
      <td width="10%" height="10%" width="20%">
        <img src="src/images/products/4.jpg">
      </td>
      <td width="10%">
        <img src="src/images/products/8.jpg">
      </td>     
    </tr>
  </table>

<br>
<br>
  
<!-- Bottom Navbar -->
<?php
	include 'BottomNavbar.php';
?>

   
</body>

<script src="src/js/fabrica.js"></script>
</html>