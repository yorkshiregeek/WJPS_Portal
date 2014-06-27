<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("Forgotten Password",$Scripts,"login",0);

?>    		
	<div class='col-md-12' id='content'>
	
		<?
			Users::forgottenpassword();
		?>
			
	</div>
	
<?

	Templates::PageFooter();

?>