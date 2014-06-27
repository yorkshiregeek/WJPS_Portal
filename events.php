<? 

	session_start();

	include_once("Classes/classes.php");
	
	include_once("Classes/eventsclass.php");
	include_once("Classes/noticesclass.php");
	
	$Scripts[0] = "Script/EventsScript.js";
	$Scripts[1] = "js/nicEdit.js";  
	
	
	Templates::PageHeader("Events",$Scripts);

	$Admin = $_GET["man"];

	if(Users::logincheck(1) > 0){
	
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			if($Admin){
				Menu::generateadminmenu("eventsm"); 
			} else {
				Menu::generateadminmenu("events");
			}
		} else {
			Menu::generateusermenu("events");
		}
 	} else {
 		Menu::generatemenu("login");
 	}
    		 	
?>    		
	<!--This is needed to add the toolbar into any element that is defined as textarea -->
	<script type="text/javascript">
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>
    		    		
	<div class='col-md-10' id='content'>
	
		<hr/>
	
		
		
		<? 
		
			if(Users::login(1) || Users::logincheck(1)){
		
				$EID = $_GET["eid"];
				$AID = $_GET["aid"];
				
				$UID = Users::logincheck(1);
			
				$User = new Users($UID);
			
				if($User->getuserlevel() >= 2){
				
					print("<h1>Events Admin</h1>");
				
    				if($EID && !$AID){
    					Events::addedit($EID);
    				} else {
    					//Show List
    					if($AID){
    						//Delete
    						Events::deleteevent($EID);
    					}
    					Events::listall();
					}
					
				} else {
				
					print("<h1>Events</h1>");
				
					Events::showall();
				
				}
			
			}
		
		?>
		
	</div>

<?

	Templates::PageFooter();
	
?>