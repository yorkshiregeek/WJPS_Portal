<?php

    class Positions
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Position;
        var $c_Order;
        var $c_Deleted;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function setposition($Val)
        {
            $this->c_Position = $Val;
        }
        
        function getposition()
        {
            return $this->c_Position;
        }
        
        function setorder($Val)
        {
        	$this->c_Order = $Val;
        }
        
        function getorder()
        {
        	return $this->c_Order;
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
                $RQ = new ReadQuery("SELECT * FROM Positions WHERE PositionIDLNK = " . $ID . ";");
                

                $row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
                $this->c_ID = $ID;
                $this->c_Position = stripslashes($row["Position"]);
                $this->c_Order = $row["DisplayOrder"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$WQ = new WriteQuery("INSERT INTO Positions (Position,DisplayOrder,Deleted) VALUES ('" . addslashes($this->getposition()) . "'," . $this->getorder() . ",0)");
            $this->c_ID = mysql_insert_id();
            //echo($WQ->getquery());
        }
        
        function save()
        {
        	$WQ = new WriteQuery("UPDATE Positions SET Position = '" . addslashes($this->getposition()) . "', DisplayOrder = " . $this->getorder() . ", Deleted = " . $this->getdeleted() . " WHERE PositionIDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }
        
        static public function listall()
        {
    		//Normal
    		
    		print("<p>The list below shows all the positions in the system.</p>");
    		
    		print("<p><a href='positions.php?pid=-1'><img src=\"Images/user_add.png\" alt=\"Add New Position\"/>Add New Position</a></p>");
        		
        	$RQ = new ReadQuery("SELECT PositionIDLNK FROM Positions WHERE Deleted = 0 ORDER BY DisplayOrder");
        	
        	//echo($RQ->getquery());
        	
        	$Col1 = array("Position","sectionname",1);
        	$Col2 = array("","operations",4);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
        		$Position = new Positions($row["PositionIDLNK"]);
        		$Row1 = array($Position->getposition()," ");
        		if($RowCounter == 0){
        			$Row2 = array(" "," ");
        		} else {
        			$Row2 = array("<a href=\"?pid=" . $Position->getid() . "&amp;dir=up\"><img src=\"Images/arrow_up.png\" alt=\"Move Up\"></a>" ," ");
        		}
        		
        		if($RowCounter == $RQ->getnumberofresults() - 1){
        			$Row3 = array(" "," ");
        		} else {
        			$Row3 = array("<a href=\"?pid=" . $Position->getid() . "&amp;dir=down\"><img src=\"Images/arrow_down.png\" alt=\"Move Down\"></a>" ," ");
        		}
        		$Row4 = array("<a href=\"?pid=". $Position->getid() ."\"><img src=\"Images/user_edit.png\" alt=\"Edit Position\"/></a>","button");
        		$Row5 = array("<a onclick=\"confirmdialog('Delete Position " . $Position->getposition() . "', '?pid=". $Position->getid() ."&amp;aid=10');\"><img src=\"Images/user_delete.png\" alt=\"Delete User\"/></a>","button");
        		//$Row4 = array("<a href=\"?lid=". $Link->getid() ."&amp;aid=10\"><img src=\"Images/link_delete.png\" alt=\"Delete Link\"/></a>","button");
        		
        		$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5);
                $RowCounter ++;
        	}
        	
        	Tables::generateadmintable("positionstable",$Cols,$Rows);

        	//generateadminsorttable
        
        }
        
        static public function addedit($PID)
	    {
			$Position = $_POST["position"];
		
			$Submit = $_POST["submit"];
			
			$PositionError = array("positionerror","Please enter a position name");

	        if($PID > 0){
	            //Edit
	            print("<h2>Edit Position</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewPosition = new Positions($PID);
					
					$NewPosition->setposition($Position);
					
					$NewPosition->save();
					
					print("<p>The position has been succesfully edited.</p>");
					
					print("<p>Return to <a href='positions.php'>Positions Admin</a>.</p>");
					
					
			     } else {
	                //Form
	                print("<p>To Edit the Position complete the form below. Once you have completed it click the Edit Position button.</p>");
	                
	                $Errors = array($PositionError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $Position = new Positions($PID);
	                	             	
	                Positions::form($Position->getposition(),$PID,false);
	             }
        	 } else {
        	 //Add
	            print("<h2>Add New Position</h2>");

	            if($Submit){
	                //Add
	                 
					$NewPosition = new Positions(0);
					
					$NewPosition->setposition($Position);
					
					$RQ = new ReadQuery("SELECT DisplayOrder FROM Positions WHERE Deleted = 0 ORDER BY DisplayOrder DESC LIMIT 0,1;");
					
					$row = mysql_fetch_array($RQ->getresults());
					
					$NewPosition->setorder($row[0] + 1);
					
					$NewPosition->savenew();								
					
					print("<p>The new position has been added to the system succesfully.</p>");
					
					print("<p>Return to <a href='positions.php'>Positions Admin</a>.</p>");
				
				} else {
	                //Form
	                print("<p>To Add a New Position complete the form below. Once you have completed it click the Add Position button.</p>");
	                
	                $Errors = array($PositionError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
        			
	                Positions::form($Position,$PID,true);
	             }
        	 }
	     }
	     
    	static public function form($Position,$PID,$Add)
        {
        	$PositionField = array("Position:","Text","position",65,0,$Position);
        	
        	$Fields = array($PositionField);

			if($PID == -1){
				$Button = "Add Position";
            	Forms::generateform("positionsform","positions.php?pid=$PID","return checkpositionform(this)",true,$Fields,$Button);
			} else {
				$Button = "Edit Position";
				Forms::generateform("positionsform","positions.php?pid=$PID","return checkpositionform(this)",true,$Fields,$Button);
			}
        }
        
        static public function moveposition($PID,$DIR)
        {
	        
	    	//Move Category
	    	
	    	if($DIR == "up"){
	    		$MovePos = new Positions($PID);
	    		
	    		$RQ = new ReadQuery("SELECT PositionIDLNK FROM Positions WHERE DisplayOrder < " . $MovePos->getorder() . " AND Deleted = 0 ORDER BY DisplayOrder DESC LIMIT 0,1;");
	    		
	    		//echo($RQ->getquery());
	    		
	    		$row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
	    		
	    		$PrevPos = new Positions($row[0]);
	    		
	    		$TempOrder = $MovePos->getorder();
	    		
	    		//echo($TempOrder . ", " . $PrevPos->getorder());
	    		
	    		$MovePos->setorder($PrevPos->getorder());
	    		
	    		$PrevPos->setorder($TempOrder);
	    		
	    		$MovePos->save();
	    		
	    		$PrevPos->save();
	    		
	    		
	    	} else {
	    		$MovePos = new Positions($PID);
	    	
	    		$RQ = new ReadQuery("SELECT PositionIDLNK FROM Positions WHERE DisplayOrder > " . $MovePos->getorder() . " AND Deleted = 0 ORDER BY DisplayOrder LIMIT 0,1;");
	    		
	    		$row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC);
	    		
	    		$PrevPos = new Positions($row[0]);
	    		
	    		$TempOrder = $MovePos->getorder();
	    		
	    		$MovePos->setorder($PrevPos->getorder());
	    		
	    		$PrevPos->setorder($TempOrder);
	    		
	    		$MovePos->save();
	    		
	    		$PrevPos->save();
	
	    	
	    	}
	    }   
	        
                
		public static function generatearray()
		{
			$RQ = new ReadQuery("SELECT PositionIDLNK, Position FROM Positions WHERE Deleted = 0 ORDER BY DisplayOrder;");
			
			//echo($RQ->getquery());
			
			$ReturnArray = array();
			
			$Counter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				//echo($row[1]);NOTT
				$ReturnArray[$Counter] = array($row[0],$row[1]);
				$Counter ++;
			}
			
			return $ReturnArray;
			
			//printf($ReturnArray);
		}
		
		public static function generateavailablearray($TID,$CID)
		{
		
			if($CID){
				$RQ0 = new ReadQuery("SELECT PositionIDLNK FROM Contacts WHERE TrustIDLNK = " . $TID . " AND ContactIDLNK != " . $CID . " AND Deleted = 0;");
			} else {
				$RQ0 = new ReadQuery("SELECT PositionIDLNK FROM Contacts WHERE TrustIDLNK = " . $TID . " AND Deleted = 0;");
			}
			
			//echo($RQ0->getquery());
			
			$PositionsID = "";
			
			while($row0 = $RQ0->getresults()->fetch_array(MYSQLI_ASSOC)){
				$PositionsID .= "," . $row0[0];
			}
		
			if($PositionsID != ""){
		
				$RQ = new ReadQuery("SELECT PositionIDLNK, Position From Positions WHERE PositionIDLNK NOT IN (" . substr($PositionsID,1) . ") AND Deleted = 0 ORDER BY DisplayOrder;");
			
			} else {
			
				$RQ = new ReadQuery("SELECT PositionIDLNK, Position From Positions WHERE Deleted = 0 ORDER BY DisplayOrder;");
			
			}
			
			//echo($RQ->getquery());
			
			$ReturnArray = array();
			
			$Counter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
				//echo($row[1]);
				$ReturnArray[$Counter] = array($row[0],$row[1]);
				$Counter ++;
			}
			
			return $ReturnArray;
			
		}
		
		public static function deleteposition($PID)
		{
			$Position = new Positions($PID);
			
			$Position->setdeleted(1);
			
			$Position->save();
		
		}
		
		

    }

?>