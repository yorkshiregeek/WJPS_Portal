<?php

    class Contacts
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Trust;
        var $c_Position;
        var $c_Name;
        var $c_Email;
        var $c_Telephone;
        var $c_Deleted;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function settrust($Val)
        {
            $this->c_Trust = $Val;
        }
        
        function gettrust()
        {
            return $this->c_Trust;
        }
        
        function setposition($Val)
        {
            $this->c_Position = $Val;
        }
        
        function getposition()
        {
            return $this->c_Position;
        }
        
        function setname($Val)
        {
        	$this->c_Name = $Val;
        }
        
        function getname(){
        	return $this->c_Name;
        }
        
        function setemail($Val)
        {
        	$this->c_Email = $Val;
        }
        
        function getemail(){
        	return $this->c_Email;
        }
        
        function settelephone($Val)
        {
        	$this->c_Telephone = $Val;
        }
        
        function gettelephone(){
        	return $this->c_Telephone;
        }
               
        function setdeleted($Val)
        {
            $this->c_Deleted = $Val;
        }
        
        function getdeleted()
        {
            return $this->c_Deleted;
        }
                
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Contacts WHERE ContactIDLNK = " . $ID . ";");
                $row = mysql_fetch_array($RQ->getresults());
                $this->c_ID = $ID;
                $this->c_Trust = new Trusts($row["TrustIDLNK"]);
                $this->c_Position = new Positions($row["PositionIDLNK"]);
                $this->c_Name = $row["Name"];
                $this->c_Email = $row["Email"];
                $this->c_Telephone = $row["Telephone"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$Trust = $this->gettrust();
        	$Position = $this->getposition();
        	$WQ = new WriteQuery("INSERT INTO Contacts (TrustIDLNK,PositionIDLNK,Name,Email,Telephone,Deleted) VALUES (" . $Trust->getid() . "," . $Position->getid() . ",'" . $this->getname() . "','" . $this->getemail() . "','" . $this->gettelephone() . "', 0)");
            $this->c_ID = mysql_insert_id();
            
            //echo($WQ->getquery());
        }
        
        function save()
        {
        	$Trust = $this->gettrust();
        	$Position = $this->getposition();
        	$WQ = new WriteQuery("UPDATE Contacts SET TrustIDLNK = " . $Trust->getid() . ", PositionIDLNK = " . $Position->getid() . ", Name = '" . $this->getname() . "', Email = '" . $this->getemail() . "', Telephone = '" . $this->gettelephone() . "', Deleted = " . $this->getdeleted() . " WHERE ContactIDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
       
        static public function listall($TID)
        {
     		//Normal
     		
     		$Trust = new Trusts($TID);
     		
     		print("<p>The list below shows all the contacts that are part of " . $Trust->gettrust() . ".</p>");
     		
     		print("<p><a href='directory.php?mid=1&amp;cid=-1&amp;ctid=" . $TID . "'><img src=\"Images/building_add.png\" alt=\"Add New Contact\"/>Add New Contact</a></p>");
				
			$RQ = new ReadQuery("SELECT ContactIDLNK, DisplayOrder FROM Contacts,Positions WHERE TrustIDLNK = " . $TID . " AND Contacts.PositionIDLNK = Positions.PositionIDLNK AND Contacts.Deleted = 0 ORDER BY DisplayOrder");
			
			//echo($RQ->getnumberofresults());
			
			$Col1 = array("Name","contactname",1);
			$Col2 = array("Position","position",1);
			$Col3 = array("Email","email",1);
			$Col4 = array("Telephone","phone",1);
			$Col5 = array("","operations",2);
            $Cols = array($Col1,$Col2,$Col3,$Col4,$Col5);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = mysql_fetch_array($RQ->getresults())){
				$Contact = new Contacts($row[0]);
				$Position = $Contact->getposition();
				
				//echo($Position);
				$Row1 = array($Contact->getname()," ");
				$Row2 = array($Position->getposition()," ");
				$Row3 = array("<a href=\"mailto:" . $Contact->getemail() . "\">" . $Contact->getemail() . "</a>", " ");
				$Row4 = array($Contact->gettelephone()," ");
				$Row5 = array("<a href=\"?mid=1&amp;cid=". $Contact->getid() ."&amp;ctid=" . $TID . "\"><img src=\"Images/user_edit.png\" alt=\"Edit Contact\"/></a>","button");
				$Row6 = array("<a onclick=\"confirmdialog('Delete Contact " . $Contact->getname() . "', '?mid=1&amp;cid=". $Contact->getid() ."&amp;ctid=" . $TID . "&amp;aid=10');\"><img src=\"Images/user_delete.png\" alt=\"Delete User\"/></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5,$Row6);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("usertable",$Cols,$Rows);
        
        }
                
        static public function showall($TID)
        {
    		$Trust = new Trusts($TID);
    		
    		print("<p>The list below shows all the contacts that are part of " . $Trust->gettrust() . ".</p>");
    		
    		$RQ = new ReadQuery("SELECT ContactIDLNK, DisplayOrder FROM Contacts,Positions WHERE TrustIDLNK = " . $TID .  " AND Contacts.PositionIDLNK = Positions.PositionIDLNK AND Contacts.Deleted = 0 ORDER BY DisplayOrder");
    	
    		//echo($RQ->getnumberofresults());
        	
        	$Col1 = array("Name","contactname",1);
        	$Col2 = array("Position","position",1);
        	$Col3 = array("Email","email",1);
        	$Col4 = array("Telephone","phone",1);
        	$Cols = array($Col1,$Col2,$Col3,$Col4);
        	$Rows = array();
        	$RowCounter = 0;
        	
        	while($row = mysql_fetch_array($RQ->getresults())){
        		$Contact = new Contacts($row[0]);
        		$Position = $Contact->getposition();
        		
        		//echo($Position);
        		$Row1 = array("<a href=\"?mid=1&amp;cid=" . $Contact->getid() . "\">" . $Contact->getname() . "</a>"," ");
        		$Row2 = array($Position->getposition()," ");
        		$Row3 = array("<a href=\"mailto:" . $Contact->getemail() . "\">" . $Contact->getemail() . "</a>", " ");
        		$Row4 = array($Contact->gettelephone()," ");
        		
        		$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4);
        	    $RowCounter ++;
        	}
        	
        	Tables::generateadmintable("usertable",$Cols,$Rows);
       	}
       	
       	static public function outputcontact($CID){
       		$Contact = new Contacts($CID);
       		
       		print("<h2>" . $Contact->getname() . " - Contact Details</h2>");
       		
       		
       		
       		print("<dl class=\"contactdetails\">");
       		
       			print("<dt>Trust:</dt><dd><a href=\"?tid=" . $Contact->gettrust()->getid() . "\">" . $Contact->gettrust()->gettrust() . "</a></dd>");
       			print("<dt>Position:</dt><dd>" . $Contact->getposition()->getposition() . "</dd>");
       			print("<dt>Telephone:</dt><dd>" . $Contact->gettelephone() . "</dd>");
       			print("<dt>Email:</dt><dd><a href=\"mailto:" . $Contact->getemail() . "\">" . $Contact->getemail() . "</a></dd>");
       		
       		print("</dl>");
       		
       		print("<p><a href=\"?aid=1\">Return to the Search Page</a></p>");
       	}
        
        static public function addedit($CID,$CTID)
	    {
			$Position = $_POST["position"];
			$Name = $_POST["name"];
			$Email = $_POST["email"];
			$Telephone = $_POST["telephone"];
			$Submit = $_POST["submit"];
			
			$NameError = array("nameerror","Please enter a name.");
			$EmailError = array("emailerror","Please enter an email address.");
			$EmailFormatError = array("emailformaterror","Please enter a valid email address.");
			$TelephoneError = array("telephoneerror","Please enter a telephone number.");
					
	        if($CID > 0){
	            //Edit
	            print("<h2>Edit Site</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewContact = new Contacts($CID);
					
					$NewContact->settrust(new Trusts($CTID));
					$NewContact->setposition(new Positions($Position));
					$NewContact->setname($Name);
					$NewContact->setemail($Email);
					$NewContact->settelephone($Telephone);
													
					$NewContact->save();			
										
					print("<p>The Contact has been succesfully edited.</p>");
					
					print("<p>Return to <a href='directory.php?mid=1&amp;ctid=" . $CTID . "'>Directory Admin</a>.</p>");	
								       
			     } else {
	                //Form
	                print("<p>To Edit the Contact complete the form below. Once you have completed it click the Edit Contact button.</p>");
	                
	                $Errors = array($NameError,$EmailError,$EmailFormatError,$TelephoneError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Contact = new Contacts($CID);
	                	             	
	                //Trusts::form($Trust->gettrust(),$TID,true);
	                
	                //echo($Site->getname())
	                
	                Contacts::form($Contact->gettrust()->getid(),$Contact->getposition()->getid(),$Contact->getname(),$Contact->getemail(),$Contact->gettelephone(),$Contact->getid(),false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Contact</h2>");

	            if($Submit){
	                //Add
	                
	                $NewContact = new Contacts(0);
	                
	                $NewContact->settrust(new Trusts($CTID));
	                $NewContact->setposition(new Positions($Position));
	                $NewContact->setname($Name);
	                $NewContact->setemail($Email);
	                $NewContact->settelephone($Telephone);
	                								
	                $NewContact->savenew();				
	                					
	                print("<p>The Contact has been succesfully added.</p>");
	                
	                print("<p>Return to <a href='directory.php?mid=1&amp;ctid=" . $CTID . "'>Directory Admin</a>.</p>");			
				} else {
	                //Form
	                
	                print("<p>To Add a new Contact complete the form below. Once you have completed it click the Save Contact button.</p>");
	                   
	                $Errors = array($NameError,$EmailError,$EmailFormatError,$TelephoneError);
	                
	                Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                   
	                Contacts::form($CTID,$Position,$Name,$Email,$Telephone,$CID,$Add);      	     
        	 	}
        	 }
	    }
	     
    	static public function form($TID,$Position,$Name,$Email,$Telephone,$CID,$Add)
        {
        	$Trust = new Trusts($TID);
        	//$Positions = Positions::generateavailablearray($TID,$CID);
        	$Positions = Positions::generatearray();
        
        	$TrustField = array("Trust:","Static","trustname",0,0,$Trust->gettrust());
        	$PositionField = array("Position:","Select","position",0,0,$Position,$Positions);
        	$NameField = array("Name:","Text","name",65,0,$Name);
        	$EmailField = array("Email:","Text","email",65,0,$Email);
        	$TelephoneField = array("Telephone:","Text","telephone",65,0,$Telephone);
        	        
        	$Fields = array($TrustField,$PositionField,$NameField,$EmailField,$TelephoneField);
            
			if($TID == -1){
				$Button = "Add Contact";
            	Forms::generateform("contactform","directory.php?mid=1&amp;cid=$CID&amp;ctid=$TID","return checkcontactform(this)",false,$Fields,$Button);
			} else {
				$Button = "Edit Contact";
				Forms::generateform("contactform","directory.php?mid=1&amp;cid=$CID&amp;ctid=$TID","return checkcontactform(this)",false,$Fields,$Button);
			}
           
        }
        
		static public function deletecontact($CID){
        	$Contact = new Contacts($CID);
        	
        	$Contact->setdeleted(1);
        	
        	$Contact->save();
        }   
        
        static public function search()
        {
        	$Term = $_POST["searchterm"];
        	$CID = $_GET["cid"];
        	
        	if($Term){
        		//Perform Search and Results
        		print("<p>To search the directory, enter the name, or part name of the person you are looking for, into the search box below.</p>");
        		Contacts::searchbox($Term);
        		Contacts::results($Term);
        	} else {
        		//Show Search Box
        		if($CID){
        			Contacts::outputcontact($CID);
        		} else {
        			print("<p>To search the directory, enter the name, or part name of the person you are looking for, into the search box below.</p>");
        		
        			Contacts::searchbox(" ");
        		}
        		
        	}
        }  
        
        static private function searchbox($Term)
        {
        	print("<form id=\"searchform\" action=\"directory.php?aid=1\" method=\"post\">");
        	
        		print("<input type=\"text\" size=\"80\" name=\"searchterm\" value=\"" . $Term . "\"/>");
        		
        		print("<input style=\"position:relative;left:20px;\"type=\"submit\" name=\"submit\" value=\"Search\"/>");
        	
        	print("</form>");
        }
        
        static private function results($Term)
        {
        	$RQ = new ReadQuery("SELECT CONTACTIDLNK FROM Contacts WHERE Name LIKE '%" . ucfirst($Term) . "%' AND Deleted = 0 ORDER BY Name;");
        	
        	if($RQ->getnumberofresults() > 0){
        		//Results
        		
        		$Col1 = array("Name","contactname",1);
        		$Col2 = array("Position","position",1);
        		$Col3 = array("Trust","trustname",1);
        		
          		$Cols = array($Col1,$Col2,$Col3);
        		$Rows = array();
        		$RowCounter = 0;
        		
        		while($row = mysql_fetch_array($RQ->getresults())){
        			$Contact = new Contacts($row[0]);
        			$Position = $Contact->getposition();
        			
        			//echo($Position);
        			$Row1 = array("<a href=\"?aid=1&amp;cid=" . $Contact->getid() . "\">" . $Contact->getname() . "</a>"," ");
        			$Row3 = array($Contact->gettrust()->gettrust()," ");
        			$Row2 = array($Position->getposition()," ");
        			
        			
        			$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
        		    $RowCounter ++;
        		}
        		
        		Tables::generateadmintable("usertable",$Cols,$Rows);
        		
        		
        	} else {
        		print("<p class=\"error\">No Results have been found, please try searching again.</p>");
        	}
        }
        
        static public function gettrustid($CID){
        	$Contact = new Contacts($CID);
        	
        	return $Contact->gettrust()->getid();
        }  
       
    }

?>