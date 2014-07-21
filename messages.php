<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/messageclass.php");
	
	$Scripts[0] = "Script/MessageScript.js";
	
	Templates::PageHeader("Messages",$Scripts,"messages",1);
 	
?>
    		    		
	<div class='col-md-12' id='content'>
		
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
	
				Print("<h2 class='page-header'>Messages</h2>");
				
				if($MID){
					if($AID){
					
						echo("Delete");
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
