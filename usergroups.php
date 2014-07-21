<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("User Groups", $Scripts,"users",3);
	    	
	/*if(Users::logincheck(3) > 0){
 		Menu::generateadminmenu("users"); 
 	} else {
 		Menu::generatemenu("login");
 	}*/
 	
?>
    		    		
	<div class='col-md-12' id='content'>

		<h2 class='page-header'>User Groups</h2>
		
		<? 
		
			if(Users::login(3) || Users::logincheck(3)){
		
				$UGID = $_GET["ugid"];
				$AID = $_GET["aid"];
				
				if($UGID && !$AID){
					UserCategory::addedit($UGID);
				} else {
					//Show List
					if($AID){
						//Delete
						UserCategory::deleteusergroup($UGID);
					}
					UserCategory::listall();
				}
			
			}
		
		?>
		
	</div>
	
<?

	Templates::PageFooter();

?>