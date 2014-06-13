<?php

    class Sites
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Trust;
        var $c_Name;
        var $c_AddressLine1;
        var $c_AddressLine2;
        var $c_Town;
        var $c_Postcode;
        var $c_Telephone;
        var $c_Fax;
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
        
        function setname($Val)
        {
        	$this->c_Name = $Val;
        }
        
        function getname(){
        	return $this->c_Name;
        }
        
        function getaddress(){
        	if($this->getaddressline2() != ""){
        		$Addres2 = $this->getaddressline2() . "<br/>";
        	}
        
        	return $this->getname() . "<br/>" . $this->getaddressline1() . "<br/>" . $Address2 . $this->gettown() . "<br/>" . $this->getpostcode();
        }
        
        function setaddressline1($Val)
        {
        	$this->c_AddressLine1 = $Val;
        }
        
        function getaddressline1(){
        	return $this->c_AddressLine1;
        }
        
        function setaddressline2($Val)
        {
        	$this->c_AddressLine2 = $Val;
        }
        
        function getaddressline2(){
        	return $this->c_AddressLine2;
        }
        
        function settown($Val)
        {
        	$this->c_Town = $Val;
        }
        
        function gettown(){
        	return $this->c_Town;
        }
        
        function setpostcode($Val)
        {
        	$this->c_Postcode = $Val;
        }
        
        function getpostcode(){
        	return $this->c_Postcode;
        }
        
        function settelephone($Val)
        {
        	$this->c_Telephone = $Val;
        }
        
        function gettelephone(){
        	return $this->c_Telephone;
        }
        
        function setfax($Val)
        {
        	$this->c_Fax = $Val;
        }
        
        function getfax(){
        	return $this->c_Fax;
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
                $RQ = new ReadQuery("SELECT * FROM Sites WHERE IDLNK = " . $ID . ";");
                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Trust = new Trusts($row["TrustIDLNK"]);
                $this->c_Name = $row["Name"];
                $this->c_AddressLine1 = $row["AddressLine1"];
                $this->c_AddressLine2 = $row["AddressLine2"];
                $this->c_Town = $row["Town"];
                $this->c_Postcode = $row["Postcode"];
                $this->c_Telephone = $row["Telephone"];
                $this->c_Fax = $row["Fax"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$Trust = $this->gettrust();
        	$WQ = new WriteQuery("INSERT INTO Sites (TrustIDLNK,Name,AddressLine1,AddressLine2,Town,Postcode,Telephone,Fax,Deleted) VALUES (" . $Trust->getid() . ",'" . $this->getname() . "','" . $this->getaddressline1() . "','" . $this->getaddressline2() . "', '" . $this->gettown() . "','" . $this->getpostcode() . "','" . $this->gettelephone() . "','" . $this->getfax() . "', 0)");
            $this->c_ID -> insert_id;
        }
        
        function save()
        {
        	$Trust = $this->gettrust();
        	$WQ = new WriteQuery("UPDATE Sites SET TrustIDLNK = " . $Trust->getid() . ", Name = '" . $this->getname() . "', AddressLine1 = '" . $this->getaddressline1() . "', AddressLine2 = '" . $this->getaddressline2() . "', Town = '" . $this->gettown() . "', Postcode = '" . $this->getpostcode() . "', Telephone = '" . $this->gettelephone() . "', Fax = '" . $this->getfax() .  "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
       
        static public function listall($TID)
        {
     		//Normal
     		
     		$Trust = new Trusts($TID);
     		
     		print("<p>The list below shows all the sites that are part of " . $Trust->gettrust() . ".</p>");
     		
     		print("<p><a href='directory.php?mid=0&amp;sid=-1&amp;stid=" . $TID . "'><img src=\"Images/building_add.png\" alt=\"Add New Site\"/>Add New Site</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Sites WHERE TrustIDLNK = " . $Trust->getid() . " AND Deleted = 0 ORDER BY Name");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Site","sitename",1);
			$Col2 = array("Phone","phone",1);
			$Col3 = array("Fax","phone",1);
			$Col4 = array("","operations",2);
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$Site = new Sites($row["IDLNK"]);
				$Row1 = array($Site->getname()," ");
				$Row2 = array($Site->gettelephone()," ");
				$Row3 = array($Site->getfax()," ");
				$Row4 = array("<a href=\"?mid=0&amp;sid=". $Site->getid() ."&amp;stid=" . $TID . "\"><img src=\"Images/building_edit.png\" alt=\"Site Trust\"/></a>","button");
				$Row5 = array("<a onclick=\"confirmdialog('Delete Site " . $Site->getname() . "', '?mid=0&amp;sid=". $Site->getid() ."&amp;stid=" . $TID . "&amp;aid=10');\"><img src=\"Images/building_delete.png\" alt=\"Delete Site\"/></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
			}
			
			Tables::generateadmintable("sitestable",$Cols,$Rows);
        
        }
                
        static public function showall($TID)
        {
        	$Trust = new Trusts($TID);
        	
        	print("<p>The list below shows all the sites that are part of " . $Trust->gettrust() . ". Click a site to see the full contact details.</p>");
        		        		
        	$RQ = new ReadQuery("SELECT IDLNK FROM Sites WHERE TrustIDLNK = " . $Trust->getid() . " AND Deleted = 0 ORDER BY Name");
        	
        	//echo($RQ->getquery());
        	
        	$Col1 = array("Site","sitename",1);
        	$Col2 = array("Phone","phone",1);
        	$Col3 = array("Fax","phone",1);
        	$Cols = array($Col1,$Col2,$Col3);
        	$Rows = array();
        	$RowCounter = 0;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		$Site = new Sites($row["IDLNK"]);
        		$Row1 = array("<a href=\"?sid=" . $Site->getid() . "\">" . $Site->getname() . "</a>"," ");
        		$Row2 = array($Site->gettelephone()," ");
        		$Row3 = array($Site->getfax()," ");
        		
        		$Rows[$RowCounter] = array($Row1,$Row2,$Row3);
        	    $RowCounter ++;
        	}
        	
        	Tables::generateadmintable("sitestable",$Cols,$Rows);
       	}
       	
       	static public function show($SID)
       	{
       		$Site = new Sites($SID);
       		
       		print("<h2>" . $Site->getname() . "</h2>");
       		
       		print("<dl class=\"contactdetails\">");
       		
       			print("<dt>Trust:</dt><dd><a href=\"?tid=" . $Site->gettrust()->getid() . "\">" . $Site->gettrust()->gettrust() . "</a></dd>");
       			print("<dt>Address:</dt><dd>" . $Site->getaddress() . "</dd>");
       			print("<dt>Telephone:</dt><dd>" . $Site->gettelephone() . "</dd>");
       			print("<dt>Fax:</dt><dd>" . $Site->getfax() . "</dd>");
       		
       		print("</dl>");
       		
       		print("<p><a href=\"?tid=" . $Site->gettrust()->getid() . "\">Return to the Sites List</a></p>");
       		
       	}
        
        static public function addedit($SID,$STID)
	    {
			$Name = $_POST["name"];
			$AddressLine1 = $_POST["addressline1"];
			$AddressLine2 = $_POST["addressline2"];
			$Town = $_POST["town"];
			$Postcode = $_POST["postcode"];
			$Telephone = $_POST["telephone"];
			$Fax = $_POST["fax"];
			$Submit = $_POST["submit"];
		
		
			$SiteError = array("siteerror","Please enter a site name.");
			$Address1Error = array("address1error","Please enter the first line of the address.");
			$TownError = array("townerror","Please enter a town name.");
			$PostcodeError = array("postcodeerror","Please enter a postcode.");
			$TelephoneError = array("telephoneerror","Please enter a telephone number.");
					
	        if($SID > 0){
	            //Edit
	            print("<h2>Edit Site</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewSite = new Sites($SID);
					
					$NewSite->settrust(new Trusts($STID));
					$NewSite->setname($Name);
					$NewSite->setaddressline1($AddressLine1);
					$NewSite->setaddressline2($AddressLine2);
					$NewSite->settown($Town);
					$NewSite->setpostcode($Postcode);
					$NewSite->settelephone($Telephone);
					$NewSite->setfax($Fax);
													
					$NewSite->save();			
										
					print("<p>The Site has been succesfully edited.</p>");
					
					print("<p>Return to <a href='directory.php'>Directory Admin</a>.</p>");
								       
			     } else {
	                //Form
	                print("<p>To Edit the Site complete the form below. Once you have completed it click the Edit Site button.</p>");
	                
	                $Errors = array($SiteError,$Address1Error,$TownError,$PostcodeError,$TelephoneError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Site = new Sites($SID);
	                	             	
	                //Trusts::form($Trust->gettrust(),$TID,true);
	                
	                //echo($Site->getname());
	                
	                $Trust = $Site->gettrust();
	                
	                Sites::form($Trust->getid(),$Site->getname(),$Site->getaddressline1(),$Site->getaddressline2(),$Site->gettown(),$Site->getpostcode(), $Site->gettelephone(),$Site->getfax(),$Site->getid(),false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Site</h2>");
	            
	            //printr($_POST);
	            
	            //print($_POST[0][0]);

	            if($Submit){
	                //Add
	                
	                $NewSite = new Sites(0);
	                
	                $NewSite->settrust(new Trusts($STID));
	                $NewSite->setname($Name);
	                $NewSite->setaddressline1($AddressLine1);
	                $NewSite->setaddressline2($AddressLine2);
	                $NewSite->settown($Town);
	                $NewSite->setpostcode($Postcode);
	                $NewSite->settelephone($Telephone);
	                $NewSite->setfax($Fax);
	                								
	                $NewSite->savenew();			
	                					
	                print("<p>The Site has been succesfully added to the site.</p>");
	                
	                print("<p>Return to <a href='directory.php'>Directory Admin</a>.</p>");			
				} else {
	                //Form
	                
	                print("<p>To Add a new Site complete the form below. Once you have completed it click the Save Site button.</p>");
	                   
	                $Errors = array($SiteError,$Address1Error,$TownError,$PostcodeError,$TelephoneError);
	                	
	                Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                   
	                Sites::form($STID,$SiteName,$AddressLine1,$AddressLine2,$Town,$Postcode,$Telephone,$Fax,$SID,$Add);
      	     
        	 	}
        	 }
	    }
	     
    	static public function form($TID,$SiteName,$AddressLine1,$AddressLine2,$Town,$Postcode,$Telephone,$Fax,$SID,$Add)
        {
        	$Trust = new Trusts($TID);
        
        	$TrustField = array("Trust:","Static","trustname",0,0,$Trust->gettrust());
        	$SiteField = array("Site name:","Text","name",65,0,$SiteName,"","",$Add);
        	$AddressLine1Field = array("Address:","Text","addressline1",65,0,$AddressLine1);
        	$AddressLine2Field = array("","Text","addressline2",65,0,$AddressLine2);
        	
        	$TownField = array("Town:","Text","town",40,0,$Town);
        	$PostcodeField = array("Postcode:","Text","postcode",10,0,$Postcode);
        	$TelephoneField = array("Telephone:","Text","telephone",12,0,$Telephone);
        	$FaxField = array("Fax:","Text","fax",12,0,$Fax);
        	
        
        	$Fields = array($TrustField,$SiteField,$AddressLine1Field,$AddressLine2Field,$TownField,$PostcodeField,$TelephoneField,$FaxField);
            
			if($TID == -1){
				$Button = "Add Site";
            	Forms::generateform("siteform","directory.php?sid=$SID&amp;stid=$TID","return checksiteform(this)",false,$Fields,$Button);
			} else {
				$Button = "Edit Site";
				Forms::generateform("siteform","directory.php?sid=$SID&amp;stid=$TID","return checksiteform(this)",false,$Fields,$Button);
			}
           
        }
        
		static public function deletesite($SID){
        	$Site = new Sites($SID);
        	
        	$Site->setdeleted(1);
        	
        	$Site->save();
        }   
        
        static public function gettrustid($SID){
        	$Site = new Sites($SID);
        	
        	return $Site->gettrust()->getid();
        }  
       
    }

?>