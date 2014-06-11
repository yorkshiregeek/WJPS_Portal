<?

	include_once("../classes.php");

	$Str = $_POST["str"];
	
	echo(crypt('abc123','$1$rasmusle$'));

?>