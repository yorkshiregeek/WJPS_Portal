<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/positionsclass.php");
	
	$Scripts[0] = "Script/DirectoryScript.js";
	
	

	
 	
?>
	
	    		
	
	

	
	
		
		
		
		<? 
		
		
			print("<div class=\"directory\">");
		
			if(Users::login(3) || Users::logincheck(3)){
		
				$PID = $_GET["pid"];
				$AID = $_GET["aid"];
				$DIR = $_GET["dir"];
				
				if($PID && !$AID){
					if($DIR)
					{
						Positions::moveposition($PID,$DIR);
						Positions::listall();
					} else {
						Positions::addedit($PID);
					}
				} else {
					//Show List
					if($AID){
						//Delete
						Positions::deleteposition($PID);
					}
					Positions::listall();
				}
			
			}
			
			print("</div>");
		
		?>
		

	
