<?

	include_once("../classes.php");

	$RQ = new ReadQuery("SELECT * FROM Users");
	
	while($row = mysql_fetch_array($RQ->getresults())){
	
		$WQ = new WriteQuery("UPDATE Users SET Password = '" . Crypt($row["Password"],'$1$rasmusle$') . "' WHERE IDLNK = " . $row["IDLNK"] . ";");
	}
	
	echo("Done");

?>