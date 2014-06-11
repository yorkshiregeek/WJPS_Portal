<? 

	set_time_limit(120);
	ini_set(max_execution_time,"120");

	session_start();

	include_once("Classes/classes.php");
	
	include_once("Classes/groupsclass.php");
	include_once("Classes/sectionsclass.php");
	include_once("Classes/documentsclass.php");
	include_once("Classes/noticesclass.php");
	
	$Scripts[0] = "Script/DocumentsScript.js";
	
	Templates::PageHeader("Documents",$Scripts);
    	
	if(Users::logincheck(1) > 0){
		
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			Menu::generateadminmenu("documents");
		} else {
			Menu::generateusermenu("documents");
		}
	 	} else {
 		Menu::generatemenu("login");
 	}
    		 	
?>
    			    		
	<div id="content">
	
		<hr/>
		
		<? 
		
			$GID = $_GET["gid"];
			$SGID = $_GET["sgid"];
			$SID = $_GET["sid"];
			$DSID = $_GET["dsid"];
			$DID = $_GET["did"];
			
			$AID = $_GET["aid"];
			
			//AID
			//EDIT = 5
			//DELETE = 10
		
			if(Users::login(1) || Users::logincheck(1)){
				//DocumentAdmin	
				$UID = Users::logincheck(1);
			
				$User = new Users($UID);
			
				if($User->getuserlevel() >= 2){
				
					Print("<h1>Document Admin</h1>");
				
					if($GID){
						//Group Related Activity
						if($AID)
						{
							//Edit or Delete
							if($AID == 5){
								Groups::addedit($GID);
							} else if($AID == 10){
								Groups::deletegroup($GID);
								Groups::listadmin();
							}
						} else {
							//Add or Show
							if($GID < 0 ){
								//Add New Group
								Groups::addedit(-1);
							} else {
								//Show Group
								Sections::listadmin($GID);
							}
						} 
					} elseif($SID) {
						//Section Related Activity
						if($AID){
							//Edit or Delete
							if($AID == 5){
								Sections::addedit($SID,$SGID);
							} else if($AID == 10) {
								Sections::deletesection($SID);
								Sections::listadmin($SGID);
							}
						} else {
							//Add or Show
							if($SID < 0 ){
								Sections::addedit(-1,$SGID);
							} else {
								Documents::listadmin($SID);
							}
						
						}
					} elseif($DID) {
						//Document Related Activity
						if($AID){
							//Edit or Delete
							if($AID == 5){
								Documents::addedit($DID,$DSID);
							} else if($AID == 10) {
								Documents::deletedocument($DID);
								Documents::listadmin($DSID);
							}
						} else {
							//Add or Show
							if($DID < 0){
								Documents::addedit(-1,$DSID);
							} else {
								//Download
								//Documents::
							}
						}
					} else {
						Groups::listadmin();
					}
					
				} else {
					
					Print("<h1>Documents</h1>");
					
					if($GID){
						Sections::listall($GID);
					} else if($SID) {
						Documents::listall($SID);
					} else {
						Groups::listall();
					}
				
				}
			
			} 
			    			
		?>
		
	</div>
    	
<?

	Templates::PageFooter();

?>