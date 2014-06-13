<?

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/noticesclass.php");
	include_once("Classes/documentsclass.php");
	include_once("Classes/sectionsclass.php");
	include_once("Classes/groupsclass.php");
	include_once("Classes/templateclass.php");
	
	Templates::PageHeader("Restricted Area",$Scripts);
    		
	$UID = Users::logincheck(0);

	if($UID > 0){    				
		$User = new Users($UID);
		$User->getusermenu("welcome"); 
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
    			
    			<h2>Welcome <? 
    			$User = new Users($UID);
    			$Name = $User->getusername();
    			print($Name).',';


    			 ?> </h2>
    			
    			<p>Welcome to the restricted area of <? print(SITENAME); ?> website. From here you can view <a href="documents.php">documents</a> and <a href="notices.php">notices</a>.</p>
    			
    			<p>The latest notices added to the system are shown below:</p>
    			
    		<?
    			
    			Notices::lastnotices();
    		
    		?>
    		
    			<p>The latest documents added to the system are shown below:</p>
    			
    		<?
    		
    			Documents::lastdocuments();
    			
			}
			?>
			
		
			
 		</div>
<?

	Templates::PageFooter();

?>
