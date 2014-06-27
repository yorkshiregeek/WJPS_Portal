<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/linksclass.php");
	
	$Scripts[0] = "Script/LinksScript.js";
	
	Templates::PageHeader("Link Management",$Scripts,"linkm",3);

?>
    		
    		    		
	<div class='col-md-12' id='content'>

		<h2 class='page-header'>Links Admin</h2>
		
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
