<? 

	session_start();
	include_once("Classes/classes.php"); 
	
	Templates::PageHeader("Welcome",$Scripts);

	if(Users::logincheck(3) > 0){
		Menu::generateadminmenu("home");
	} else if(Users::logincheck(1) > 0){
		Menu::generateusermenu("home");
	 	} else {
 		Menu::generatemenu("home");
 	} 
    		
?>
   
	<div id="content">
	
		<hr/>
	
		<h1>Association of Teaching Hospital Pharmacists</h1>
		<h2>Website</h2>
		
		<p>Welcome text to go here.</p>
		
	</div>
	
	<?
	
	Templates::PageFooter();
	
	?>