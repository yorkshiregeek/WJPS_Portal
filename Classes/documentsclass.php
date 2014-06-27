<?php

    class Documents
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Section;
        var $c_Filename;
        var $c_Description;
        var $c_DateModified;
        var $c_FileSize;
        var $c_FileType;
        var $c_File;
        var $c_Deleted;
        
        function getid()
        {
            return $this->c_ID;
        }
                
        function setsection($Val)
        {
        	$this->c_Section = $Val;
        }
        
        function getsection()
        {
        	return $this->c_Section;
        }
 
 		function setfilename($Val)
        {
        	$this->c_Filename = $Val;
        }
        
        function getfilename()
        {
        	return $this->c_Filename;
        }
        
        function setdescription($Val)
        {
            $this->c_Description = $Val;
        }
        
        function getdescription()
        {
            return $this->c_Description;
        }

		function setdatemodified($Val)
        {
            $this->c_DateModified = $Val;
        }
        
        function getdatemodified()
        {
            return $this->c_DateModified;
        }
        
        function setfilesize($Val)
        {
            $this->c_FileSize = $Val;
        }
        
        function getfilesize()
        {
            return $this->c_FileSize;
        }
        
        function setfiletype($Val)
        {
            $this->c_FileType = $Val;
        }
        
        function getfiletype()
        {
            return $this->c_FileType;
        }
        
        function setfile($Val)
        {
            $this->c_File = $Val;
        }
        
        function getfile()
        {
            return $this->c_File;
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
        	return $this->getsection()->geturl() . "/" . $this->getid() . $this->getfilename();
        }

        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Documents WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Section = new Sections($row["SectionIDLNK"]);
                $this->c_Filename = $row["Filename"];
                //echo($this->getfilename());
                $this->c_Description = $row["Description"];
                $this->c_DateModified = new DateClass("",$row["DateModified"],"","","");
                $this->c_FileSize = $row["FileSize"];
                $this->c_FileType = $row["FileType"];
                $this->c_File = stripslashes($row["File"]);
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$DM = $this->getdatemodified();
        	$WQ = new WriteQuery("INSERT INTO Documents (SectionIDLNK, Filename, Description, DateModified, Filesize, FileType, Deleted) VALUES (" . $this->getsection()->getid() . ", '" . $this->getfilename() ."', '" . $this->getdescription() . "','" . $DM->getdatabasedate() . "'," . $this->getfilesize() . ",'" . $this->getfiletype() . "', 0)");
        	//echo($WQ->getquery());
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
        	$DM = $this->getdatemodified();
        	$WQ = new WriteQuery("UPDATE Documents SET SectionIDLNK = " . $this->getsection()->getid() . ", Filename = '" . $this->getfilename() . "', Description = '" . $this->getdescription() . "', DateModified = '" . $DM->getdatabasedate() . "', Filesize = " . $this->getfilesize() . ", FileType = '" . $this->getfiletype() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall($SID)
        {
     		//Normal
     		
     		$Section = new Sections($SID);


     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Groups</a></li>");
     			print("<li> <a href=\"documents.php?gid=" . $Section->getgroup()->getid() . "\">" . $Section->getgroup()->getgroup() . "</a></li>");
     			print("<li class='active'>" . $Section->getsection() . "</li>");
     		print("</ol>");
				
			print("<p class='lead'>The list below shows all the documents in <strong>" . $Section->getsection() . "</strong> section.");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 ORDER BY Filename");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Document","sectionname",1);
			$Col2 = array("Date Modified","documents",1);
			$Col3 = array("Filesize","documents",1);
            $Cols = array($Col1,$Col2,$Col3);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Document = new Documents($row["IDLNK"]);
				$Section = $Document->getsection();
				$Row1 = array("<span class=\"title\"><a href=\"downloads.php?did=" . $Document->getid() . "\">" . $Document->getfilename() . "</a></span><br/><span class=\"content\">" . $Document->getdescription() . "</span>"," ");
				$Row2 = array($Document->getdatemodified()->getnormaldate()," ");
				$Row3 = array(Documents::display_filesize($Document->getfilesize())," ");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("documenttable",$Cols,$Rows);
        
        }

        
        static public function listadmin($SID)
        {
     		//Normal
     		
     		$Section = new Sections($SID);

     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Groups</a></li>");
     			print("<li> <a href=\"documents.php?gid=" . $Section->getgroup()->getid() . "\">" . $Section->getgroup()->getgroup() . "</a></li>");
     			print("<li class='active'>" . $Section->getsection() . "</li>");
     		print("</ol>");
     			
			print("<p class='lead'>The list below shows all the documents in <strong>" . $Section->getsection() . "</strong> section.");
						
			print("<p><a href='documents.php?did=-1&amp;dsid=" . $SID . "'><span class=\"glyphicon glyphicon-plus\" alt= \"Add New Document\" ></span>Add New Document</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 ORDER BY Filename");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Document","sectionname",1);
			$Col2 = array("Date Modified","documents",1);
			$Col3 = array("Filesize","documents",1);
            $Col4 = array("","operations", 2);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Document = new Documents($row["IDLNK"]);
				$Section = $Document->getsection();
				$Row1 = array("<span class=\"title\"><a href=\"downloads.php?did=" . $Document->getid() . "\">" . $Document->getfilename() . "</a></span><br/><span class=\"content\">" . $Document->getdescription() . "</span>"," ");
				$Row2 = array($Document->getdatemodified()->getnormaldate()," ");
				$Row3 = array($Document->display_filesize($Document->getfilesize())," ");
				$Row4 = array("<a  href=?did=". $Document->getid() ."&amp;dsid=" . $Document->getsection()->getid() . "&amp;aid=5><span class=\"glyphicon glyphicon-pencil\" alt = \"Edit Section\"></span></a>","button");		
				$Row5 = array("<a  onclick=\"confirmdialog('Delete Document " . $Document->getfilename() . "', '?did=" . $Document->getid() . "&amp;dsid=". $Section->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\" alt = \"Delete Folder\"></span></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("admindocumenttable",$Cols,$Rows);
        
        }
             
    	static public function addedit($DID,$DSID)
	    {
			$Filename = $_POST["filename"];
			$Description = $_POST["description"];
			$File = $_FILES["file"];
			$SendNotice = $_POST["sendnotice"];
			
			if(isset($_POST["sid"])){
				$SectionID = $_POST["sid"];
			} else {
				$SectionID = $DSID;
			}
			
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
			
			//$Group = 
			
			$DefaultError = array("defaulterror","A document with this name already exists in.");
			$DocumentNameError = array("documentnameerror","Please enter a Document Name");
			$DocumentError = array("documenterror","Please select a File.");
			$NoticeCategoryError = array("noticecategoryerror","Please select at least one Notice Category.");
	         
	        if($DID > 0){
	            //Edit
	            //print("<h2>Edit Document</h2>");

	        	if($Submit){
	                //Edit
	                 
					$Document = new Documents($DID);
					
					$Document->setsection(new Sections($SectionID));
					$Document->setfilename($Filename);
					$Document->setdescription($Description);
					
					if($File["tmp_name"] != ""){
					
						if(!Documents::exists($Filename,$SectionID)){
						
							$Document->setfilename($Filename);
							$Document->setdescription($Description);
							$Document->setdatemodified(new DateClass("","","","",""));
							$Document->setfilesize($File["size"]);
							$Document->setfiletype($File["type"]);
							
							//$fp = fopen($File["tmp_name"], 'r');
							//$content = fread($fp, filesize($File["tmp_name"]));
							//fclose($fp);
							
							//$Document->setfile(addslashes($content));
							
							$Document->save();
							
							//$name = FILELOC . "/" . $Document->getid() . "-" . $Document->getfilename();

							$name = FILELOC . "/" . $Document->getid();
							
							//echo($File["tmp_name"] . " " . $name);
							
							move_uploaded_file($File["tmp_name"], $name);
							
							Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,0);
							
							//$tmp_name = $File["tmp_name"];
	       					//$name = $Document->getsection()->geturl() . "/" . $Document->getid() . $File["name"];
	       					
	       					//move_uploaded_file($tmp_name, $name);
       					
       					}else{
       					
       						//File Doesnt Exist
							print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	               			$Errors = array($DocumentNameError);
        			
        					Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        				
		               		Documents::form($SectionID,$Filename,$Description,$DID,false);
       			
       					}		
						
					} else {
						$Document->save();
						
						Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,0);

					}
					
					print("<p class='lead'>The doucment has been edited succesfully.</p>");
					
					print("<p>Return to <a href='documents.php?sid=$SectionID'>Document Admin</a>.</p>");
					       
			     } else {
	                //Form
	                print("<p class='lead'>To Edit the Document complete the form below. Once you have completed it click the Edit Document button.</p>");
	                
	                $Errors = array($DocumentNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Document = new Documents($DID);
	                	                	             	
	                Documents::form($Document->getsection()->getid(),$Document->getfilename(),$Document->getdescription(),$Document->getid(),false);
	             }
        	 } else {
        	 //Add
	            //print("<h2>Add New Document</h2>");

	            if($Submit){
	                //Add
	                 
					if(!Documents::exists($Filename,$SectionID)){
						//File Doesnt Exists
						$Document = new Documents(0);
						
						$Document->setsection(new Sections($SectionID));
						$Document->setfilename($Filename);
						$Document->setdescription($Description);
						$Document->setdatemodified(new DateClass("","","","",""));
						$Document->setfilesize($File["size"]);
						$Document->setfiletype($File["type"]);
						$Document->savenew();
						
						//$name = "../private/" . $Document->getid() . "-" . $Document->getfilename();
						
						//$name = FILELOC . "\\" . $Document->getid() . "-" . $Document->getfilename();

						$name = FILELOC . "\\" . $Document->getid();
						
						//echo($File["tmp_name"] . " " . $name);
						
						move_uploaded_file($File["tmp_name"], $name);
						
						//$fp = fopen($File["tmp_name"], 'r');
						//$content = fread($fp, filesize($File["tmp_name"]));
						//fclose($fp);
						
						//$Document->setfile(addslashes($content));
						
						Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,1);
						
						//$tmp_name = $File["tmp_name"];
       					//$name = $Document->getsection()->geturl() . "/" . $Document->getid() . $File["name"];
						
						//move_uploaded_file($tmp_name, $name);
										
						print("<p class='lead'>The new section has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='documents.php?sid=$SectionID'>Sections Admin</a>.</p>");
					} else {
						//File Doesnt Exist
						print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	               		$Errors = array($DefaultErrors,$DocumentNameError,$DocumentError,$NoticeCategoryError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	               		Documents::form($SectionID,$Filename,$Description,$DID,true);
					}
				
				} else {
	                //Form
	                print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	                $Errors = array($DocumentNameError,$DocumentError,$NoticeCategoryError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	               	Documents::form($SectionID,$Filename,$Description,$DID,true);
	            }
        	}
	    }
	     
	    static private function generatenotice($SendNotice,$Document,$NoticeCategorys,$Add){
	    	if($SendNotice == 1){
	    	
		    	$NewNotice = new Notices(0);
		    	
		    	$User = new Users($_SESSION["userid"]);
		    	
		    	if ($Add){
		    		$AddEditStr = "added to";
		    	} else {
		    		$AddEditStr = "edited on";
		    	}
									
				$Notice .= "<p>A new document has been " . $AddEditStr . " the " . SHORTNAME . " website. Details are shown below.</p>";
				
				$Notice .= "<dl>";
				$Notice .= "<dt>Filename</dt><dd><a href=\"" . URL . "/downloads.php?did=" . $Document->getid() . "\">" . $Document->getfilename() . "</a></dd>";
				$Notice .= "<dt>Description</dt><dd>" . $Document->getdescription() . "</dd>";	
				$Notice .= "</dl>";
				
				$Notice .= "<p>You can download the file by clicking the filename and logging into the " . SHORTNAME . " website.</p>";
	
				$NewNotice->settitle("Document " . $Document->getfilename() . " added to " . SHORTNAME . " website.");
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
	     
    	static public function form($SectionID,$Filename,$Description,$DID,$Add)
        {
        	$NoticeCategoryArray = UserCategory::generatearray();
        
        	$SectionIDField = array("Section ID:","Hidden","sid",65,0,$SectionID,"","");
        	$FilenameField = array("Filename:","Text","filename",65,0,$Filename,"Enter a file name.","","");
        	$DescriptionField = array("Description:","TextArea","description",63,7,$Description,"Enter a file description.");
        	$FileField = array("File:","DynamicFile","file",43,0,"","","getuploadname()");
        	$SendNoticeField = array("Send Notice:","Checkbox","sendnotice",0,0,"",0,1,"shownoticecategorys(this)");
        	$NoticeCategoryField = array("Notice Category:","CheckboxArray","selectnoticecategory",0,0,"","",$NoticeCategoryArray);
        
			$Fields = array($FileField,$FilenameField,$DescriptionField,$SendNoticeField,$NoticeCategoryField,$SectionIDField);

            
			if($DID == -1){
				$Button = "Add Document";
  			} else {
				$Button = "Edit Document";
			}
			
			if(!$Add){
				$AddInfo = "&amp;aid=5";
			}
			
			Forms::generateform("documentsform","documents.php?did=" . $DID . "&amp;dsid=" . $SectionID . $AddInfo,"return checkdocumentform(this,$Add,2)",true,$Fields,$Button);
           
           $Section = new Sections($SectionID);
			
			print("<p>Return to the <a href=\"documents.php?sid=$SectionID\">" . $Section->getsection() . " Documents List</a></p>");

        }
	
        
	    function display_filesize($filesize)
	    {
			if(is_numeric($filesize)){
			    $decr = 1024; $step = 0;
			    $prefix = array('Byte','KB','MB','GB','TB','PB');
			       
			    while(($filesize / $decr) > 0.9){
			        $filesize = $filesize / $decr;
			        $step++;
			    }
		    	return round($filesize,2).' '.$prefix[$step];
		    } else {
		    	return $filesize;
			}
		}
   

        
        static public function exists($Filename, $Section)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE Filename = '" . $Filename . "' AND SectionIDLNK = " . $Section . " AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        	
        	if($RQ->getnumberofresults() > 0)
        	{
        		return true;
        	} else {
        		return false;
        	}
        }

        
		static public function deletedocument($DID){
        	$Document = new Documents($DID);
        	
        	$Document->setdeleted(1);
        	
        	$Document->save();
        } 
        
        static public function lastdocuments(){
        	$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE Deleted = 0 ORDER BY DateModified DESC LIMIT 0,5;");
        	
        	print("<ul>");
        	

        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		$Doc = new Documents($row["IDLNK"]);
        		
        		print("<li><a href=\"downloads.php?did=" . $Doc->getid() . "\">" . $Doc->getfilename() . "</a></li>");
        	}
        	
        	print("</ul>");
        }    
                       
    }

?>
