<?php

    class Notices
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
        var $c_Notice;
        var $c_DateAdded;
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
        
        function setnotice($Val)
        {
        	$this->c_Notice = $Val;
        }
        
        function getnotice()
        {
        	return $this->c_Notice;
        }
        
        function setdateadded($Val)
        {
            $this->c_DateAdded = $Val;
        }
        
        function getdateadded()
        {
            return $this->c_DateAdded;
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
        	$RQ = new ReadQuery("SELECT CategoryIDLNK FROM NoticesCategorys WHERE NoticeIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        
        	$Counter = 0;
        	
        	//$Cats = new array;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		$CatArray[$Counter] = $row["CategoryIDLNK"];
        		
        		$Counter ++;
        	}
        	
        	print_r($CatArray);
        	
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

        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Notices WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_Notice = $row["Notice"];
                $this->c_DateAdded = new DateClass("",$row["DateAdded"],"","","");
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
        	$WQ = new WriteQuery("INSERT INTO Notices (Title, Notice, DateAdded, PostedByIDLNK, Deleted) VALUES ('" . $this->gettitle() .  "', '" . $this->getnotice() . "', '" . $DA->getdatabasedate() . "'," . $PB->getid() . ", 0)");
        	//echo($WQ->getquery());
        	//echo($WQ->getquery());
            $this->c_ID -> insert_id;

       
        }
        
        function save()
        {
        	$DA = $this->getdateadded();
        	$PB = $this->getpostedby();
        	//echo($this->gettitle());
            $WQ = new WriteQuery("UPDATE Notices SET Title = '" . $this->gettitle() . "', Notice = '" . $this->getnotice() . "', DateAdded = '" . $DA->getdatabasedate() . "', PostedByIDLNK = " . $PB->getid() . ", Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//secho($WQ->getquery());
        }
        
        static private function generatenotice($NoticeID)
        {
        	$Notice = new Notices($NoticeID);
        	
        	$Message .= "<h2>" . $Notice->gettitle() . "</h2>";
        
        	$Message .= "<dl>";
        		$Message .= "<dt>Notice:</dt>";
        		$Message .= "<dd class=\"notice\">" . $Notice->getnotice() . "</dd>";
        		$Message .= "<dt>Date Posted:</dt>";
        		$Message .= "<dd class=\"notice\">" . $Notice->getdateadded()->getnormaldate() . "</dd>";
        		$Message .= "<dt>Posted by:</dt>";
        		$Message .= "<dd class=\"notice\">" . $Notice->getpostedby()->getfullname() . "</dd>";
        		$Message .= "<dt>Notice Categorys:</dt>";
        		$Message .= "<dd class=\"notice\">" . $Notice->getcategorysbydesc() . "</dd>";
        	$Message .= "</dl>";
        	
        	return $Message;
        }
        
        static public function shownotice($NoticeID)
        {
        	print(Notices::generatenotice($NoticeID));
        	
        	print("<p>Return to <a href=\"notices.php\">Notices Index</a></p>");
        }
        
        static public function listall()
        {
     		//Normal     		
     		print("<h2>Notices</h2>");
				
			print("<p>The list below shows all notices.</p>");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Notice","noticetitle",1);
			$Col2 = array("Date Added","documents",1);
			$Col3 = array("Posted By","postedby",1);
            $Cols = array($Col1,$Col2,$Col3);
            $Rows = array();
            $RowCounter = 0;
            
            $RQ0 = new ReadQuery("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . " AND Deleted = 0;");
			
			while($row = $RQ0->getresults()->fetch_array(MYSQLI_ASSOC)){
				$Categorys .= "," . $row["CategoryIDLNK"];
			}
			
			$RQ1 = new ReadQuery("SELECT NoticeIDLNK FROM NoticesCategorys WHERE CategoryIDLNK IN (" . substr($Categorys,1) . ")");
			
			if($RQ1->getnumberofresults() != 0){
			
			
				while($row = $RQ1->getresults()->fetch_array(MYSQLI_ASSOC)){
					$Notices .= "," . $row["NoticeIDLNK"];
				}
				
				$RQ = new ReadQuery("SELECT IDLNK FROM Notices WHERE IDLNK IN (" . substr($Notices,1) . ") AND Deleted = 0 ORDER BY DateAdded DESC");
            
				while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
					$Notice = new Notices($row["IDLNK"]);
					$DA = $Notice->getdateadded();
					$Row1 = array("<span class=\"title\"><a href=\"?nid=" . $Notice->getid() . "\">" . $Notice->gettitle() . "</a></span>"," ");
					$Row2 = array($DA->getnormaldate(),"");	
					$Row3 = array($Notice->getpostedby()->getfullname()," ");			
					$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
	                $RowCounter ++;
					
					//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
				}
			
			}
			
			Tables::generateadmintable("noticestable",$Cols,$Rows);
        
        }

        
        static public function listadmin()
        {
     		//Normal
     		print("<h2>Notices</h2>");
				
			print("<p>The list below shows all notices.</p>");
			
			print("<p><a href='notices.php?nid=-1'><img src=\"Images/email_add.png\" alt=\"Add New Notice\"/>Add New Notice</a></p>");
							
			$RQ = new ReadQuery("SELECT IDLNK FROM Notices WHERE Deleted = 0 ORDER BY DateAdded");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Notice","noticetitle",1);
			$Col2 = array("Date Added","documents",1);
			$Col3 = array("Posted By","postedby",1);
            $Col4 = array("","operations", 1);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Notice = new Notices($row["IDLNK"]);
				$DA = $Notice->getdateadded();
				$Row1 = array("<span class=\"title\"><a href=\"?nid=" . $Notice->getid() . "\">" . $Notice->gettitle() . "</a></span>"," ");
				$Row2 = array($DA->getnormaldate()," ");	
				$Row3 = array($Notice->getpostedby()->getfullname()," ");				
				//$Row6 = array("<a href=?lid=-". $Lab->getid() ."><img src=\"Images/building_delete.png\" alt=\"Delete Lab\"/></a>","button");
				$Row4 = array("<a onclick=\"confirmdialog('Delete Notice " . $Notice->gettitle() . "', '?nid=". $Notice->getid() ."&amp;aid=10');\"><img src=\"Images/email_delete.png\" alt=\"Delete Notice\"/></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4);

                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("adminnoticestable",$Cols,$Rows);        
        }
             
    	static public function addedit($NID)
	    {
			$Title = $_POST["title"];
			$Notice = $_POST["notice"];
			
			//Get Number of Categorys
			$NofC = UserCategory::gettotal();
			
			//$UserCategorys = new array();
			
			for($c=1;$c<=$NofC;$c++)
			{
				if(isset($_POST["noticecategory" . $c])){
					//$UserCategory .= "," . $_POST["usercategory" . $c];
					$NoticeCategorys[$c-1] = $_POST["noticecategory" . $c];
				}
			}
			
			$Submit = $_POST["submit"];
			
			//$Group = 
			
			$TitleError = array("titleerror","Please enter a Notice Title.");
			$NoticeError = array("noticeerror","Please enter a Notice");
			$CategoryError = array("categoryerror","Please select at least one Category");
	         
	        //Add
            print("<h2>Add New Notice</h2>");

            if($Submit){
                //Add
                 
				$NewNotice = new Notices(0);
				
				$User = new Users($_SESSION["userid"]);	
				
				$NewNotice->settitle($Title);
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
									
				print("<p>The new notice has been added to the system and sent to all system users succesfully.</p>");
				
				print("<p>Return to <a href='notices.php'>Notices Admin</a>.</p>");				
								
			} else {
                //Form
                print("<p>To Add a New Notice complete the form below. Once you have completed it click the Send Notice Button and the Notice will be sent to all site users..</p>");
                
                $Errors = array($TitleError,$NoticeError,$CategoryError);
    			
    			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
    			
                Notices::form($Title,$Notice,$NoticeCategory,$NID);
             }
        	
	     }
	     
    	static public function form($Title,$Notice,$NoticeCategorys,$NID)
        {
        	$NoticeCategoryArray = UserCategory::generatearray();
        
          	$TitleField = array("Title:","Text","title",65,0,$Title);
        	$NoticeField = array("Notice:","TextArea","notice",63,7,$Notice);
        	$NoticeCategoryField = array("Notice Category:","CheckboxArray","noticecategory",0,0,$NoticeCategory,$NoticeCategoryArray);
        	
			$Fields = array($TitleField,$NoticeField,$NoticeCategoryField);

           	$Button = "Send Notice";
			
			Forms::generateform("noticesform","notices.php?nid=" . $NID, "return checknoticeform(this,2)",false,$Fields,$Button);
			
			print("<p>Return to the <a href=\"notices.php\">Notices List</a></p>");
           
        }
        
        static public function sendemail($NoticeID)
        {
        	$Notice = new Notices($NoticeID);
        
        	$msg = Notices::generatenotice($NoticeID);
        	
        	//echo(Users::allemailsbycategory($Notice->getcategorysbyid()));
					
			Emails::sendemail(Users::allemails($Notice->getcategorys()),$Notice->gettitle(),$msg);
        }
        
		static public function deletenotice($NID){
        	$Notice = new Notices($NID);
        	
        	$Notice->setdeleted(1);
        	
        	$Notice->save();
        } 
        
        static public function lastnotices(){
        	$RQ0 = new ReadQuery("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . " AND Deleted = 0;");
			


			while($row = $RQ0->getresults()->fetch_array(MYSQLI_BOTH)){
				$Categorys .= "," . $row["CategoryIDLNK"];
			}
			
			$RQ1 = new ReadQuery("SELECT NoticeIDLNK FROM NoticesCategorys WHERE CategoryIDLNK IN (" . substr($Categorys,1) . ")");
			
			if($RQ1->getnumberofresults() != 0){
			
			
				while($row = $RQ1->getresults()->fetch_array(MYSQLI_BOTH)){
					$Notices .= "," . $row["NoticeIDLNK"];
				}
				
				$RQ = new ReadQuery("SELECT IDLNK FROM Notices WHERE IDLNK IN (" . substr($Notices,1) . ") AND Deleted = 0 ORDER BY DateAdded DESC LIMIT 0,5");
        	
	        	print("<ul>");
	        	
	        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
	        		$Notice = new Notices($row["IDLNK"]);
	        		
	        		print("<li><a href=\"notices.php?nid=" .$Notice->getid() . "\">" . $Notice->gettitle() . "</a></li>");
	        	}
	        	
	        	print("</ul>");
        	
        	} else {
        	
        		print("<p>No Notices to show.</p>");
        	
        	}
        }    
                       
    }

?>