<?php
	session_start();
	$linkX = '';
	
	if(isset($_GET['display'])){
		$linkX = 'location:ProductDisplay.php?display='.$_GET['display'];
	}
	else if(isset($_GET['search'])){
		$linkX = 'location:ProductDisplay.php?search='.$_GET['search'];
	}
	else{
		$linkX = 'location:ProductDisplay.php?display=all';
	}	
	
	if(isset($_SESSION['userIDX'])){
		if(isset($_POST['addedToCart'])){
			
			$cartUID = $_SESSION['userIDX'];
			$cartPID = $_POST['productIDX'];
			$cartQTY = $_POST['productQty'];
			include 'db.php';
			
			$cartExistsQuery="SELECT ID FROM CART WHERE CUSTOMER_ID = '$cartUID' AND PRODUCT_ID = '$cartPID'";
			$res=mysqli_query($dbc,$cartExistsQuery);
			$num=mysqli_num_rows($res);
			
			if($num==0){
				$query = "INSERT INTO CART(CUSTOMER_ID, PRODUCT_ID, QUANTITY) VALUES('$cartUID', '$cartPID', '$cartQTY' );";
				$result = mysqli_query($dbc,$query);

				if($result){
					header($linkX.'&state=added');
				}
				else{
					echo "<script>alert('Record not Inserted')</script>";
				}	
			}
			else{
				header($linkX.'&state=itemExists');
			}
		}		
	}
	else{
		header($linkX.'&state=loginRequired');
	}	
?>