<?php
	if(isset($_GET['removePID'])){
		$UIDX = $_GET['removeUID'];
		$PIDX = $_GET['removePID'];
		
		include 'db.php';
				
		$removeProdQuery = "DELETE FROM CART WHERE CUSTOMER_ID = '$UIDX' AND PRODUCT_ID = '$PIDX';";
		$res = mysqli_query($dbc,$removeProdQuery);
		if($res){
			header('location:Cart.php');
		}
		else{
			echo "<script>alert('Record not Deleted')</script>";
		}	
	}
	else{
		header('location:Cart.php');
	}	
?>