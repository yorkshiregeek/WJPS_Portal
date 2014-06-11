<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/linksclass.php");
	
	$Scripts[0] = "Script/LinksScript.js";
	
	Templates::PageHeader("Link Management",$Scripts);
    	
	if(Users::logincheck(3) > 0){
 		Menu::generateadminmenu("linkm"); 
 	} else {
 		Menu::generatemenu("login");
 	}
    		 	
?>
    		
    		    		
	<div id="content">
	
		<hr/>
	
		<h1>Links Admin</h1>
		
		<? 
		
			if(Users::login(3) || Users::logincheck(3)){
		
				$LID = $_GET["lid"];
				$AID = $_GET["aid"];
				
				if($LID && !$AID){
					Links::addedit($LID);
				} else {
					//Show List
					if($AID){
						//Delete
						Links::deletelink($LID);
					}
					Links::listall();
				}
			
			}
		
		?>
		
	</div>
	
<?

	Templates::PageFooter();

?>
