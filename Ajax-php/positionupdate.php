<?
chdir("..");
include_once("Classes/classes.php");
include_once("Classes/positionsclass.php");

$Input = $_POST["info"];

if($Input){

	$count = 1;

	foreach ($Input as $ID)
	{
		
		$Position = new Positions($ID);

		$Position->setorder($count);

		$Position->save();

		$count += 1;
	
	}

}


?>