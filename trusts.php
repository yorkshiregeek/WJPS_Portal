<? 

	session_start();

	include_once("Classes/classes.php");
	include_once("Classes/directoryclass.php")
	include_once("Classes/positionsclass.php");
	
	$Scripts[0] = "Script/DirectoryScript.js";

	

	<div class='col-md-10' id='content'>
		
	$TID = $_GET["tid"];
	$STID = $_GET["stid"]; 
	$SID = $_GET["sid"];
	$CTID = $_GET["ctid"];
	$CID = $_GET["cid"];  				
	$AID = $_GET["aid"];
	$MID = $_GET["mid"];
		
	//AID
	//EDIT = 5
	//DELETE = 10
	
	if(Users::login(1) || Users::logincheck(1)){
		//DocumentAdmin	
		$UID = Users::logincheck(1);
		
		$User = new Users($UID);
		
		if($User->getuserlevel() >= 2){
			
			Print("<h2 class='page-header'>Directory Admin</h2>");
			
				if($TID){
					
					print("<div class=\"directory\">");
				
					Trusts::addedit($TID);
					
					print("</div>");
				}else if($STID || $CTID) {
					
					//Manage 
					
					if($STID){
						$lTID = $STID;
					} else if($CTID) {
						$lTID = $CTID;
					}
					
					$Trust = new Trusts($lTID);
					
					print("<ul class=\"tabs\">");
						if($MID==0){
							print("<li><a href=\"directory.php\">Manage Trusts</a></li>");
							print("<li class=\"selected\"><a href=\"?mid=0&amp;stid=" . $lTID . "\">Manage Sites</a></li>");
							print("<li><a href=\"?mid=1&amp;ctid=" . $lTID . "\">Manage Contacts</a></li>");
							print("<li><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
						} else if($MID==1){
							print("<li><a href=\"directory.php\">Manage Trusts</a></li>");
							print("<li><a href=\"?mid=0&amp;stid=" . $lTID . "\">Manage Sites</a></li>");
							print("<li class=\"selected\"><a href=\"?mid=1&amp;ctid=" . $lTID . "\">Manage Contacts</a></li>");
							print("<li><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
						}
					print("</ul>");
					
					print("<div class=\"directory\">");
					
					//print("<p><b>Trust:</b> " . $Trust->gettrust() . "</p>");
					
					if($MID==0){
						//Sites
						if($SID){
							if($AID == 10){
								Sites::deletesite($SID);
								Sites::listall($STID);
							} else {
								Sites::addedit($SID,$STID);
							}
						} else {
							Sites::listall($STID);
						}
						
					} else {
						//Contacts
						if($CID){
							if($AID == 10){
								Contacts::deletecontact($CID);
								Contacts::listall($CTID);
							} else {
								Contacts::addedit($CID,$CTID);
							}
						} else {
							Contacts::listall($CTID);
						}
					}
					
					print("</div>");
					
				} else {
				
					if($AID == 1){
						//Search
						print("<ul class=\"tabs\">");
							
							print("<li><a href=\"directory.php\">Manage Trusts</a></li>");
							print("<li><a href=\"positions.php\">Manage Positions</a></li>");
							print("<li class=\"selected\"><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
							
						print("</ul>");
						
						print("<div class=\"directory\">");
						
						Contacts::search();
						
						print("</div>");
						
					} else {
						//Trsuts
						print("<ul class=\"tabs\">");
							
								print("<li class=\"selected\"><a href=\"directory.php\">Manage Trusts</a></li>");
								print("<li><a href=\"positions.php\">Manage Positions</a></li>");
								print("<li ><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
							
						print("</ul>");
					
						print("<div class=\"directory\">");
						Trusts::listall();
						print("</div>");
					}
					
				}    						
			} else {
				
				Print("<h1>Directory</h1>");
				
				if($TID || $SID || $CID){
					//Show Sites and Contacts
					
					if($SID){
						//$lTID = $SID;
						//Get Trust
						$TID = Sites::gettrustid($SID);
					} else if($CID) {
						//$lTID = $CID;
						$TID = Contacts::gettrustid($CID);
					}
					
					$Trust = new Trusts($TID);
					
					print("<ul class=\"tabs\">");
						if($MID==0){
							print("<li><a href=\"directory.php\">View Trusts</a></li>");
							print("<li class=\"selected\"><a href=\"?mid=0&amp;tid=" . $TID . "\">View Sites</a></li>");
							print("<li><a href=\"?mid=1&amp;tid=" . $TID . "\">View Contacts</a></li>");
							print("<li><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
						} else if($MID==1){
							print("<li><a href=\"directory.php\">View Trusts</a></li>");
							print("<li><a href=\"?mid=0&amp;tid=" . $TID . "\">View Sites</a></li>");
							print("<li class=\"selected\"><a href=\"?mid=1&amp;tid=" . $TID . "\">View Contacts</a></li>");
							print("<li><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
						}
					print("</ul>");
					
					//print("<p><b>Trust:</b> " . $Trust->gettrust() . "</p>");
					
					if($MID==0){
						//Sites
						if($SID){
							//Show Else
							Sites::show($SID);
						} else {
							Sites::showall($TID);
						}
						
					} else {
						//Contacts
						if($CID){
							//Show
							Contacts::outputcontact($CID);
						} else {
							Contacts::showall($TID);
						}
					}
					
					
				} else {
				
					if($AID == 1){
						//Search
						print("<ul class=\"tabs\">");
							
							print("<li><a href=\"directory.php\">View Trusts</a></li>");
							print("<li class=\"selected\"><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
							
						print("</ul>");
						
						Contacts::search();
						
					} else {
						//Trsuts
						print("<ul class=\"tabs\">");
							
								print("<li class=\"selected\"><a href=\"directory.php\">View Trusts</a></li>");
								print("<li ><a href=\"directory.php?aid=1\">Search Contacts</a></li>");
							
						print("</ul>");
					
						Trusts::showall();
					}
					
				
				}
			
			}
			
			
	
	print("</div>");
		
?>
		

	
