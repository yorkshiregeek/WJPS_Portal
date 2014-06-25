<? 

	session_start();

	include_once("Classes/classes.php");
	
	Templates::PageHeader("Logout",$Scripts);
   	
	Menu::generatemenu("Login"); 

?>
    		
    		    		
	<div class='col-md-10' id='content'>
	
		<hr/>
	
		<h1>Restricted Area</h1>
		    			
		<? 
		
			Users::logout();
		
		?>
		
	</div>
    	
<?

	Templates::PageFooter();

?>