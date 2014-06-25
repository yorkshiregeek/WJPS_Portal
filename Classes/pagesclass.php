<?php

    class Pages
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
        var $c_Content;
        var $c_ParentID;
        var $c_Updated;
        var $c_UpdatedBy;
        var $c_URL;
        var $c_Deleted;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function settitle($Val)
        {
            $this->c_Title = $Val;
        }
        
        function gettitle()
        {
            return $this->c_Title;
        }
        
        function setcontent($Val)
        {
        	$this->c_Content = $Val;
        }
        
        function getcontent()
        {
        	return $this->c_Content;
        }
        
        function setparentid($Val)
        {
        	$this->c_ParentID = $Val;
        }
        
        function getparentid()
        {
        	return $this->c_ParentID;
        }
        
        function setupdated($Val)
        {
            $this->c_Updated = $Val;
        }
        
        function getupdated()
        {
            return $this->c_Updated;
        }
        
		function setupdatedby($Val)
        {
            $this->c_UpdatedBy = $Val;
        }
        
        function getupdatedby()
        {
            return $this->c_UpdatedBy;
        }

        function seturl($Val)
        {
            $this->c_URL = $Val;
        }
        
        function geturl()
        {
            return $this->c_URL;
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
                $RQ = new ReadQuery("SELECT * FROM Pages WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_Message = $row["Content"];
                $this->c_ParentID = $row["ParentIDLNK"];
                $this->c_Updated = new DateClass("",$row["Updated"],"","","");
                $this->c_UpdatedBy = new Users($row["UpdatedByIDLNK"]);
                $this->c_URL = $row["URL"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$DA = $this->getupdated();
        	$UB= $this->getupdateby();
        	$WQ = new WriteQuery("INSERT INTO Pages (Title, Content, ParentIDLNK, Updated, UpdatedByIDLNK, URL, Deleted) VALUES ('" . $this->gettitle() .  "', '" . $this->getcontent() . "'," . $this->getparentid() . ",'" . $DA->getdatabasedate() . "'," . $UB->getid() . ",'" . $this->geturl() . "' 0)");
            $this->c_ID -> insert_id;
        }
        
        function save()
        {
        	$DA = $this->getdateadded();
        	$UB = $this->getpostedby();
            $WQ = new WriteQuery("UPDATE Pages SET Title = '" . $this->gettitle() . "', Content = '" . $this->getmessage() . "', ParentIDLNK = " . $this->getparentid() . ", Updated = '" . $DA->getdatabasedate() . "', UpdatedByIDLNK = " . $UB->getid() . ", URL = '" . $this->geturl() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			
        }
        
        static public function showpage($PageID)
        {
        	$Page = new Page($ID);

            print("<h1>" . $Page->gettitle() . "</h1>");

            print($Page->getcontent());
        }
        
        static public function pagesmenu()
        {
     		//This will display the page menu
        }

        
        static public function listadmin()
        {
     		//Normal
     		print("<h2>Pages</h2>");
				
			print("<p>The list below shows all pages.</p>");
			
			print("<p><a alt = \" Add New Page\"href='pages.php?pid=-1'><span class=\"glyphicon glyphicon-envelope\"></span>Add New Page</a></p>");
							
			$RQ = new ReadQuery("SELECT IDLNK FROM Pages HERE Deleted = 0 ORDER BY ParentIDLNK");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Page","pagetitle",1);
			$Col2 = array("Date Updated","pageupdated",1);
			$Col3 = array("Updated by","updatedby",1);
            $Col4 = array("","operations", 1);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Message = new Messages($row["IDLNK"]);
				$DA = $Message->getdateadded();
				$Row1 = array("<span class=\"title\"><a href=\"?mid=" . $Message->getid() . "\">" . $Message->getmessage() . "</a></span>"," ");
				$Row2 = array($DA->getnormaldate()," ");	
				$Row3 = array($Message->getpostedby()->getfullname()," ");				
				//$Row6 = array("<a href=?lid=-". $Lab->getid() ."><img src=\"Images/building_delete.png\" alt=\"Delete Lab\"/></a>","button");
				$Row4 = array("<a alt = \"Delete Message\" onclick=\"confirmdialog('Delete Message " . $Message->gettitle() . "', '?mid=". $Message->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\"></span></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4);

                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("adminmessagestable",$Cols,$Rows);        
        }
             
    	static public function addedit($MID)
	    {
			$Title = $_POST["title"];
			$Message = $_POST["message"];
			$HiddenTID = $_POST["thredid"];
			
			$Submit = $_POST["submit"];
					
			//Get Number of Categorys
			$NofC = UserCategory::gettotal();
			
			//$UserCategorys = new array();
			
			if(($HiddenTID != 0)){

				//Add message to thread
				
				$Thread = new Messages($HiddenTID);
				
				$NewMessage = new Messages(0);
				
				$User = new Users($_SESSION["userid"]);	
				
				$NewMessage->settitle($Thread->gettitle());
				$NewMessage->setmessage($Message);
				$NewMessage->setdateadded(new DateClass("","","","",""));
				$NewMessage->settimeadded(Date("H:i:s"));
				$NewMessage->setpostedby($User);
				$NewMessage->setparentid($HiddenTID);
				$NewMessage->savenew();
				
				Messages::sendemail($NewMessage->getid());
									
				print("<p>The reply has been added to the topic and sent to the chosen user groups successfully.</p>");
				
				print("<p>Return to <a href='messages.php'>Messages Admin</a>.</p>");		
			
			} else {
			
				for($c=1;$c<=$NofC;$c++)
				{
					if(isset($_POST["messagecategory" . $c])){
						//$UserCategory .= "," . $_POST["usercategory" . $c];
						$MessageCategorys[$c-1] = $_POST["messagecategory" . $c];
					}
				}
				
				
				
				
				
				//$Group = 
				
				$TitleError = array("titleerror","Please enter a Title.");
				$MessageError = array("messageerror","Please enter a Message.");
				$CategoryError = array("categoryerror","please select at least one category.");
		         
		        //Add
	            print("<h2>Add New Message</h2>");
	
	            if($Submit){
	                //Add
	                 
					$NewMessage = new Messages(0);
					
					$User = new Users($_SESSION["userid"]);	
					
					$NewMessage->settitle($Title);
					$NewMessage->setmessage($Message);
					$NewMessage->setdateadded(new DateClass("","","","",""));
					$NewMessage->settimeadded(Date("H:i:s"));
					$NewMessage->setparentid(0);
					$NewMessage->setpostedby($User);
					$NewMessage->savenew();
					
					foreach($MessageCategorys as $MC)
					{
						$WQ = new WriteQuery("INSERT INTO MessagesCategorys (MessageIDLNK, CategoryIDLNK, Deleted) VALUES (" . $NewMessage->getid() . ", " . $MC . ",0);");
						
						//echo($WQ->getquery());
					}
					
					Messages::sendemail($NewMessage->getid());
										
					print("<p>The new message has been added to the system and sent to the chossen user groups succesfully.</p>");
					
					print("<p>Return to <a href='messages.php'>Messages Admin</a>.</p>");				
									
				} else {
	                //Form
	                print("<p>To Add a New Message complete the form below. Once you have completed it click the Send Message Button and the Message will be sent to the chosen user groups.</p>");
	                
	                $Errors = array($TitleError,$MessageError,$CategoryError);
	    			
	    			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	    			
	                Messages::form($Title,$Message,$MessageCategory,$MID);
	             }
             
             }
        	
	     }
	     
    	static public function form($Title,$Messagee,$MessagesCategory,$MID)
        {
        	$MessageCategoryArray = UserCategory::generatearraybyuser($_SESSION["userid"]);
        
          	$TitleField = array("Title:","Text","title",65,0,$Title,"Enter a message title");
        	$MessageField = array("Message:","TextArea","message",85,7,$Message,"Enter a message");
        	$CategoryField = array("Category:","CheckboxArray","messagecategory",0,0,$MessagesCategory,"",$MessageCategoryArray);
        	
			$Fields = array($TitleField,$MessageField,$CategoryField);

           	$Button = "Send Message";
			
			Forms::generateform("messageform","messages.php?mid=" . $MID, "return checkmessageform(this,2)",false,$Fields,$Button);
			
			print("<p>Return to the <a href=\"messages.php\">Messages List</a></p>");
           
        }
        
        static public function sendemail($MessageID)
        {
        	$Message = new Messages($MessageID);
        	$Title = "";
        	
        	if($Message->getparentid() == 0){
        	
        		$Title = SITENAME . " - New Message - " . $Message->gettitle();
        	
        		$msg = "<p>A new message has been added to the " . SITENAME . " messages board titled - " . $Message->gettitle() . " . The message details are below, you can also view the <a href='" . URL . "\messages.php?mid=" . $MessageID ."'>message online</a>.</p>";
        
        		$msg .= Messages::generatemessagethread($MessageID,true);
        	
        	} else {
        	
        		$Parent = new Messages($Message->getparentid());
        	
        		$Title = SITENAME . " - New Reply - " . $Parent->gettitle();
        	
        		$msg = "<p>A new reply has been added to the " . SITENAME . " messages board titled - " . $Parent->gettitle() . " . The message details are below, you can also view the <a href='" . URL . "\messages.php?mid=" . $MessageID ."'>message online</a>.</p>";
        	
        		$msg .= Messages::generatemessagethread($Parent->getid(),true);
        	
        	}
        	
        	$msg .= "<p>To make a reply, visit the  <a href='" . URL . "\messages.php?mid=" . $MessageID . "'>web version of this message</a>.</p>";
        	
        	//echo(Users::allemailsbycategory($Notice->getcategorysbyid()));
					
			Emails::sendemail(Users::allemails($Message->getcategorys()),$Title,$msg);
        }
        
		static public function deletemessage($MID){
        	$Message = new Messages($MID);
        	
        	$Message->setdeleted(1);
          	
        	$Message->save();
        } 
        
        static public function lastmessages(){
        	$RQ0 = new ReadQuery("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . " AND Deleted = 0;");
			
			while($row = $RQ0->getresults()->fetch_array(MYSQLI_BOTH)){
				$Categorys .= "," . $row["CategoryIDLNK"];
			}
			
			$RQ1 = new ReadQuery("SELECT MessageIDLNK FROM MessagesCategorys WHERE CategoryIDLNK IN (" . substr($Categorys,1) . ")");
			
			if($RQ1->getnumberofresults() != 0){
						
				while($row = $RQ1->getresults()->fetch_array(MYSQLI_BOTH)){
					$Messages .= "," . $row["MessageIDLNK"];
				}
				
				$RQ = new ReadQuery("SELECT IDLNK FROM Messages WHERE IDLNK IN (" . substr($Messages,1) . ") AND Deleted = 0 ORDER BY DateAdded DESC LIMIT 0,5");
        	
	        	print("<ul>");
	        	
	        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
	        		$Message = new Messages($row["IDLNK"]);
	        		
	        		print("<li><a href=\"messages.php?mid=" .$Message->getid() . "\">" . $Message->gettitle() . "</a></li>");
	        	}
	        	
	        	print("</ul>");
        	
        	} else {
        	
        		print("<p>No Messages to show.</p>");
        	
        	}
        }    
                       
    }

?>