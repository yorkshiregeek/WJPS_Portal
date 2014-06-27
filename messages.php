<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/messageclass.php");
	
	$Scripts[0] = "Script/MessageScript.js";
	$Scripts[1] = "js/nicEdit.js";  
	
	Templates::PageHeader("Messages",$Scripts);
	
	if(Users::logincheck(1) > 0){
		
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			Menu::generateadminmenu("messages");
		} else {
			Menu::generateusermenu("messages");
		}
	 	} else {
 		Menu::generatemenu("login");
 	}
 	
?>
    <script type="text/javascript">
		bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	</script>    		
	<div class='col-md-10' id='content'>
	
		<hr/>
		
		<? 
		
			$MID = $_GET["mid"];
			
			$AID = $_GET["aid"];
			
			//AID
			//EDIT = 5
			//DELETE = 10
		
			if(Users::login(1) || Users::logincheck(1)){
				//DocumentAdmin	
				$UID = Users::logincheck(1);
			
				$User = new Users($UID);
	
				Print("<h1>Messages</h1>");
				
				if($MID){
					if($AID){
					
						Messages::deletemessage($MID);
					
						Messages::listall();
				
					} else {
				
						if($MID <= 0){
							//Add
							Messages::addedit(-1);
						} else {
							//Show
							Messages::showmessage($MID);
						}
					
					}
					//Messages::showmessage($MID);
				} else {
					Messages::listall();
				}

			} 
			    			
		?>
		
	</div>
<?

	Templates::PageFooter();

?>
