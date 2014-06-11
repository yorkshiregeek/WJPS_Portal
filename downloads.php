<?

	session_start();

	include_once("Classes/classes.php"); 
	
	include_once("Classes/groupsclass.php");
	include_once("Classes/sectionsclass.php");
	include_once("Classes/documentsclass.php");
	
	//echo("Hello");

	$UID = Users::logincheck(0);
    	
    if($UID > 0){
    
    	$DID = $_GET["did"];
    	
    	if(ISSET($DID)){
    	
    		$Document = new Documents($DID);
    
	    	//$file = FILELOC . "/" . $DID . "-" . $Document->getfilename();



$file = FILELOC . "/" . $DID ;

//$file = 'private/124';

//echo($file);
	    	
	    	header("Content-length: " . $Document->getfilesize());
	    	header("Content-type: " . $Document->getfiletype());
	    	//str_replace(, mixed replace, mixed subject, int, [replace_count])
	    	//header("Content-Disposition: attachment; filename=" . str_replace(" ", "_", $Document->getfilename()));
	    	
	    	header("Content-disposition: attachment; filename=\"" . basename($Document->getfilename()) . "\"");
	    	//header("Content-disposition: attachment; filename='private/124'");
	    	readfile("$file");
	    	
	    	//echo $Document->getfile();
	    	
	    	exit;
	    }
    } else {
    	//Redirect to login
    	header("Location: welcome.php");
    }


?>
