<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/noticesclass.php");
	
	$Scripts[0] = "Script/NoticesScript.js";
	$Scripts[1] = "js/nicEdit.js";  

	?>

	

	Templates::PageHeader("Notices",$Scripts,"notices",1);

 	
?>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
    		    		

	<div class='col-md-12' id='content'>


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
				
					Print("<h2 class='page-header'>Notices Admin</h2>");
				
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
					
					Print("<h2> class='page-header'>Notices</h2>");
					
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
