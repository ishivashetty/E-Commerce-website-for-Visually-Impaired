<?php
	if(isset($_GET['pdid'])){
		$did = $_GET['pdid'];

		include 'db.php';
		
		$deleteQuery = "DELETE FROM PRODUCTS WHERE ID = '$did';";
		$res=mysqli_query($dbc,$deleteQuery);
		if($res){
			header('location:DeleteProducts.php');
		}
		else{
			echo "<script>alert('Record not Deleted')</script>";
		}	
	}
?>