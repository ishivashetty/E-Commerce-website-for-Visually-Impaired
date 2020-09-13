<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="src/css/font.css" rel="stylesheet">
	<link href="src/css/w3.css" rel="stylesheet">
	<link href="src/css/fabrica.css" rel="stylesheet">
    <title>Home Page</title>
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
	$sayName = "no";
	if(isset($_SESSION['userNameX'])){
		$sayName = "yes";
	}
  ?>

  <!-- Logo -->
  <div align="center">
      <img src="src/images/logo.png" title="Fabrica" onmousedown="speak(this.title)" style="width:60%; height:70%">
  </div>

  <!-- Headings -->
  <table style="width:100%" bgcolor="">
    <tr>
      <td width="25%"></td>
      <td width="" title="Press 1" onclick="window.open('ProductDisplay.php?display=all')";>Today's Deals</td>
      <td width="" title="Press 2" onclick="window.open('ProductDisplay.php?display=latest')";>New Arrivals</td>
      <td width="" title="Press 3" onclick="window.open('ProductDisplay.php?display=male')";>Men's Fashion</td>
      <td width="" title="Press 4" onclick="window.open('ProductDisplay.php?display=female')";>Women's Fashion</td>
      <td width="" title="Press 5" onclick="window.open('ProductDisplay.php?display=both')";>Customizations</td>
      <td width="25%"></td>
    </tr>
  </table>
<br>
<br>
  
<!-- Image Slideshow -->
<div class="slideshow-container">

  <div class="mySlides fade">
    <div class="numbertext">1 / 4</div>
    <img src="src/images/slider/1.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 4</div>
    <img src="src/images/slider/2.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 4</div>
    <img src="src/images/slider/3.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">4 / 4</div>
    <img src="src/images/slider/4.jpg" style="width:100%">
  </div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<br>
<!-- Bottom Navbar -->
	<?php
		include 'BottomNavbar.php';
	?>
   
</body>

<?php
if($sayName == "yes"){
	echo "<script>speak('Hi, ".$loggedInName."');</script>";
}
?>
	  
<script>

document.addEventListener("keypress", function(event) {
	if(document.activeElement !== document.getElementById("searchbar")) {
		if (event.keyCode == 49) {
			window.open('ProductDisplay.php?display=all');
		}
		if (event.keyCode == 50) {
			window.open('ProductDisplay.php?display=latest');
		}
		if (event.keyCode == 51) {
			window.open('ProductDisplay.php?display=male');
		}
		if (event.keyCode == 52) {
			window.open('ProductDisplay.php?display=female');
		}	
		if (event.keyCode == 53) {
			window.open('ProductDisplay.php?display=both');
		}
	}
});


/*Image Slideshow Function Definition*/
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
</script>
<script src="src/js/fabrica.js"></script>
</html>