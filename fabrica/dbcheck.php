<html>
    <head>
        <meta charset="UTF-8">
        <title>Database Connection Check</title>
    </head>
    <body>
        <?php
		$db_name ="fabrica";	//Change as per your DB Name

		$mysql_hostname = "localhost";	//Default
		$mysql_user = "root";			//Default
		$mysql_password = "";			//Default
		$mysql_database = $db_name;
		$dbc = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("oops !Could not connect database");
		mysqli_select_db($dbc,$mysql_database) or die("opps! database not connected");
		echo 'Database Connected : '.$mysql_database;
        ?>
    </body>
</html>
