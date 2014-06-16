<?php

    class Events
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
        var $c_Details;
        var $c_Location;
        var $c_EventDate;
        var $c_EventTime;
        var $c_Duration;
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
        
 		function setdetails($Val)
        {
            $this->c_Details = $Val;
        }
        
        function getdetails()
        {
            return $this->c_Details;
        }
        
        function setlocation($Val)
        {
            $this->c_Location = $Val;
        }
        
        function getlocation()
        {
            return $this->c_Location;
        }
        
        function seteventdate($Val)
        {
            $this->c_EventDate = $Val;
        }
        
        function geteventdate()
        {
            return $this->c_EventDate;
        }
        
        function seteventtime($Val)
        {
            $this->c_EventTime = $Val;
        }
        
        function geteventtime()
        {
            return $this->c_EventTime;
        }
        
        function setduration($Val)
        {
            $this->c_Duration = $Val;
        }
        
        function getduration()
        {
            return $this->c_Duration;
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
                $RQ = new ReadQuery("SELECT * FROM Events WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_Details = $row["Details"];
                $this->c_Location = $row["Location"];
                $this->c_EventDate = new DateClass("",$row["EventDate"],"","","");
                $this->c_EventTime = $row["EventTime"];
                $this->c_Duration = $row["Duration"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$ED = $this->geteventdate();
        	$WQ = new WriteQuery("INSERT INTO Events (Title, Details, Location, EventDate, EventTime, Duration, Deleted) VALUES ('" . $this->gettitle() . "', '" . $this->getdetails() . "', '" . $this->getlocation() . "','" . $ED->getdatabasedate() . "','" . $this->geteventtime() . "','" . $this->getduration() . "', 0)");
        	//echo($WQ->getquery());
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
        	$ED = $this->geteventdate();
        	$WQ = new WriteQuery("UPDATE Events SET Title = '" . $this->gettitle() . "', Details = '" . $this->getdetails() . "', Location = '" . $this->getlocation() . "', EventDate = '" . $ED->getdatabasedate() . "', EventTime = '" . $this->geteventtime() . "', Duration = '" . $this->getduration() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall()
        {
     		//Normal
     		
     		print("<p>The list below shows all the events in the system.</p>");
     		
     		print("<p><a href='events.php?eid=-1'><span class=\"glyphicon glyphicon-plus\" alt = \"Add Event\"></span> Add New Event</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Events WHERE Deleted = 0 ORDER BY EventDate DESC, EventTime, Title");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Title","sectionname",1);
			$Col2 = array("Location","documents",1);
			$Col3 = array("Date Time","datetime",1);
			$Col4 = array("","operations",2);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				$Event = new Events($row["IDLNK"]);
				$Row1 = array($Event->gettitle()," ");
				$Row2 = array($Event->getlocation()," ");
				$Row3 = array($Event->geteventdate()->getnormaldate() . " " . $Event->geteventtime()," ");
				$Row4 = array("<a href=\"?eid=". $Event->getid() ."\"><span class=\"glyphicon glyphicon-pencil\" alt = \"Edit Event\"></span></a>","button");
				$Row5 = array("<a onclick=\"confirmdialog('Delete Event " . $Event->gettitle() . "', '?eid=". $Event->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\" alt = \"Delete Event\"></span></a>","button");
				//$Row4 = array("<a href=\"?lid=". $Link->getid() ."&amp;aid=10\"><img src=\"Images/link_delete.png\" alt=\"Delete Link\"/></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("eventstable",$Cols,$Rows);
        
        }
                
        static public function showall()
        {
        
        	$EID = $_GET["leid"];
        	
        	if(!isset($EID)){
        	
        		print("<h2>Events List</h2>");
        	
        		print("<p>Listed below are up and coming events.</p>");
        	
	        	$RQ = new ReadQuery("SELECT IDLNK FROM Events WHERE Deleted = 0 ORDER BY EventDate, EventTime DESC, Title");
	        	
	        	$Year = "";
	        	$Month = "";
	        	
	        	print("<dl>");
	        	
	        	while($RQ->getresults()->fetch_array(MYSQLI_ASSOC))
	        	{
	        		$Event = new Events($row["IDLNK"]);
	        		
	        		$EYear = $Event->geteventdate()->getyear();
	        		
	        		$EMonth = $Event->geteventdate()->getmonth();
	        		
	        		if($EYear == $Year){
	        			//Same Year
	        			
	        			if($Month == $EMonth)
	        			{
	        				//Same Month
	        				print("<dt><a href=\"?leid=" . $Event->getid() . "\">" . $Event->gettitle() . "</a> (" . $Event->geteventdate()->getnormaldate() . ")</dt>\r\n");
	        			
	        				print("<dd>" . $Event->getdetails() . "</dd>\r\n");
	        				
	        			} else {
	        				//New Month
	        				if($Month != ""){
	        					print("</dl></dd></dl>\r\n");
	        				}
	        				
	        				print("<dl><dt class=\"monthdivider\">" . $Event->geteventdate()->getmonthstring() . "</dt><dd><dl>\r\n");
	 
	        				print("<dt><a href=\"?leid=" . $Event->getid() . "\">" . $Event->gettitle() . "</a> (" . $Event->geteventdate()->getnormaldate() . ")</dt>\r\n");
	        			
	        				print("<dd class=\"event\">" . $Event->getdetails() . "</dd>\r\n");
	        				
	        				$Month = $EMonth;
	        			}
	        			
	        		} else {
	        			//New Year
	        			if($Year != ""){
	        				print("</dl></dd></dl>\r\n");
	        			}
	        		
	    				print("<dt class=\"yeardivider\">" . $EYear . " Events</dt>\r\n");
	    				print("<dd><dl><dt class=\"monthdivider\">" . $Event->geteventdate()->getmonthstring() . "</dt><dd><dl>\r\n");
	        				
	        			print("<dt><a href=\"?leid=" . $Event->getid() . "\">" . $Event->gettitle() . "</a> (" . $Event->geteventdate()->getnormaldate() . ")</dt>\r\n");
	        			
	        			print("<dd class=\"event\">" . $Event->getdetails() . "</dd>\r\n");
	        			
	        			$Year = $EYear;
	        			
	        			$Month = $EMonth;
	        		}
	        	}
	        	
	        	print("</dl>");
        	
        	} else {
        	
        		$Event = new Events($EID);
        	
        		print("<h2>" . $Event->gettitle() . "</h2>");
        		
        		print("<dl>");
        		
	        		print("<dt>Event:</dt>");
	        		
	        		print("<dd>" . $Event->gettitle() . "</dd>");
	        		
	        		print("<dt>Details:</dt>");
	        		
	        		print("<dd>" . $Event->getdetails() . "</dd>");
	        		
	        		print("<dt>Location:</dt>");
	        		
	        		print("<dd>" . $Event->getlocation() . "</dd>");
	        		
	        		print("<dt>Date &amp; Time:</dt>");
	        		
	        		print("<dd>" . $Event->geteventdate()->getnormaldate() . " - " . $Event->geteventtime() . "</dd>");
	        		
	        		print("<dt>Duration</dt>");
	        		
	        		print("<dd>" . $Event->getduration() . "</dd>");
        		
        		print("</dl>");
        		
        		print("<p><a href=\"events.php\">Return to Events List</a></p>");
        	
        	}
        	
        }
        
        static public function addedit($EID)
	    {
			$Title = $_POST["title"];
			$Details = $_POST["details"];
			$Location = $_POST["location"];
			$EventDate = $_POST["eventdate"];
			$EventTime = $_POST["eventtime"];
			$Duration = $_POST["duration"];
			$SendNotice = $_POST["sendnotice"];
			
			//Get Number of Categorys
			$NofC = UserCategory::gettotal();
			
			//$UserCategorys = new array();
			
			for($c=1;$c<=$NofC;$c++)
			{
				if(isset($_POST["selectnoticecategory" . $c])){
					//$UserCategory .= "," . $_POST["usercategory" . $c];
					$NoticeCategorys[$c-1] = $_POST["selectnoticecategory" . $c];
				}
			}
		
			$Submit = $_POST["submit"];
			
			$TitleError = array("titleerror","Please enter an Event Title");
			$DetailsError = array("descriptionerror","Please enter the Event Details");
			$LocationError = array("locationerror","Please enter the Event Location");
			$EventDateError = array("eventdateerror","Please enter an Event Date");
			$EventTimeError = array("eventtimeerror","Please enter an Event Time");
			$DurationError = array("eventdurationerror","Please enter an Event Duration");
			
			$EventDateFormatError = array("eventdateformaterror","You must enter the date in the format dd/mm/yyyy");
			$EventTimeFormatError = array("eventtimeformaterror","You must enter the time in the format hh:mm");
	         
	        if($EID > 0){
	            //Edit
	            print("<h2>Edit Event</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewEvent = new Events($EID);
					
					$NewEvent->settitle($Title);
					$NewEvent->setdetails($Details);
					$NewEvent->setlocation($Location);
					$NewEvent->seteventdate(new DateClass("",$EventDate,"","",""));
					$NewEvent->seteventtime($EventTime);
					$NewEvent->setduration($Duration);
									
					$NewEvent->save();			
					
					Events::generatenotice($SendNotice,$NewEvent,$NoticeCategorys,0);
					
					print("<p>The event has been succesfully edited.</p>");
					
					print("<p>Return to <a href='events.php'>Events Admin</a>.</p>");
											       
			     } else {
	                //Form
	                print("<p>To Edit the Event complete the form below. Once you have completed it click the Edit Event button.</p>");
	                
	                $Errors = array($TitleError,$DetailsError,$LocationError,$EventDateError,$EventTimeError,$DurationError,$EventDateFormatError,$EventTimeFormatError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Event = new Events($EID);
	                	             	
	                Events::form($Event->gettitle(),$Event->getdetails(),$Event->getlocation(),$Event->geteventdate()->getnormaldate(),$Event->geteventtime(),$Event->getduration(),$EID,false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Event</h2>");

	            if($Submit){
	                //Add
	                 
					$NewEvent = new Events(0);
					
					$NewEvent->settitle($Title);
					$NewEvent->setdetails($Details);
					$NewEvent->setlocation($Location);
					$NewEvent->seteventdate(new DateClass("",$EventDate,"","",""));
					$NewEvent->seteventtime($EventTime);
					$NewEvent->setduration($Duration);
									
					$NewEvent->savenew();	
					
					Events::generatenotice($SendNotice,$NewEvent,$NoticeCategorys,0);							
				
					print("<p>The new event has been added to the system succesfully.</p>");
				
					print("<p>Return to <a href='events.php'>Events Admin</a>.</p>");
			
				} else {
	                //Form
	                print("<p>To Add a New Event complete the form below. Once you have completed it click the Add Event button.</p>");
	                
	                $Errors = array($TitleError,$DetailsError,$LocationError,$EventDateError,$EventTimeError,$DurationError,$EventDateFormatError,$EventTimeFormatError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Events::form($Title,$Details,$Location,$EventDate,$EventTime,$Duration,$EID,true);
	             }
        	 }
	     }
	     
	     static private function generatenotice($SendNotice,$Event,$NoticeCategorys,$Add){
	    	if($SendNotice == 1){
	    	
		    	$NewNotice = new Notices(0);
		    	
		    	$User = new Users($_SESSION["userid"]);
		    	
		    	if ($Add){
		    		$AddEditStr = "added to";
		    	} else {
		    		$AddEditStr = "edited on";
		    	}
									
				$Notice .= "<p>A new event has been " . $AddEditStr . " the " . SHORTNAME . " website. Details are shown below.</p>";
				
				$Notice .= "<dl>";
				$Notice .= "<dt>Event:</dt><dd>" . $Event->gettitle() . "</dd>";
				$Notice .= "<dt>Details:</dt><dd>" . $Event->getdetails() . "</dd>";
				$Notice .= "<dt>Location:</dt><dd>" . $Event->getlocation() . "</dd>";
				$Notice .= "<dt>Date &amp; Time:</dt><dd>" . $Event->geteventdate()->getnormaldate() . " " . $Event->geteventtime() . "</dd>";
				$Notice .= "<dt>Duration:</dt><dd>" . $Event->getduration() . "</dd>";
				$Notice .= "</dl>";
				
				$Notice .= "<p>You can view this event in the " . SHORTNAME . " <a href=\"" . URL . "/events.php\">website calender</a>.</p>";
	
				$NewNotice->settitle("Event " . $Event->gettitle() . " added to " . SHORTNAME . " website.");
				$NewNotice->setnotice($Notice);
				$NewNotice->setdateadded(new DateClass("","","","",""));
				$NewNotice->setpostedby($User);
				$NewNotice->savenew();
				
				foreach($NoticeCategorys as $NC)
				{
					$WQ = new WriteQuery("INSERT INTO NoticesCategorys (NoticeIDLNK, CategoryIDLNK, Deleted) VALUES (" . $NewNotice->getid() . ", " . $NC . ",0);");
					
					//echo($WQ->getquery());
				}
				
				Notices::sendemail($NewNotice->getid());
			}
	    }

	     
    	static public function form($Title,$Details,$Location,$EventDate,$EventTime,$Duration,$EID,$Add)
        {
        	$NoticeCategoryArray = UserCategory::generatearray();
        
        	$TitleField = array("Event Title:","Text","title",65,0,$Title,"","",!$Add);
        	$DetailsField = array("Details:","TextArea","details",63,10,$Details);
        	$LocationField = array("Location:","Text","location",65,0,$Location);
        	$EventDateField = array("Event Date:","Text","eventdate",10,0,$EventDate);
        	$EventTimeField = array("Event Time:","Text","eventtime",10,0,$EventTime);
        	$DurationField = array("Duration:","Text","duration",10,0,$Duration);
        	$SendNoticeField = array("Send Notice:","Checkbox","sendnotice",0,0,0,1,"shownoticecategorys(this)");
        	$NoticeCategoryField = array("Notice Category:","CheckboxArray","selectnoticecategory",0,0,"",$NoticeCategoryArray);
        	
        	
        	$Fields = array($TitleField,$DetailsField,$LocationField,$EventDateField,$EventTimeField,$DurationField,$SendNoticeField,$NoticeCategoryField);

            
			if($EID == -1){
				$Button = "Add Event";
            	Forms::generateform("eventsform","events.php?eid=$EID","return checkeventsform(this)",false,$Fields,$Button);
			} else {
				$Button = "Edit Event";
				Forms::generateform("eventsform","events.php?eid=$EID","return checkeventsform(this)",false,$Fields,$Button);
			}
           
        }
        
		static public function deleteevent($EID){
        	$Event = new Events($EID);
        	
        	$Event->setdeleted(1);
        	
        	$Event->save();
        }     

       
    }

?>