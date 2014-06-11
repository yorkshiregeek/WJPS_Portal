<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("User Admin", $Scripts);
	    	
	if(Users::logincheck(3) > 0){
 		Menu::generateadminmenu("users"); 
 	} else {
 		Menu::generatemenu("login");
 	}
 	
?>
    		    		
	<div id="content">
	
		<hr/>
	
		<h1>User Admin</h1>
		
		<? 
		
			if(Users::login(3) || Users::logincheck(3)){
		
				$UID = $_GET["uid"];
				$AID = $_GET["aid"];
				$RID = $_GET["rid"];
				
				if($UID && !$AID){
					Users::addedit($UID);
				} else if($RID) {
					Users::resetpassword($RID);
				} else {
					//Show List
					if($AID){
						//Delete
						Users::deleteuser($UID);
					}
					Users::listall();
				}
			
			}
		
		?>
		
	</div>
	
<?

	Templates::PageFooter();

?>