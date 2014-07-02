<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/positionsclass.php");
	
	$Scripts[0] = "Script/DirectoryScript.js";
	
	Templates::PageHeader("Directory",$Scripts,"directory",3);

?>
	
	    		
	<div class='col-md-12' id='content'>

		<h2 class='page-header'>Directory Admin</h2>
		
		
		
		<? 
		
			print("<ul class=\"nav nav-tabs\">");
				
				print("<li><a href=\"directory.php\">Manage Trusts</a></li>");
				print("<li class=\"active\"><a href=\"positions.php\">Manage Positions</a></li>");
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
			<script type="text/javascript" src="js/jquery-sortable.js"></script>
			<script type="text/javascript" src="js/jquery-draggable.js"></script>
			

	</div>
	
<?

	Templates::PageFooter();

?>
			
