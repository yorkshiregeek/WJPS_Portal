<?php

    class Links
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
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
                $RQ = new ReadQuery("SELECT * FROM Links WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_URL = $row["URL"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$WQ = new WriteQuery("INSERT INTO Links (Title,URL, Deleted) VALUES ('" . $this->gettitle() . "', '" . $this->geturl() ."', 0)");
        	//echo($WQ->getquery());
            $this->c_ID -> insert_id;
        }
        
        function save()
        {
        	$WQ = new WriteQuery("UPDATE Links SET Title = '" . $this->gettitle() . "', URL = '" . $this->geturl() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall()
        {
     		//Normal
     		
     		print("<p>The list below shows all the links in the system.</p>");
     		
     		print("<p><a href='linkm.php?lid=-1'><span class=\"glyphicon glyphicon-plus\" alt = \"Add New Link\"></span> Add New Link</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Links WHERE Deleted = 0 ORDER BY Title");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Title","sectionname",1);
			$Col2 = array("URL","documents",1);
			$Col3 = array("","operations",2);
            $Cols = array($Col1,$Col2,$Col3);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Link = new Links($row["IDLNK"]);
				$Row1 = array($Link->gettitle()," ");
				$Row2 = array($Link->geturl()," ");
				$Row3 = array("<a href=\"?lid=". $Link->getid() ."\"><span class=\"glyphicon glyphicon-pencil\" alt = \"Edit Section\"></span></a>","button");
				$Row4 = array("<a onclick=\"confirmdialog('Delete Link " . $Link->gettitle() . "', '?lid=". $Link->getid() ."&amp;aid=10');\"><span class=\"glyphicon glyphicon-trash\" alt = \"Delete Link\"></span></a>","button");
				//$Row4 = array("<a href=\"?lid=". $Link->getid() ."&amp;aid=10\"><img src=\"Images/link_delete.png\" alt=\"Delete Link\"/></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("linkstable",$Cols,$Rows);
        
        }
                
        static public function showall()
        {


        	print("<h2>Links</h2>");
        
        	print("<p>Some useful links to other websites are given below. Please let us know (using the contact form) if you experience problems with any of these, or if there are any other links you would like including on this site.</p>");

        	$RQ = new ReadQuery("SELECT IDLNK FROM Links WHERE Deleted = 0 ORDER BY Title");
        	
        	print("<ul>");
        	
        	$Col = 1;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
        	
        		$Link = new Links($row["IDLNK"]);
   
        		print("<li><a href=\"" . $Link->geturl() . "\" target=\"_blank\">" . $Link->gettitle() . "</a></li>");
				
        	}
        	
        	print("</ul>");
        	
        }
        
        static public function addedit($LID)
	    {
			$Title = $_POST["title"];
			$URL = $_POST["url"];
		
			$Submit = $_POST["submit"];
			
			$DefaultError = array("defaulterror","Please the URL in the format http://www.domain.com");
			
			$TitleError = array("titleerror","Please enter a Link Title");
			$URLError = array("urlerror","Please enter a URL");
	         
	        if($LID > 0){
	            //Edit
	            print("<h2>Edit Link</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewLink = new Links($LID);
					
					$NewLink->settitle($Title);
					$NewLink->seturl($URL);
					
					if((substr($URL,0,11) == "http://www.") || (substr($URL,0,12) == "https://www.")){
					
						$NewLink->save();
					
						print("<p>The link has been succesfully edited.</p>");
					
						print("<p>Return to <a href='linkm.php'>Links Admin</a>.</p>");
					
					} else {
						print("<p>To Edit the Link complete the form below. Once you have completed it click the Add Link button.</p>");
	                
	                	$Errors = array($TitleError,$URLError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	                	Links::form($Title,$URL,$LID,false);
					}
						       
			     } else {
	                //Form
	                print("<p>To Edit the Link complete the form below. Once you have completed it click the Edit Link button.</p>");
	                
	                $Errors = array($DefaultError,$TitleError,$URLError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Link = new Links($LID);
	                	             	
	                Links::form($Link->gettitle(),$Link->geturl(),$LID,false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Link</h2>");

	            if($Submit){
	                //Add
	                 
					$NewLink = new Links(0);
					
					$NewLink->settitle($Title);
					$NewLink->seturl($URL);
					
					if((substr($URL,0,11) == "http://www.") || (substr($URL,0,12) == "https://www.")){
					
						$NewLink->savenew();								
					
						print("<p>The new link has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='linkm.php'>Links Admin</a>.</p>");
					
					} else {
					
						print("<p>To Add a New Link complete the form below. Once you have completed it click the Add Link button.</p>");
	                
	                	$Errors = array($DefaultError,$TitleError,$URLError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
        			
	                	Links::form($Title,$URL,$LID,true);
					
					}
				
				} else {
	                //Form
	                print("<p>To Add a New Link complete the form below. Once you have completed it click the Add Link button.</p>");
	                
	                $Errors = array($TitleError,$URLError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Links::form($Title,$URL,$LID,true);
	             }
        	 }
	     }
	     
    	static public function form($Title,$URL,$LID,$Add)
        {
        	$TitleField = array("Link Title:","Text","title",65,0,$Title,"","",!$Add);
        	$URLField = array("URL:","Text","url",50,0,$URL);
        	
        	$Fields = array($TitleField,$URLField);

            
			if($LID == -1){
				$Button = "Add Link";
            	Forms::generateform("linksform","linkm.php?lid=$LID","return checklinkform(this)",true,$Fields,$Button);
			} else {
				$Button = "Edit Link";
				Forms::generateform("linksform","linkm.php?lid=$LID","return checklinkform(this)",true,$Fields,$Button);
			}
           
        }
        
		static public function deletelink($LID){
        	$Link = new Links($LID);
        	
        	$Link->setdeleted(1);
        	
        	$Link->save();
        }     

       
    }

?>