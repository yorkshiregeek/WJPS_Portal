<?php

    class Documents
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Section;
        var $c_Filename;
        var $c_URL;
        var $c_Description;
        var $c_DateModified;
        var $c_FileType;
        var $c_File;
        var $c_Deleted;

        var $c_Tags;

        var $c_AccessCategorys;
        
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

        function seturl($Val){
        	$this->c_URL = $Val;
        }

        function geturl(){
        	return $this->c_URL;
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

        function settags($Val)
        {
        	$this->c_Tags = $Val;
        }

        function gettags()
        {
        	return $this->c_Tags;
        }

        function getaccesscategorys()
        {
            $RQ = new ReadQuery("SELECT UserCategoryIDLNK FROM DocumentUserCategorys WHERE DocumentIDLNK = " . $this->getid() . ";");
          
            //echo($RQ->getquery());

            $Counter = 0;
            
            //$Cats = new array;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                $CatArray[$Counter] = $row["UserCategoryIDLNK"];
                
                $Counter ++;
            }
            
            return $CatArray;
        }

        function gettablelink()
        {

            if($this->getfiletype() == 'upload'){
                $Type = " <span class='glyphicon glyphicon-paperclip' data-toggle='tooltip' title='This is a file download, click the title to download it.'></span>";
                $URL = "<a href=\"" . $this->geturl() .  "\" target='_blank'>" . $this->getfilename() . "</a>";

                ///$Type = "File Upload";
            } else {
                $Type = " <span class='glyphicon glyphicon-link' data-toggle='tooltip' title='This is a url, click the title to view the  url.'></span>";
                $URL = "<a href=\"" . $this->geturl() .  "\" target='_blank'>" . $this->getfilename() . "</a>";

            }

            return "<span class=\"title\">" . $URL . " </span> " . $Type . " <span class='badge' data-toggle='tooltip' title='This document was updated on " . $this->getdatemodified()->getnormaldate() . "'>". $this->getdatemodified()->getnormaldate() . "</span><br/><span class=\"content\">" . $this->getdescription() . "</span>"; 
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
                $this->c_URL = $row["URL"];
                $this->c_Description = $row["Description"];
                $this->c_DateModified = new DateClass("",$row["DateModified"],"","","");
                $this->c_FileSize = $row["FileSize"];
                $this->c_FileType = $row["FileType"];
                $this->c_File = stripslashes($row["File"]);
                $this->c_Deleted = $row["Deleted"];


                $RQ1 = new ReadQuery("SELECT Title FROM DocumentTags JOIN Tags On DocumentTags.TagIDLNK = Tags.IDLNK WHERE DocumentIDLNK = " . $ID . ";");

            	//echo($RQ1->getquery());

                while($row = $RQ1->getresults()->fetch_array(MYSQLI_BOTH)) {
                	$this->c_Tags .= ", " . $row["Title"]; 
                }

            	if(strlen($this->c_Tags)>2)
            	{
            		$this->c_Tags = substr($this->c_Tags,1);
            	}

            	//echo($this->c_Tags);

            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$DM = $this->getdatemodified();

        	$WQ = new WriteQuery("INSERT INTO Documents (SectionIDLNK, Filename, URL,  Description, DateModified, Filesize, FileType, Deleted) VALUES (" . $this->getsection()->getid() . ", '" . $this->getfilename() ."', '" . $this->geturl() . "', '" . $this->getdescription() . "','" . $DM->getdatabasedate() . "'," . $this->getfilesize() . ",'" . $this->getfiletype() . "', 0)");
            $this->c_ID = $WQ->getinsertid();
            $this->savetags($this->c_ID);

        }
        
        function save()
        {
        	$DM = $this->getdatemodified();
        	$WQ = new WriteQuery("UPDATE Documents SET SectionIDLNK = " . $this->getsection()->getid() . ", Filename = '" . $this->getfilename() . "', URL = '" . $this->geturl() . "', Description = '" . $this->getdescription() . "', DateModified = '" . $DM->getdatabasedate() . "', Filesize = " . $this->getfilesize() . ", FileType = '" . $this->getfiletype() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			$this->savetags($this->c_ID);
        }

        function savetags($ID)
        {
        	$WQ0 = new WriteQuery("DELETE FROM DocumentTags WHERE DocumentIDLNK = $ID");

        	$tags = explode(",", $this->c_Tags);

        	foreach ($tags as $key) {

        		$Tag = new Tags(0,$key);
        		
        		$Tag->save();

        		$WQ = new WriteQuery("INSERT INTO DocumentTags (DocumentIDLNK,TagIDLNK) VALUES (" . $ID . "," . $Tag->getid() . ")");
        		//echo($WQ->getquery());
        	}

        }
        
        static public function listall($SID)
        {
     		//Normal
			print("<div class=row>");

        	print("<div class='col-md-12'>");
     		
     		$Section = new Sections($SID);


     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Groups</a></li>");
     			print("<li> <a href=\"documents.php?gid=" . $Section->getgroup()->getid() . "\">" . $Section->getgroup()->getgroup() . "</a></li>");
     			print("<li class='active'>" . $Section->getsection() . "</li>");
     		print("</ol>");

     		print("</div>");

     		print("<div class='col-md-9'>");
				
			print("<p class='lead'>The list below shows all the documents in <strong>" . $Section->getsection() . "</strong> section.");
				
			print("</div>");

			Documents::	documentsearchbox($Term);

			print("</div>");
			print("<div class='row'>");
			print("<div class='col-md-12'>");

			$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 ORDER BY Filename");
			
			$Col1 = array("Document","sectionname",1);
			$Col2 = array("Date Modified","documents",1);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){

				$Document = new Documents($row["IDLNK"]);

				$Section = $Document->getsection();
				$Row1 = array($Document->gettablelink()," ");
				$Row2 = array($Document->getdatemodified()->getnormaldate()," ");

				$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("documenttable",$Cols,$Rows);

			print("</div>");
			print("</div>");
        
        }

        
        static public function listadmin($SID)
        {
     		//Normal

     		print("<div class=row>");

        	print("<div class='col-md-12'>");
     		
     		$Section = new Sections($SID);

     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Groups</a></li>");
     			print("<li> <a href=\"documents.php?gid=" . $Section->getgroup()->getid() . "\">" . $Section->getgroup()->getgroup() . "</a></li>");
     			print("<li class='active'>" . $Section->getsection() . "</li>");
     		print("</ol>");

     		print("</div>");

     		print("</div>");

            print("<div class=row>");

     		print("<div class='col-md-9'>");
     			
				print("<p class='lead'>The list below shows all the documents in <strong>" . $Section->getsection() . "</strong> section.");
						
				print("<p><a href='documents.php?did=-1&amp;dsid=" . $SID . "'><span class=\"glyphicon glyphicon-plus\" alt= \"Add New Document\" ></span>Add New Document</a></p>");
				
			print("</div>");

			//$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 ORDER BY Filename");
			
			Documents::	documentsearchbox($Term);

			print("</div>");
			print("<div class='row'>");
			print("<div class='col-md-12'>");

			if($_SESSION["isadmin"] == true){

                $RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 ORDER BY Filename");
			

            } else {

                $RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE SectionIDLNK = " . $Section->getid() . " AND Deleted = 0 AND IDLNK IN (SELECT DocumentIDLNK FROM DocumentUserCategorys WHERE UserCategoryIDLNK IN (SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $_SESSION["userid"] . ")) ORDER BY Filename;");
            }

			//echo($RQ->getquery());
			
			$Col1 = array("Document","sectionname",1);
			$Col2 = array("","operations", 2);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;

            //if($RQ->getnumberofresults > 0){
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Document = new Documents($row["IDLNK"]);

				$Section = $Document->getsection();
				$Row1 = array($Document->gettablelink()," "); 
				$Row2 = array("<a  href=?did=". $Document->getid() ."&amp;dsid=" . $Document->getsection()->getid() . "&amp;aid=5><span class=\"glyphicon glyphicon-pencil\" alt = \"Edit Section\"></span></a>","button");		
				$Row3 = array("<a  onclick=\"confirmdialog('Delete Document " . $Document->getfilename() . "', '?did=" . $Document->getid() . "&amp;dsid=". $Section->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\" alt = \"Delete Folder\"></span></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("admindocumenttable",$Cols,$Rows);

			print("</div>");
			print("</div>");

		//} else {

		//	print("<p class='error'>No Documents to show</p>");
		//}
        
        }

        static public function searchadmin($Term)
        {
     		//Normal
        	print("<div class=row>");

        	print("<div class='col-md-12'>");

     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Search</a></li>");
     			print("<li class='active'><a href=\"documents.php\">$Term</a></li>");
     		print("</ol>");

     		print("</div>");

     		print("</div>");

            print("<div class=row>");

     		print("<div class='col-md-9'>");
     			
				print("<p class='lead'>The list below shows all documents selected using the search term <strong>" . $Term . "</strong>.");
						
			print("</div>");

			Documents::	documentsearchbox($Term);

			print("</div>");
			print("<div class='row'>");
			print("<div class='col-md-12'>");
			
			$Terms = explode(" ",$Term);

			$TermString = "";

			//echo($Terms);

			foreach ($Terms as &$t) {
				$TermString = $TermString . "|" . $t;
			}

			$TermString = substr($TermString,1);

			if($_SESSION["isadmin"] == true){

				//Select where in name


                 $RQ = new ReadQuery("SELECT IDLNK AS DocID, Filename, (SELECT COUNT(*) FROM Documents WHERE IDLNK = DocID AND FileName REGEXP '$TermString') AS WordCount, (SELECT COUNT(*) FROM DocumentTags JOIN Tags on Tags.IDLNK = DocumentTags.TagIDLNK WHERE Tags.Title REGEXP '$TermString' AND DocumentTags.DocumentIDLNK = DocID) AS TagCount, (SELECT WordCount + TagCount) As TotalCount FROM Documents WHERE Deleted = 0 ORDER BY TotalCount DESC, WordCount DESC, TagCount DESC");

            } else {

                $RQ = new ReadQuery("SELECT IDLNK AS DocID, Filename, (SELECT COUNT(*) FROM Documents WHERE IDLNK = DocID AND FileName REGEXP '$TermString') AS WordCount, (SELECT COUNT(*) FROM DocumentTags JOIN Tags on Tags.IDLNK = DocumentTags.TagIDLNK WHERE Tags.Title REGEXP '$TermString' AND DocumentTags.DocumentIDLNK = DocID) AS TagCount, (SELECT WordCount + TagCount) As TotalCount FROM Documents WHERE Deleted = 0 ORDER BY TotalCount DESC, WordCount DESC, TagCount DESC");

            }

			//echo($RQ->getquery());
			
			$Col1 = array("Document","sectionname",1);
            $Cols = array($Col1);
            $Rows = array();
            $RowCounter = 0;

            //if($RQ->getnumberofresults > 0){
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){

				if ($row["WordCount"] != 0 xor $row["TagCount"] != 0) {

					//echo($row["TagCount"]);
					
					$Document = new Documents($row["DocID"]);

					$Section = $Document->getsection();

					$Row1 = array($Document->gettablelink()," ");
					
					$Rows[$RowCounter] = array($Row1);
	                $RowCounter ++;

				}
			}
			
			Tables::generateadmintable("admindocumenttable",$Cols,$Rows);
print("</div>");
			print("</div>");

		//} else {

		//	print("<p class='error'>No Documents to show</p>");
		//}
        
        }




    	static public function addedit($DID,$DSID)
	    {

			$Section = new Sections($DSID);

     		print("<ol class='breadcrumb'>");
     			print("<li><a href=\"documents.php\">Groups</a></li>");
     			print("<li> <a href=\"documents.php?gid=" . $Section->getgroup()->getid() . "\">" . $Section->getgroup()->getgroup() . "</a></li>");
     			print("<li class='active'>" . $Section->getsection() . "</li>");
     		print("</ol>");

			$Filename = $_POST["filename"];
			$Description = $_POST["description"];
			$File = $_POST["fileurl"];
			$URL = $_POST["fileuploadurl"];
			$Tags = $_POST["tags"];
			$SendNotice = $_POST["sendnotice"];

			//Get Number of Categorys
            $NofC = UserCategory::gettotalbysection($DSID);
            
            //$UserCategorys = new array();
            
            for($c=1;$c<=$NofC;$c++)
            {
                if(isset($_POST["accesscategory" . $c])){
                    $AccessCategorys[$c-1] = $_POST["accesscategory" . $c];
                }
            }
			
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
			
			$DefaultError = array("defaulterror","A document with this name already exists.");
			$DocumentNameError = array("documentnameerror","Please enter a Document Name");
			$DocumentError = array("documenterror","Please select a File.");
			$NoticeCategoryError = array("noticecategoryerror","Please select at least one Notice Category.");
	         
	        if($DID > 0){
	            //Edit
	        	if($Submit){
	                //Edit
	                 
					$Document = new Documents($DID);
					
					$Document->setsection(new Sections($SectionID));
					$Document->setfilename($Filename);
					$Document->setdescription($Description);
					
					if($URL != ""){


					
						if(!Documents::exists($Filename,$SectionID,$DID)){
						
							$Document->setfilename($Filename);
							$Document->setdescription($Description);
							$Document->setdatemodified(new DateClass("","","","",""));

							if($File != ''){
								$Document->seturl($File);
								$Document->setfiletype('upload');
							} else if($URL != '') {
								$Document->seturl($URL);
								$Document->setfiletype('url');
							}

							Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,0);

							$Document->save();

							$WQ = new WriteQuery("DELETE FROM DocumentUserCategorys WHERE DocumentIDLNK = " . $Document->getid() . ";");
							//echo($WQ->getquery());

                            if($AccessCategorys != ""){

    		                    foreach($AccessCategorys as $AC)
    		                    {
    		                        $WQ = new WriteQuery("INSERT INTO DocumentUserCategorys (DocumentIDLNK, UserCategoryIDLNK) VALUES (" . $Document->getid() . ", " . $AC . ");");
    		                    	echo($WQ->getquery());
    		                    }

                            }
						
						//Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,0);

						print("<p class='lead'>The document has been edited succesfully.</p>");
						
						print("<p>Return to <a href='documents.php?sid=$SectionID'>Document Admin</a>.</p>");
							
       					
       					}else{
       					
       						//File Doesnt Exist
							print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	               			$Errors = array($DocumentNameError);
        			
        					Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        				
		               		Documents::form($SectionID,$URL,$Type,$Filename,$Description,$Tags,$AccessCategorys,$DID,false);
       			
       					}		
						
					} else {
						print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	               			$Errors = array($DocumentNameError,$DefaultError);
        			
        					Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        				
		               		Documents::form($SectionID,$URL,$Type,$Filename,$Description,$Tags,$AccessCategorys,$DID,false);

					}
					       
			     } else {
	                //Form
	                print("<p class='lead'>To Edit the Document complete the form below. Once you have completed it click the Edit Document button.</p>");
	                
	                $Errors = array($DocumentNameError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Document = new Documents($DID);
	                	                	             	
	                Documents::form($Document->getsection()->getid(),$Document->geturl(),$Document->getfiletype(),$Document->getfilename(),$Document->getdescription(),$Document->gettags(),$Document->getaccesscategorys(),$Document->getid(),false);
	             }
        	 } else {
        	 //Add
	            //print("<h2>Add New Document</h2>");

	            if($Submit){
	                //Add
	                 
					if(!Documents::exists($Filename,$SectionID,0)){
						//File Doesnt Exists
						$Document = new Documents(0);
						
						$Document->setsection(new Sections($SectionID));
						$Document->setfilename($Filename);
						$Document->setdescription($Description);
						$Document->setdatemodified(new DateClass("","","","",""));
						$Document->setfilesize(0);

						$Document->settags($Tags);

						if($File != ''){
							$Document->seturl($File);
							$Document->setfiletype('upload');
						} else if($URL != '') {
							$Document->seturl($URL);
							$Document->setfiletype('url');
						}

						$Document->savenew();

						foreach($AccessCategorys as $AC)
                        {
                            $WQ = new WriteQuery("INSERT INTO DocumentUserCategorys (DocumentIDLNK, UserCategoryIDLNK) VALUES (" . $Document->getid() . ", " . $AC . ");");
                        }

						Documents::generatenotice($SendNotice,$Document,$NoticeCategorys,1);
						
						//$tmp_name = $File["tmp_name"];
       					//$name = $Document->getsection()->geturl() . "/" . $Document->getid() . $File["name"];
						
						//move_uploaded_file($tmp_name, $name);
										
						print("<p class='lead'>The new document has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='documents.php?sid=$SectionID'>Sections Admin</a>.</p>");
					} else {
						//File Doesnt Exist
						print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	               		$Errors = array($DefaultErrors,$DocumentNameError,$DocumentError,$NoticeCategoryError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	               		Documents::form($SectionID,$URL,$Type,$Filename,$Description,$Tags,$AccessCategorys,$DID,true);
					}
				
				} else {
	                //Form
	                print("<p class='lead'>To Add a New Document complete the form below. Once you have completed it click the Add Document button.</p>");
	                
	                $Errors = array($DocumentNameError,$DocumentError,$NoticeCategoryError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	               	Documents::form($SectionID,$URL,$Type,$Filename,$Description,$Tags,$AccessCategorys,$DID,true);
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
	     
    	static public function form($SectionID,$URL,$Type,$Filename,$Description,$Tags,$AccessCategorys,$DID,$Add)
        {
        	$NoticeCategoryArray = UserCategory::generatearray();


        	$AccessCategoryArray = UserCategory::generatearraybysection($SectionID);
        

        	$SectionIDField = array("Section ID:","Hidden","sid",65,0,$SectionID,"","");
        	$FilenameField = array("Document Title:","Text","filename",65,0,$Filename,"Enter a file name.","","");
        	$DescriptionField = array("Description:","TextArea","description",63,7,$Description,"Enter a file description.");
        	$FileField = array("Document:","FileURL","file",43,0,$URL,"","getuploadname()");
        	$TagField = array("Tags:","Tag","tags",65,0,$Tags,"Enter tags for this document."."","");
    		$AccessGroups = array("Access Groups:","CheckboxArrayCollapse","accesscategory",65,0,$AccessCategorys,"",$AccessCategoryArray);

        	$SendNoticeField = array("Send Notice:","Checkbox","sendnotice",0,0,"",0,1,"shownoticecategorys(this)");
        	$NoticeCategoryField = array("Notice Category:","CheckboxArray","selectnoticecategory",0,0,"","",$NoticeCategoryArray);
        
			$Fields = array($FileField,$FilenameField,$DescriptionField,$TagField,$AccessGroups,$SectionIDField);

            
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

           echo($Type);

           if($Type == 'url'){
            print("<script type='text/javascript'> $('#fileuploadtabs a:last').tab('show') </script>");
            }

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
   

        
        static public function exists($Filename, $Section,$ID)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE Filename = '" . $Filename . "' AND SectionIDLNK = " . $Section . " AND Deleted = 0 AND IDLNK != " . $ID . ";");
        	
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

        static public function lastdocumentscount($LastDate){
             $RQ = new ReadQuery("SELECT COUNT(IDLNK) FROM Documents WHERE Deleted = 0 AND DateModified >= '$LastDate' ORDER BY DateModified DESC;");

             return $RQ->getresults()->fetch_array(MYSQLI_BOTH)[0][0];

             //return $row;

        }
        
        static public function lastdocuments($LastDate){
        	
            $RQ = new ReadQuery("SELECT IDLNK FROM Documents WHERE Deleted = 0 AND DateModified >= '$LastDate' ORDER BY DateModified DESC;");

            //echo($RQ->getquery());

            $Col1 = array("Document","sectionname",1);
            $Col2 = array("Date Modified","documents",1);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){

                $Document = new Documents($row["IDLNK"]);

                if($Document->getfiletype() == 'upload'){
                    $Type = "File Upload";
                } else {
                    $Type = "URL";
                }

                $Section = $Document->getsection();
                $Row1 = array("<span class=\"title\"><a href=\"downloads.php?did=" . $Document->getid() . "\">" . $Document->getfilename() . "</a></span> <span class='label label-default'>" . $Type . "</span><br/><span class=\"content\">" . $Document->getdescription() . "</span>"," ");
                $Row2 = array($Document->getdatemodified()->getnormaldate()," ");
                
                $Rows[$RowCounter] = array($Row1,$Row2);
                $RowCounter ++;
            }

            Tables::generateadmintable("latestdocumenttable",$Cols,$Rows);


        	
            
        }  

        static public function documentsearchbox($Term)
        {

        	?>
        	
        	<div class='col-md-3'>
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Search</h3>
				  </div>
				  <div class="panel-body">
				  	<form role="form" acion="documents.php" method="get">
				    <div class="input-group">
				      <input type="text" class="form-control" id='search' name='search' value = '<? echo($Term); ?>'/>
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="submit">Go!</button>
				      </span>
				    </div><!-- /input-group -->
				   	</form>
				  </div>
				</div>
			</div>

			<?
        }  
                       
    }

?>
