
<? 

	if (session_status() == 0) {
		session_start();
	}
//echo getcwd() . "\n";
	//This is to make it work in MAMP. It changes directory properly.
	chdir('../');
	

//	echo getcwd() . "\n";

	//comment these lines for production enviroment


	include_once("Classes/classes.php");
	include_once("Classes/templateclass.php"); 

	//Uncomment these lines for production environment
	//include_once("../Classes/classes.php");
	//include_once("../Classes/templateclass.php"); 

	//ini_set('error_reporting',E_ALL);
	
	Templates::PageHeader("Welcome",$Scripts);    		
?>
   
	<div class='col-md-12' id='content'>
	
	
		<?
	// Calls function to encrypt passswords from User class

	Users::encryptpass()
?>	
		
	
	</div>

	<?

	
	Templates::PageFooter();
	
	?>