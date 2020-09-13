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
	
    <title>Gallery</title>
	<script>
		function speak(voice){
			var msg = new SpeechSynthesisUtterance(voice);
			window.speechSynthesis.speak(msg);
		}
	</script>

</head>
<body>

  <?php
	include('Navbar.php');
  ?>

  <br> 


  <!-- About Us Section -->
  <div align="center">
    <font size="6" title="About Us" onclick="speak(this.title)">ABOUT US</font>
  </div>

  <p>
    <font size="4">
      Fabrica was started with the idea of selling products that are unique and innovative. Initially starting with Customised T-shirts, we've ventured into various fashionable products. We Hope to provide superior quality products without burning a hole in your pocket! Our e-commerce venture &lt; <u> <b> www.fabrica.in </b> </u> &gt; , just-in-vogue collection is now accessible to a national clientele. Whether you are in Mumbai, Delhi, Chennai or any corner of the country, we're just a click away. #HappyShoping :) 
     </font>
  </p>

  <hr>

  <div align="center">
    <font size="6">SHIPPING POLICY</font>
  </div>

  <p>
    <font size="4">
      All orders in India are shipped through registered domestic courier companies and /or speed post only. Orders are shipped within 3-6 working days or as per the delivery date agreed at the time of order confirmation and delivering of the shipment subject to Courier Company / Post Office norms. Fabrica is not liable for any delay in delivery by the courier company / postal authorities and only guarantees to hand over the consignment to the courier company or postal authorities within 3-6 working days from the date of the order and payment or as per the delivery date agreed at the time of order confirmation.
     </font>
  </p>

  <hr>

  <div align="center">
    <font size="6">CONTACT US</font>
  </div>

  <p style="text-align:center;">
    <font size="4">
      Feel free to mail us at <font color="orange"><i>support@fabrica.in</i></font>
      <br>
      &reg;&nbsp;&apos;Fabrica&apos;
     </font>
  </p>





<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
   

   
</body>

<script src="src/js/fabrica.js"></script>
</html>