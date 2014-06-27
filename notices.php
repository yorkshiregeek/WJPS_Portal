<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/noticesclass.php");
	
	$Scripts[0] = "Script/NoticesScript.js";
	$Scripts[1] = "js/nicEdit.js";  

	?>

	

	<?
	Templates::PageHeader("Notices",$Scripts);

	
	if(Users::logincheck(1) > 0){
		
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			Menu::generateadminmenu("notices");
		} else {
			Menu::generateusermenu("notices");
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
		
			$NID = $_GET["nid"];
			
			$AID = $_GET["aid"];
			
			//AID
			//EDIT = 5
			//DELETE = 10
		
			if(Users::login(1) || Users::logincheck(1)){
				//DocumentAdmin	
				$UID = Users::logincheck(1);
			
				$User = new Users($UID);
			
				if($User->getuserlevel() >= 2){
				
					Print("<h1>Notices Admin</h1>");
				
					if($NID){
						if($AID){
						
							Notices::deletenotice($NID);
						
							Notices::listadmin();
					
						} else {
					
							if($NID <= 0){
								//Add
								Notices::addedit(-1);
							} else {
								//Show
								Notices::shownotice($NID);
							}
						
						}
					} else {
						//List
						Notices::listadmin();
					} 						
				} else {
					
					Print("<h1>Notices</h1>");
					
					if($NID){
						Notices::shownotice($NID);
					} else {
						Notices::listall();
					}
				
				}
			
			} 
			  
				
		?>
		
	</div>
<?

	Templates::PageFooter();

?>
