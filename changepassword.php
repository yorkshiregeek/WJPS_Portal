<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("Change Password",$Scripts,"changepassword",0);
    		 	
?>    		
		<div class='col-md-12' id='content'>
		
			<?
			if(Users::login(0)){
			?>
    			
    			<h2 class='page-header'>Change Password</h2>
    			
			<?
			
				Users::changepassword();
				
			}
			?>

 		</div>
    	
<?

	Templates::PageFooter();

?>