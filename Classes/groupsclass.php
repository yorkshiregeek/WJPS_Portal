<?php

    class Groups
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Group;
        var $c_Description;
        var $c_Deleted;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function setgroup($Val)
        {
            $this->c_Group = $Val;
        }
        
        function getgroup()
        {
            return $this->c_Group;
        }
        
        function setdescription($Val)
        {
            $this->c_Description = $Val;
        }
        
        function getdescription()
        {
            return $this->c_Description;
        }
               
        function setdeleted($Val)
        {
            $this->c_Deleted = $Val;
        }
        
        function getdeleted()
        {
            return $this->c_Deleted;
        }
        
        function geturl()
        {
        	$FN = str_replace(" ", "_", $this->getgroup());
        	
        	return "../private/" . $this->getid() . $FN;
        }
        
        function getsections()
        {
        	$RQ = new ReadQuery("SELECT COUNT(IDLNK) FROM Sections WHERE GroupIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	
        	$row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
        	
        	return $row["COUNT(IDLNK)"];
        }
        
        function getdocuments()
        {
        	$RQ0 = new ReadQuery("SELECT IDLNK FROM Sections WHERE GroupIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	        	
        	while($row = $RQ0->getresults()->fetch_array(MYSQLI_ASSOC)){
        		$Sections = $Sections . ", " . $row["IDLNK"];
        	}
        	
        	$Sections = substr($Sections, 2);
        	
        	if($Sections != ""){        	
        		$RQ = new ReadQuery("SELECT COUNT(IDLNK) FROM Documents WHERE SectionIDLNK IN (" . $Sections . ") AND Deleted = 0;");
	        	//echo($RQ->getquery());
	        	$row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
	        	
	        	return $row["COUNT(IDLNK)"];
        	} else {
        		return 0;
        	}

        }
        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Groups WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Group = $row["GroupName"];
                $this->c_Description = $row["Description"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$WQ = new WriteQuery("INSERT INTO Groups (GroupName, Description, Deleted) VALUES ('" . $this->getgroup() . "', '" . $this->getdescription() . "', 0)");
        	//echo($WQ->getquery());
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
            $WQ = new WriteQuery("UPDATE Groups SET GroupName = '" . $this->getgroup() . "', Description = '" . $this->getdescription() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function menulist($LID)
        {
        	
        	$RQ = new ReadQuery("SELECT IDLNK FROM Labs WHERE Deleted = 0 ORDER BY LabName");
        	
        	print("<ul class = \"nav nav-tabs\">");
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
        	
        		$Lab = new Labs($row["IDLNK"]);
        		
        		if($Lab->getid() == $LID){
        			print("<li class=\"active\"><a href=\"lab.php?lid=" . $Lab->getid() . "\">" . $Lab->getlabname() . "</a></li>");
				} else {
					print("<li><a data-toggle=\"tab\" href=\"lab.php?lid=" . $Lab->getid() . "\">" . $Lab->getlabname() . "</a></li>");
				}
        	}
        	
        	print("</ul>");
        	
        }
        
        static public function listall()
        {
     		//Normal
     		
     		print("<h2><a href=\"documents.php\">Groups</a></h2>");
				
			print("<p>The list below shows all document groups.");
						
			$RQ = new ReadQuery("SELECT IDLNK FROM Groups WHERE Deleted = 0 ORDER BY GroupName");
			
			//echo($RQ->getquery());
			
			$Col1 = array("GroupName","groupname",1);
			$Col2 = array("Sections","sections",1);
			$Col3 = array("Documents","documents",1);
            $Cols = array($Col1,$Col2,$Col3);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				$Group = new Groups($row["IDLNK"]);
				$Row1 = array("<span class=\"title\"><a href='documents.php?gid=" . $Group->getid() . "'>" . $Group->getgroup() . "</a></span><br/><span class=\"content\">" . $Group->getdescription() . "</span>"," ");
				$Row2 = array($Group->getsections()," ");
				$Row3 = array($Group->getdocuments()," ");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("groupstable",$Cols,$Rows);
        
        }

        
        static public function listadmin()
        {
     		//Normal
     		
     		print("<h2><a href=\"documents.php\">Groups</a></h2>");
				
			print("<p>The list below shows all document groups. From this page you can add, edit or delete groups.</p>");
			
			print("<p><a href='documents.php?gid=-1'><span class=\"glyphicon glyphicon-plus\"></span> Add New Group</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Groups WHERE Deleted = 0 ORDER BY GroupName");
			
			//echo($RQ->getquery());
			
			$Col1 = array("GroupName","groupname",1);
			$Col2 = array("Sections","sections",1);
			$Col3 = array("Documents","documents",1);
            $Col4 = array("","operations", 2);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				$Group = new Groups($row["IDLNK"]);
				$Row1 = array("<span class=\"title\"><a href='documents.php?gid=" . $Group->getid() . "'>" . $Group->getgroup() . "</a></span><br/><span class=\"content\">" . $Group->getdescription() . "</span>"," ");
				$Row2 = array($Group->getsections(),"sections");
				$Row3 = array($Group->getdocuments(),"documents");
				$Row4 = array("<a href=?gid=". $Group->getid() ."&amp;aid=5><span class=\"glyphicon glyphicon-pencil\" alt=\"Edit\"></span></a>");
                           
				//$Row6 = array("<a href=?lid=-". $Lab->getid() ."><img src=\"Images/building_delete.png\" alt=\"Delete Lab\"/></a>","button");
				
				$Row5 = array("<a onclick=\"confirmdialog('Delete Group " . $Group->getgroup() . "', '?gid=". $Group->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\" alt =\"edit\"></span></a>");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("admingroupstable",$Cols,$Rows);
        
        }
             
    	static public function addedit($GID)
	    {
			$GroupName = $_POST["group"];
			$Description = $_POST["description"];
			
			$Submit = $_POST["submit"];
			
			$DefaultError = array("defaulterror","A group with this name already exists.");
			$GroupNameError = array("groupnameerror","Please enter a Group Name");
	         
	        if($GID > 0){
	            //Edit
	            print("<h2>Edit Group</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewGroup = new Groups($GID);
					
					$NewGroup->setgroup($GroupName);
					$NewGroup->setdescription($Description);
					
					$NewGroup->save();
					
					print("<p>The group has been succesfully edited.</p>");
					
					print("<p>Return to <a href='documents.php'>Groups Admin</a>.</p>");	       
			     } else {
	                //Form
	                print("<p>To Edit the Group complete the form below. Once you have completed it click the Edit Group button.</p>");
	                
	                $Errors = array($DefaulError,$GroupNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Group = new Groups($GID);
	                	             	
	                Groups::form($Group->getgroup(),$Group->getdescription(),$Group->getid(),false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Group</h2>");

	            if($Submit){
	                //Add
	                
	                $NewGroup = new Groups(0);
					
					$NewGroup->setgroup($GroupName);
					$NewGroup->setdescription($Description);
	                 
	                if(!Groups::exists($GroupName)){
	                	//Add Group
						$NewGroup->savenew();
											
						//mkdir($NewGroup->geturl());
										
						print("<p>The new group has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='documents.php'>Groups Admin</a>.</p>");
	                } else {
	                	//Group Exists
	                	print("<p>To Add a New Group complete the form below. Once you have completed it click the Add Group button.</p>");
	                
	                	$Errors = array($DefaultError,$GroupNameError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	                	Groups::form($GroupName,$Description,$GID,true);
	                }
				} else {
	                //Form
	                print("<p>To Add a New Group complete the form below. Once you have completed it click the Add Group button.</p>");
	                
	                $Errors = array($GroupNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Groups::form($GroupName,$Description,$GID,true);
	             }
        	 }
	     }
	     
    	static public function form($Group,$Description,$GID,$Add)
        {
        	$GroupField = array("Group Name:","Text","group",65,0,$Group);
        	$DescriptionField = array("Description:","TextArea","description",63,7,$Description);
        
			$Fields = array($GroupField,$DescriptionField);

            
			if($GID == -1){
				$Button = "Add Group";
  			} else {
				$Button = "Edit Group";
			}
			
			if(!$Add){
				$AddInfo = "&amp;aid=5";
			}
			
			Forms::generateform("groupsform","documents.php?gid=" . $GID . $AddInfo,"return checkgroupform(this)",false,$Fields,$Button);
           
           	print("<p>Return to the <a href=\"documents.php\">Groups List</a></p>");
        }
        
        static public function exists($Group)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Groups WHERE GroupName = '" . $Group . "' AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        	
        	if($RQ->getnumberofresults() > 0)
        	{
        		return true;
        	} else {
        		return false;
        	}
        }
        
		static public function deletegroup($GID){
        	$Group = new Groups($GID);
        	
        	$Group->setdeleted(1);
        	
        	$Group->save();
        
        	$RQ = new WriteQuery("UPDATE Sections SET Deleted = 1 WHERE GroupIDLNK =" . $Group->getid() . ";");
        }     
                
    	
        
                
        
        
    }

?>