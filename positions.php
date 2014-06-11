<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/positionsclass.php");
	
	$Scripts[0] = "Script/DirectoryScript.js";
	
	Templates::PageHeader("Directory",$Scripts);

	if(Users::logincheck(3) > 0){
 		Menu::generateadminmenu("directory"); 
 	} else {
 		Menu::generatemenu("login");
 	}
 	
?>
	
	    		
	<div id="content">
	
		<hr/>
	
		<h1>Directory Admin</h1>
		
		
		
		<? 
		
			print("<ul class=\"tabs\">");
				
				print("<li><a href=\"directory.php\">Manage Trusts</a></li>");
				print("<li class=\"selected\"><a href=\"positions.php\">Manage Positions</a></li>");
				print("<li ><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
				
			print("</ul>");
			
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
		
	</div>
	
<?

	Templates::PageFooter();

?>