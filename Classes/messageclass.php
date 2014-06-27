<?php

    class Messages
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
        var $c_Message;
        var $c_ParentID;
        var $c_DateAdded;
        var $c_TimeAdded;
        var $c_PostedBy;
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
        
        function setmessage($Val)
        {
        	$this->c_Message = $Val;
        }
        
        function getmessage()
        {
        	return $this->c_Message;
        }
        
        function setparentid($Val)
        {
        	$this->c_ParentID = $Val;
        }
        
        function getparentid()
        {
        	return $this->c_ParentID;
        }
        
        function setdateadded($Val)
        {
            $this->c_DateAdded = $Val;
        }
        
        function getdateadded()
        {
            return $this->c_DateAdded;
        }
        
        function settimeadded($Val)
        {
        	$this->c_TimeAdded = $Val;
        }
        
        function gettimeadded()
        {
        	return $this->c_TimeAdded;
        }

		function setpostedby($Val)
        {
            $this->c_PostedBy = $Val;
        }
        
        function getpostedby()
        {
            return $this->c_PostedBy;
        }
               
        function setdeleted($Val)
        {
            $this->c_Deleted = $Val;
        }
        
        function getdeleted()
        {
            return $this->c_Deleted;
        }
        
        function getcategorys()
        {
        	$RQ = new ReadQuery("SELECT CategoryIDLNK FROM MessagesCategorys WHERE MessageIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        
        	$Counter = 0;
        	
        	//$Cats = new array;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		
                $CatArray[$Counter] = $row["CategoryIDLNK"];
        		
        		$Counter ++;
        	}
        	
        	//print_r($CatArray);
        	
        	return $CatArray;
        }
        
        function getcategorysbydesc()
        {
        	$CategorysArray = $this->getcategorys();
        	
        	if($CategorysArray != ""){
        	
	        	$Cats = "";
	        	
	        	foreach($CategorysArray as $Cat)
	        	{
	        		$CatObj = new UserCategory($Cat);
	        		$Cats .= ", " . $CatObj->gettitle();
	        	}
        	
        	}
        	
        	return substr($Cats,1);
        }

        function getcategoryslbl()
        {
            $CategorysArray = $this->getcategorys();
            
            if($CategorysArray != ""){
            
                $Cats = "";
                
                foreach($CategorysArray as $Cat)
                {
                    $CatObj = new UserCategory($Cat);
                    $Cats .= "<span class='label label-default'>" . $CatObj->gettitle().  "</span> ";                   
                }
            
            }

            return $Cats;
        }
        
        function getcategorysbyid()
        {
        	$CategorysArray = $this->getcategorys();
        	
        	if($CategorysArray != ""){
        	
	        	$Cats = "";
	        	
	        	foreach($CategorysArray as $Cat)
	        	{
	        		$CatObj = new UserCategory($Cat);
	        		$Cats = ", " . $CatObj->getid();
	        	}
        	
        	}
        	
        	return substr($Cats,1);
        }
        
        function getnumreplies(){
        	$RQ = new ReadQuery("SELECT COUNT(*) FROM Messages WHERE ParentIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	
        	$row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
        	
        	return $row[0];
        }

        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Messages WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_Message = $row["Message"];
                $this->c_ParentID = $row["ParentIDLNK"];
                $this->c_DateAdded = new DateClass("",$row["DateAdded"],"","","");
                $this->c_TimeAdded = $row["TimeAdded"];
                $this->c_PostedBy = new Users($row["PostedByIDLNK"]);
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$DA = $this->getdateadded();
        	$PB = $this->getpostedby();
        	$WQ = new WriteQuery("INSERT INTO Messages (Title, Message, ParentIDLNK, DateAdded, TimeAdded, PostedByIDLNK, Deleted) VALUES ('" . $this->gettitle() .  "', '" . $this->getmessage() . "'," . $this->getparentid() . ",'" . $DA->getdatabasedate() . "','" . $this->gettimeadded() . "'," . $PB->getid() . ", 0)");
        	//echo($WQ->getquery());
        	//echo($WQ->getquery());
            $this->c_ID -> insert_id;


        }
        
        function save()
        {
        	$DA = $this->getdateadded();
        	$PB = $this->getpostedby();
        	//echo($this->gettitle());
            $WQ = new WriteQuery("UPDATE Messages SET Title = '" . $this->gettitle() . "', Message = '" . $this->getmessage() . "', ParentIDLNK = " . $this->getparentid() . ", DateAdded = '" . $DA->getdatabasedate() . "', TimeAdded = '" . $this->gettimeadded() . "', PostedByIDLNK = " . $PB->getid() . ", Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static private function generatemessage($MessageID, $Header, $Email)
        {
        	$Mess = new Messages($MessageID);
        	
        	if($Header)
            {
        		print("<div class='panel-heading'><h3 class='panel-title'>" . $Mess->gettitle() . "</h3><h5>" . $Mess->getcategoryslbl() .  "</h5></div>");

                //print("<div class='panel-body'>");

                print("<table class='table'>");

                
            }

            $User = new Users($_SESSION["userid"]);
    
            if(($Mess->getpostedby()->getid() == $_SESSION["userid"] && !$Header) || ($User->getuserlevel() > 1)){
                $Message .= "<a alt = \"Delete\" onclick=\"confirmdialog('Delete Reply posted on " . $Mess->getdateadded()->getnormaldate() . "', '?mid=". $Mess->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\"></span></a>";
            } else {
                $Message .= "";
            }

            print("<tr><td><span>" . nl2br($Mess->getmessage()) . "</span><h5><span class='label label-default'>Posted by <strong>" .$Mess->getpostedby()->getfullname(). "</strong> on <strong>" . $Mess->getdateadded()->getnormaldate() . " " . $Mess->gettimeadded() ."</strong>.</span> " . $Message . "</h5></td></tr>");
        	
        	
	    	
	    		
	    	//print("</table>");
	    	
        }
        
        static private function generatemessagethread($StartID,$Email){
        
         
            print("<div class='panel panel-default'>");

        	$Message =Messages::generatemessage($StartID,true,$Email);
        	
        	$RQ = new ReadQuery("SELECT IDLNK FROM Messages WHERE ParentIDLNK = " . $StartID . " AND Deleted = 0 ORDER BY DateAdded, TimeAdded");
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		//$Categorys .= "," . $row["CategoryIDLNK"];
        		$Message .= Messages::generatemessage($row["IDLNK"],false,$Email);
        	}

            
      	
        	//return $Message;
        				
        	//print("<p>Return to the <a href=\"messages.php\">Messages List</a></p>");

        }
        
        static public function showmessage($MessageID)
        {
        	Messages::generatemessagethread($MessageID,false);
        	
        	//Form for Reply goes here.
        	$MessageField = array("Reply:","TextArea","message",85,7,$Message);
        	$ThreadField = array("ThreadID:","Hidden","thredid",0,0,$MessageID);
        	
        	$ReplyError = array("replyerror","Please enter a Reply.");
        	
        	$Errors = array($ReplyError); 
        	
        	Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);

        	$Fields = array($MessageField,$ThreadField);
        	
        	$Button = "Add Reply";

            print("<tr><td>");
        				
        	Forms::generateform("messageform","messages.php?mid=-1", "return checkreplyform(this)",false,$Fields,$Button);

            print("<tr><td>");

        
        	//print(Messages::generatemessagethread($MessageID));
        	
        	print("<p>Return to <a href=\"messages.php\">Messages Index</a></p>");

            print("</table>");

            print("</div>");
        }
        
        static public function listall()
        {
     		//Normal     		
     		//print("<h2>Messages</h2>");
				
			print("<p class='lead'>The list below shows all messages you have been sent. If you were the author of the message you can edit and delete the message.</p>");
			
			print("<p><a href='messages.php?mid=-1'><span class=\"glyphicon glyphicon-envelope\"></span> Add New Message</a></p>");
			
			
			//echo($RQ->getquery());
			
			$Col1 = array("Message","noticetitle",1);
			$Col11 = array("Replies","replies",1);
			$Col2 = array("Date Added","documents",1);
			$Col3 = array("Posted By","postedby",1);
			$Col4 = array("","operations", 1);
            $Cols = array($Col1,$Col11,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
            
            $RQ0 = new ReadQuery("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . " AND Deleted = 0;");

            //echo("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . " AND Deleted = 0;");
			

			while($row = $RQ0->getresults()->fetch_array(MYSQLI_BOTH)){
				$Categorys .= "," . $row["CategoryIDLNK"];
			}
			
			$RQ1 = new ReadQuery("SELECT MessageIDLNK FROM MessagesCategorys WHERE CategoryIDLNK IN (" . substr($Categorys,1) . ")");
			
			if($RQ1->getnumberofresults() != 0){
			
			
				while($row = $RQ1->getresults()->fetch_array(MYSQLI_BOTH)){
					$Messages .= "," . $row["MessageIDLNK"];
				}
				
				$RQ = new ReadQuery("SELECT IDLNK FROM Messages WHERE IDLNK IN (" . substr($Messages,1) . ") AND Deleted = 0 ORDER BY DateAdded DESC");
            
				while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
					$Message = new Messages($row["IDLNK"]);
					$DA = $Message->getdateadded();
					$Row1 = array("<span class=\"title\"><a href=\"?mid=" . $Message->getid() . "\">" . $Message->gettitle() . "</a></span>"," ");
					$Row11 = array($Message->getnumreplies(),"");
					$Row2 = array($DA->getnormaldate(),"");	
					$Row3 = array($Message->getpostedby()->getfullname()," ");
					
					if($Message->getpostedby()->getid() == 	 $_SESSION["userid"]){
						$Row4 = array("<a alt = \"Delete\" onclick=\"confirmdialog('Delete Message " . $Message->gettitle() . "', '?mid=". $Message->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\"></span></a>","button");
					} else {
						$Row4 = array(""," ");
					}
							
					$Rows[$RowCounter] = array($Row1,$Row11,$Row2,$Row3,$Row4);
	                $RowCounter ++;
					
				}
			
			}
			
			Tables::generateadmintable("messagestable",$Cols,$Rows);
        
        }

        
        static public function listadmin()
        {
     		//Normal
     		//print("<h2>Messages</h2>");
				
			print("<p class='lead'>The list below shows all messages.</p>");
			
			print("<p><a alt = \" Add New Message\"href='messages.php?mid=-1'><span class=\"glyphicon glyphicon-envelope\"></span>Add New Message</a></p>");
							
			$RQ = new ReadQuery("SELECT IDLNK FROM Messages WHERE Deleted = 0 ORDER BY DateAdded");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Message","noticetitle",1);
			$Col2 = array("Date Added","documents",1);
			$Col3 = array("Posted By","postedby",1);
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
									
				print("<p class='lead'>The reply has been added to the topic and sent to the chosen user groups successfully.</p>");
				
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
	            //rint("<h2>Add New Message</h2>");
	
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
										
					print("<p class='lead'>The new message has been added to the system and sent to the chossen user groups succesfully.</p>");
					
					print("<p>Return to <a href='messages.php'>Messages Admin</a>.</p>");				
									
				} else {
	                //Form
	                print("<p class='lead'>To Add a New Message complete the form below. Once you have completed it click the Send Message Button and the Message will be sent to the chosen user groups.</p>");
	                
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