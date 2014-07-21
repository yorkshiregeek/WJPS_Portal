<?php

    class Sections
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Group;
        var $c_Section;
        var $c_Description;
        var $c_Deleted;

        var $c_AccessCategorys;
        
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
        
        function setsection($Val)
        {
        	$this->c_Section = $Val;
        }
        
        function getsection()
        {
        	return $this->c_Section;
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
        
        function geturl()
        {
        	$FN = str_replace(" ", "_", $this->getsection());
        	
        	return $this->getgroup()->geturl() . "/" . $this->getid() . $FN;
        }

        
        function getdeleted()
        {
            return $this->c_Deleted;
        }
        
        function getdocuments()
        {

            if($_SESSION["isadmin"] == true){
                $RQ = new ReadQuery("SELECT COUNT(IDLNK) FROM Documents WHERE SectionIDLNK = " . $this->getid() . " AND Deleted = 0;");
            } else {

                $RQ = new ReadQuery("SELECT COUNT(IDLNK) FROM Documents WHERE SectionIDLNK = " . $this->getid() . " AND Deleted = 0 AND IDLNK IN (SELECT DocumentIDLNK FROM DocumentUserCategorys WHERE UserCategoryIDLNK IN (SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . "));");
            }

        	$row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
        	
        	return $row["COUNT(IDLNK)"];

        }

        function getaccesscategorys()
        {
            $RQ = new ReadQuery("SELECT UserCategoryIDLNK FROM SectionUserCategorys WHERE SectionIDLNK = " . $this->getid() . ";");
          
            $Counter = 0;
            
            //$Cats = new array;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                $CatArray[$Counter] = $row["UserCategoryIDLNK"];
                
                $Counter ++;
            }
            
            return $CatArray;
        }
        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Sections WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Group = new Groups($row["GroupIDLNK"]);
                $this->c_Section = $row["Section"];
                $this->c_Description = $row["Description"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$Group = $this->getgroup();
        	$WQ = new WriteQuery("INSERT INTO Sections (GroupIDLNK, Section, Description, Deleted) VALUES (" . $Group->getid() . ", '" . $this->getsection() ."', '" . $this->getdescription() . "', 0)");
        	//echo($WQ->getquery());
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
            $WQ = new WriteQuery("UPDATE Sections SET GroupIDLNK = " . $this->getgroup()->getid() . ",Section = '" . $this->getsection() . "', Description = '" . $this->getdescription() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall($GID)
        {
     		//Normal

            print("<div class=row>");

            print("<div class='col-md-12'>");
     		
     		$Group = new Groups($GID);

            print("<ol class='breadcrumb'>");
                print("<li><a href=\"documents.php\">Groups</a></li>");
                print("<li class='active'>" . $Group->getgroup() . "</li>");
            print("</ol>");

            print("</div>");

            print("</div>");

            print("<div class=row>");

            print("<div class='col-md-9'>");
     			
			print("<p class='lead'>The list below shows all <strong>" . $Group->getgroup() . "</strong> group sections.</p>");
			
            print("</div>");

            Documents:: documentsearchbox($Term);

            print("</div>");
            print("<div class='row'>");
            print("<div class='col-md-12'>");

			//SELECT IDLNK FROM Sections WHERE Deleted = 0 AND IDLNK IN (SELECT SectionIDLNK FROM SectioUserCategorys WHERE UserCategoryIDLNK IN (SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = 1)) ORDER BY GroupName;

            $RQ = new ReadQuery("SELECT IDLNK FROM Sections WHERE GroupIDLNK = $GID AND Deleted = 0 AND IDLNK IN (SELECT SectionIDLNK FROM SectionUserCategorys WHERE UserCategoryIDLNK IN (SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . ")) ORDER BY Section;");
        
			//echo($RQ->getquery());
			
			$Col1 = array("Section","sectionname",1);
			$Col2 = array("Documents","documents",1);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Section = new Sections($row["IDLNK"]);
				$Row1 = array("<span class=\"title\"><a href=\"?sid=" . $Section->getid() . "&amp;sgid=" . $GID . "\">" . $Section->getsection() . "</a></span><br/><span class=\"content\">" . $Section->getdescription() . "</span>"," ");
				$Row2 = array($Section->getdocuments(),"documents");				
				$Rows[$RowCounter] = array($Row1,$Row2);
                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("sectionstable",$Cols,$Rows);

            print("</div>");

            print("</div>");
        
        }

        
        static public function listadmin($GID)
        {
   
            //Normal
            print("<div class=row>");

                print("<div class='col-md-12'>");
             		$Group = new Groups($GID);
             		
             		print("<ol class='breadcrumb'>");
                        print("<li><a href=\"documents.php\">Groups</a></li>");
                        print("<li class='active'>" . $Group->getgroup() . "</li>");
                    print("</ol>");

                print("</div>");

            print("</div>");

            print("<div class=row>");

                print("<div class='col-md-9'>");

        			print("<p class='lead'>The list below shows all <strong>" . $Group->getgroup() . "</strong> group sections. From this page you can add, edit or delete sections.</p>");
        			
        			print("<p><a href='documents.php?sid=-1&amp;sgid=" . $GID . "'><span class=\"glyphicon glyphicon-plus\"></span>Add New Section</a></p>");
			
                print("</div>");

                Documents:: documentsearchbox($Term);

            print("</div>");
            
            print("<div class='row'>");
            
                print("<div class='col-md-12'>");

            if($_SESSION["isadmin"] == true){

                $RQ = new ReadQuery("SELECT IDLNK FROM Sections WHERE GroupIDLNK = " . $GID . " AND Deleted = 0 ORDER BY Section");
            

            } else {

                $RQ = new ReadQuery("SELECT IDLNK FROM Sections WHERE GroupIDLNK = $GID AND Deleted = 0 AND IDLNK IN (SELECT SectionIDLNK FROM SectionUserCategorys WHERE UserCategoryIDLNK IN (SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . ")) ORDER BY Section;");
            }

			//echo($RQ->getquery());
			
			$Col1 = array("Section","sectionname",1);
			$Col2 = array("Documents","documents",1);
            $Col3 = array("","operations", 2);
            $Cols = array($Col1,$Col2,$Col3);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Section = new Sections($row["IDLNK"]);
				$Row1 = array("<span class=\"title\"><a href=\"?sid=" . $Section->getid() . "&amp;sgid=" . $GID . "\">" . $Section->getsection() . "</a></span><br/><span class=\"content\">" . $Section->getdescription() . "</span>"," ");
				$Row2 = array($Section->getdocuments(),"documents");
				$Row3 = array("<a alt = \"Edit Section\" href=?sid=". $Section->getid() ."&amp;sgid=" . $Group->getid() . "&amp;aid=5><span class=\"glyphicon glyphicon-pencil\"></span></a>","button");
				//$Row6 = array("<a href=?lid=-". $Lab->getid() ."><img src=\"Images/building_delete.png\" alt=\"Delete Lab\"/></a>","button");
				
				$Row4 = array("<a alt = \"Delete Folder\" onclick=\"confirmdialog('Delete Section " . $Section->getsection() . "', '?sgid=" . $GID . "&amp;sid=". $Section->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\"></span></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4);
                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("adminsectionstable",$Cols,$Rows);

            print("</div>");

            print("</div>");
        
        }
             
    	static public function addedit($SID,$SGID)
	    {
			$SectionName = $_POST["section"];
			$Description = $_POST["description"];

            //Get Number of Categorys
            $NofC = UserCategory::gettotalbygroup($SGID);
            
            for($c=1;$c<=$NofC;$c++)
            {
                if(isset($_POST["accesscategory" . $c])){
                    $AccessCategorys[$c-1] = $_POST["accesscategory" . $c];
                }
            }
			
			if(isset($_POST["gid"])){
				$GroupID = $_POST["gid"];
			} else {
				$GroupID = $SGID;
			}
			
			$Submit = $_POST["submit"];
			
			//$Group = 
			
			$DefaultError = array("defaulterror","A section with this name already exists in.");
			$SectionNameError = array("sectionnameerror","Please enter a Section Name");
	         
	        if($SID > 0){
	            //Edit
	            //print("<h2>Edit Section</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewSection = new Sections($SID);
					
					$NewSection->setgroup(new Groups($GroupID));
					$NewSection->setsection($SectionName);
					$NewSection->setdescription($Description);
					
					$NewSection->save();

                    $WQ = new WriteQuery("DELETE FROM SectionUserCategorys WHERE GroupIDLNK = " . $NewSection->getid() . ";");

                    foreach($AccessCategorys as $AC)
                    {
                        $WQ = new WriteQuery("INSERT INTO SectionUserCategorys (SectionIDLNK, UserCategoryIDLNK) VALUES (" . $NewSection->getid() . ", " . $AC . ");");
                    }
					
					print("<p class='lead'>The section has been succesfully edited.</p>");
					
					print("<p>Return to <a href='documents.php?gid=$GroupID'>Sections Admin</a>.</p>");	       
			     } else {
	                //Form
	                print("<p class='lead'>To Edit the Section complete the form below. Once you have completed it click the Edit Section button.</p>");
	                
	                $Errors = array($DefaulError,$SectionNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Section = new Sections($SID);
	                	             	
	                Sections::form($Section->getgroup()->getid(),$Section->getsection(),$Section->getdescription(),$Section->getaccesscategorys(),$Section->getid(),false);
	             }
        	 } else {
        	 //Add
	            if($Submit){
	                //Add
	                 
					$NewSection = new Sections(0);
					
					$NewSection->setgroup(new Groups($GroupID));
					$NewSection->setsection($SectionName);
					$NewSection->setdescription($Description);
					
					if(!Sections::exists($SectionName)){
						//All Ok
						
						$NewSection->savenew();

                        foreach($AccessCategorys as $AC)
                        {
                            $WQ = new WriteQuery("INSERT INTO SectionUserCategorys (SectionIDLNK, UserCategoryIDLNK) VALUES (" . $NewSection->getid() . ", " . $AC . ");");
                        }
					
						//mkdir($NewSection->geturl());
										
						print("<p class='lead'>The new section has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='documents.php?gid=$GroupID'>Sections Admin</a>.</p>");

					} else {
						//Group Exits
						
						print("<p class='lead'>To Add a New Section complete the form below. Once you have completed it click the Add Section button.</p>");
							                
	                	$Errors = array($DefaultError,$GroupNameError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	                	Groups::form($GroupName,$Description,$AccessCategorys,$GID,true);
					}
					
									
				} else {
	                //Form
	                print("<p class='lead'>To Add a New Section complete the form below. Once you have completed it click the Add Section button.</p>");
	                
	                $Errors = array($SectionNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Sections::form($GroupID,$Section,$Description,$AccessCategorys,$SID,true);
	             }
        	 }
	     }
	     
    	static public function form($GroupID,$Section,$Description,$AccessCategorys,$SID,$Add)
        {

            $AccessCategoryArray = UserCategory::generatearraybygroup($GroupID);

        	$GroupIDField = array("Group ID:","Hidden","gid",65,0,$GroupID,"","");
        	$SectionField = array("Section:","Text","section",65,0,$Section,"Enter a Section name.","");
        	$DescriptionField = array("Description:","TextArea","description",63,7,$Description,"Enter a Section descritpion.");
            $AccessGroups = array("Access Groups:","CheckboxArrayCollapse","accesscategory",65,0,$AccessCategorys,"",$AccessCategoryArray);

			$Fields = array($SectionField,$DescriptionField,$AccessGroups,$GroupIDField);

            
			if($SID == -1){
				$Button = "Add Section";
  			} else {
				$Button = "Edit Section";
			}
			
			if(!$Add){
				$AddInfo = "&amp;aid=5";
			}
			
			Forms::generateform("sectionsform","documents.php?sid=" . $SID . "&amp;sgid=" . $GroupID . $AddInfo,"return checksectionform(this)",false,$Fields,$Button);
			
			$Group = new Groups($GroupID);
			
			print("<p>Return to the <a href=\"documents.php?gid=$GroupID\">" . $Group->getgroup() . " Sections List</a></p>");
           
        }
        
        static public function exists($Section)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Sections WHERE Section = '" . $Section . "' AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        	
        	if($RQ->getnumberofresults() > 0)
        	{
        		return true;
        	} else {
        		return false;
        	}
        }

        
		static public function deletesection($SID){
        	$Section = new Sections($SID);
        	
        	$Section->setdeleted(1);
        	
        	$Section->save();
        	
        	//Delete Section Documents
        	
        	$RQ = new WriteQuery("UPDATE Documents SET Deleted = 1 WHERE SectionIDLNK =" . $Section->getid() . ";");
        }     
                       
    }

?>