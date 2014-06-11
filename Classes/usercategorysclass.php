<?php

    class UserCategory
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
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
                $RQ = new ReadQuery("SELECT * FROM UserCategorys WHERE IDLNK = " . $ID . ";");
                $row = mysql_fetch_array($RQ->getresults());
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$WQ = new WriteQuery("INSERT INTO UserCategorys (Title, Deleted) VALUES ('" . $this->gettitle() . "', 0)");
        	//echo($WQ->getquery());
            $this->c_ID = mysql_insert_id();
        }
        
        function save()
        {
        	$WQ = new WriteQuery("UPDATE UserCategorys SET Title = '" . $this->gettitle() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        public static function generatearray()
        {
        	$RQ = new ReadQuery("SELECT IDLNK, Title From UserCategorys WHERE Deleted = 0 ORDER BY Title;");
        	
        	//echo($RQ->getquery());
        	
        	$ReturnArray = array();
        	
        	$Counter = 0;
        	
        	while($row = mysql_fetch_array($RQ->getresults())){
        		//echo($row[1]);
        		$ReturnArray[$Counter] = array($row[0],$row[1]);
        		$Counter ++;
        	}
        	
        	return $ReturnArray;
        	
        	//printf($ReturnArray);
        }
        
        public static function generatearraybyuser($UID)
        {
        
        	$RQ = new ReadQuery("SELECT UserCategorys.IDLNK, UserCategorys.Title From UserCategorys, UsersCategorys WHERE UsersCategorys.Deleted = 0 AND UsersCategorys.UserIDLNK = $UID AND UsersCategorys.CategoryIDLNK = UserCategorys.IDLNK ORDER BY UserCategorys.Title;");
        	
        	//echo($RQ->getquery());
        	
        	$ReturnArray = array();
        	
        	$Counter = 0;
        	
        	while($row = mysql_fetch_array($RQ->getresults())){
        		//echo($row[1]);
        		$ReturnArray[$Counter] = array($row[0],$row[1]);
        		$Counter ++;
        	}
        	
        	return $ReturnArray;
        	
        	//printf($ReturnArray);
        }
        
        public static function gettotal()
        {
        	$RQ = new ReadQuery("SELECT Count(*) FROM UserCategorys WHERE Deleted = 0;");
        	
        	$row = mysql_fetch_array($RQ->getresults());
        	
        	return $row[0];
        }
       
    }

?>