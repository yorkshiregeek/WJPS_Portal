<?php

    class Trusts
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Trust;
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
        
        function getsites()
        {
        	$RQ = new ReadQuery("SELECT IDLNK From Sites WHERE TrustIDLNK = " . $this->getid() . " AND Deleted = 0");
        	
        	return $RQ->getnumberofresults();
        }
        
        function getcontacts()
        {
        	$RQ = new ReadQuery("SELECT ContactIDLNK From Contacts WHERE TrustIDLNK = " . $this->getid() . " AND Deleted = 0");
        	
        	return $RQ->getnumberofresults();
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
                $RQ = new ReadQuery("SELECT * FROM Trusts WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Trust = $row["Trust"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$WQ = new WriteQuery("INSERT INTO Trusts (Trust,Deleted) VALUES ('" . $this->gettrust() . "', 0)");
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
        	$WQ = new WriteQuery("UPDATE Trusts SET Trust = '" . $this->gettrust() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall()
        {
     		//Normal
     		
     		print("<p>The list below shows all the trusts in the system.</p>");
     		
     		print("<p><a href='directory.php?tid=-1'><span class=\"glyphicon glyphicon-plus\"></span> Add New Trust</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Trusts WHERE Deleted = 0 ORDER BY Trust");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Trust","trustname",1);
			$Col2 = array("Number of Sites","sites",1);
			$Col3 = array("Number of Contacts","contacts",1);
			$Col4 = array("","operations",2);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				$Trust = new Trusts($row["IDLNK"]);
				$Row1 = array("<a href=\"?stid=" . $Trust->getid() . "\">" . $Trust->gettrust() . "</a>"," ");
				$Row2 = array($Trust->getsites(),"middle");
				$Row3 = array($Trust->getcontacts(),"middle");
				$Row4 = array("<a href=\"?tid=". $Trust->getid() ."\"><span class=\"glyphicon glyphicon-pencil\" alt =\"Edit\" ></span></a>","button");
				$Row5 = array("<a onclick=\"confirmdialog('Delete Trust " . $Trust->gettrust() . "', '?tid=". $Trust->getid() ."&amp;aid=10');\"><span alt =\"Edit\" class=\"glyphicon glyphicon-trash\"></span></a>");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("truststable",$Cols,$Rows);
        
        }
                
        static public function showall()
        {
        	//Output Trust
        	
        	//Normal
        		
    		print("<p>The list below shows all the trusts in the system.</p>");
        		
        	$RQ = new ReadQuery("SELECT IDLNK FROM Trusts WHERE Deleted = 0 ORDER BY Trust");
        	
        	//echo($RQ->getquery());
        	
        	$Col1 = array("Trust","trustname",1);
        	$Col2 = array("Number of Sites","sites",1);
        	$Col3 = array("Number of Contacts","contacts",1);
        	$Cols = array($Col1,$Col2,$Col3);
        	$Rows = array();
        	$RowCounter = 0;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
        		$Trust = new Trusts($row["IDLNK"]);
        		$Row1 = array("<a href=\"?tid=" . $Trust->getid() . "\">" . $Trust->gettrust() . "</a>"," ");
        		$Row2 = array($Trust->getsites(),"middle");
        		$Row3 = array($Trust->getcontacts(),"middle");
        		
        		$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
        	    $RowCounter ++;
        	}
        	
        	Tables::generateadmintable("truststable",$Cols,$Rows);
       	}
        
        static public function addedit($TID)
	    {
			$Trust = $_POST["trust"];
			$Submit = $_POST["submit"];
			
			//echo("Hello " . $Submit);
			
			$DefaultError = array("defaulterror","A trust with this name already exists.");
			$TrustError = array("trusterror","Please enter a trust name.");
			
	        if($TID > 0){
	            //Edit
	            print("<h2>Edit Trust</h2>");

	        	if($Submit){
	                //Edit
	                 
	                if(!Trusts::exists($Trust)){
						$NewTrust = new Trusts($TID);
						
						$NewTrust->settrust($Trust);
														
						$NewTrust->save();			
											
						print("<p>The Trust has been succesfully edited.</p>");
						
						print("<p>Return to <a href='directory.php'>Directory Admin</a>.</p>");
					} else {
						print("<p>To Edit the Trust complete the form below. Once you have completed it click the Edit Trust button.</p>");
	                
		                $Errors = array($DefaultError,$TrustError);
	        			
	        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
		                
		                $Trust = new Trusts($TID);
		                	             	
		                Trusts::form($Trust->gettrust(),$TID,true);
					}				       
			     } else {
	                //Form
	                print("<p>To Edit the Trust complete the form below. Once you have completed it click the Edit Trust button.</p>");
	                
	                $Errors = array($TrustError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Trust = new Trusts($TID);
	                	             	
	                Trusts::form($Trust->gettrust(),$TID,true);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Trust</h2>");
	            
	            //printr($_POST);
	            
	            print($_POST[0][0]);

	            if($Submit){
	                //Add
	                
	                if(!Trusts::exists($Trust)){
	                 
						$NewTrust = new Trusts(0);
						
						$NewTrust->settrust($Trust);
															
						$NewTrust->savenew();	
						
						print("<p>The new Trust has been added to the system succesfully.</p>");
					
						print("<p>Return to <a href='directory.php'>Directory Admin</a>.</p>");
					
					} else {
						print("<p>To Add a New Trust complete the form below. Once you have completed it click the Add Trust button.</p>");
	                
	                	$Errors = array($DefaultError,$TrustError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                	Trusts::form($Trust,$TID,true);
					}
			
				} else {
	                //Form
	                print("<p>To Add a New Trust complete the form below. Once you have completed it click the Add Trust button.</p>");
	                
	                $Errors = array($TrustError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Trusts::form($Trust,$TID,true);
	             }
        	 }
	    }
	     
    	static public function form($Trust,$TID,$Add)
        {
        	$TrustField = array("Trust name:","Text","trust",65,0,$Trust,"","",!$Add);
        
        	$Fields = array($TrustField);
            
			if($TID == -1){
				$Button = "Add Trust";
            	Forms::generateform("trustform","directory.php?tid=$TID","return checktrustsform(this)",false,$Fields,$Button);
			} else {
				$Button = "Edit Trust";
				Forms::generateform("trustform","directory.php?tid=$TID","return checktrustsform(this)",false,$Fields,$Button);
			}
           
        }
        
		static public function deletetrust($TID){
        	$Trust = new Trusts($TID);
        	
        	$Trust->setdeleted(1);
        	
        	$Trust->save();
        }     
        
        static public function exists($Trust)
        {
        	$RQ = new ReadQuery("SELECT * FROM Trusts WHERE Trust = '" . $Trust . "';");
			if($RQ->getnumberofresults() > 0){
				return true;
			} else {
				return false;
			}             
        }

    }

?>