<?

	session_start();

 	include_once("Classes/classes.php");
 	include_once("Classes/linksclass.php"); 
 	
 	$Scripts[0] = "Script/LinksScript.js";
 	
 	Templates::PageHeader("Links",$Scripts);
	    	
	$Admin = $_GET["man"];

	if(Users::logincheck(1) > 0){
		
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			if($Admin){
				Menu::generateadminmenu("linksm");
			} else {
				Menu::generateadminmenu("links");
			}
		} else {
			Menu::generateusermenu("links");
		}
	 	} else {
 		Menu::generatemenu("links");
 	}
 	
?>
    		
	<div id="content">
	
		<hr/>
    			
		<?
		
			$LID = $_GET["lid"];
			
			$AID = $_GET["aid"];
			
			//AID
			//EDIT = 5
			//DELETE = 10
			
			if(Users::logincheck(1)){
				//Links Admin
				$UID = Users::logincheck(1);
				
				$User = new Users($UID);
				
				if($User->getuserlevel() >= 2){
					
						print("<h1>Links Admin</h1>");
						//print("<h2>Links</h2>");
						
						if($LID){
							if($AID){
							
								Links::deletelink($LID);
								
								Links::listall();
							} else {
							
								if($LID <= 0){
									//Add
									Links::addedit(-1);
								} else {
									Links::addedit($LID);
								}
							}
						} else {
							//List
							if($Admin){
								Links::listall();
							} else {
								Links::showall();
								
							}
						}
					
					
					
				} else {
					//Show All
					print("<h1>" . SITENAME . " Links</h1>");
					
					
					Links::showall();
				}
		
			} else {
				//Show All
					print("<h1>" . SITENAME . " Links</h1>");
					
					
					Links::showall();
			}
		?>
		
	</div>

<?

	Templates::PageFooter();

?>