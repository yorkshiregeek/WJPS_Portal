<? 

	session_start();

	include_once("Classes/classes.php");
	
	$Scripts[0] = "Script/UserFormScript.js";
	
	Templates::PageHeader("Change Password",$Scripts);

	if(Users::logincheck(0) > 0){
		$UID = $_SESSION["userid"];
		
		$User = new Users($UID);
		$User->getusermenu("changepassword"); 
 	} else {
 		Menu::generatemenu("login");
 	}
    		 	
?>    		
		<div id="content">
		
			<hr/>
		
			<h1>Restricted Area</h1>
		
			<?
			if(Users::login(0)){
			?>
    			
    			<h2>Change Password</h2>
    			
			<?
			
				Users::changepassword();
				
			}
			?>

 		</div>
    	
<?

	Templates::PageFooter();

?>