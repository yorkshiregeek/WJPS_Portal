<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("Forgotten Password",$Scripts);

	Menu::generatemenu("login");
    		 	
?>    		
	<div id="content">
	
		<hr/>
		
			<h1>Restricted Area</h1>
	
		<?
			Users::forgottenpassword();
		?>
			
	</div>
	
<?

	Templates::PageFooter();

?>