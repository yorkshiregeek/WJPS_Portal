<? 

	session_start();
	
	include_once("Classes/classes.php");

	Users::logout();

	Templates::PageHeader("Logout",$Scripts,"logout",0);


?>
    		
    		    		
	<div class='col-md-12' id='content'>

		<? 
		
			print("<h2 class='page-header'>Logged Out</h2>");
    		print("<p class='lead'>You are now logged out</p>");
    		print("<p><a href=\"index.php\">Click here</a> to return to the homepage.</p>");
		
		?>
		
	</div>
    	
<?

	Templates::PageFooter();

?>