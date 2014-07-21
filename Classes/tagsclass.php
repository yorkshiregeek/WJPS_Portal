<?php

    class Tags
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Title;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function settitle($Val)
        {
            $this->c_Title = strtolower($Val);
        }
        
        function gettitle()
        {
            return strtolower($this->c_Title);
        }
                    
        //Connection Constructor
        function __construct($ID,$Title)
        {

            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Tags WHERE IDLNK = " . $ID . ";");
                
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Title = $row["Title"];
            }else{
                //Create New
                $this->settitle($Title);
            }
        }

        function save()
        {
            $RQ = new ReadQuery("SELECT IDLNK FROM Tags WHERE Title = '" . $this->gettitle() . "'");

            if($RQ->getnumberofresults() > 0){
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $row["IDLNK"];
            } else {
        	   $WQ = new WriteQuery("INSERT INTO Tags (Title) VALUES ('" . $this->gettitle() . "')");
                $this->c_ID = $WQ->getinsertid();
            }
        }

    }



?>