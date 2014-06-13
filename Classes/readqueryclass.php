<?php

    class ReadQuery
    {
        //Class Varibles
        var $c_connection;
        var $c_query;
        var $c_database = DBNAME;
        var $c_results;
        var $c_number_of_results;
        
        //Set Connection
        function setconnection($connection)
        {
            $this->c_connection = $connection;
        }
        
        //Get Connection
        function getconnection()
        {
            return $this->c_connection;
        }
        
        //Set Query
        function setquery($query)
        {
            $this->c_query = $query;
        }
        
        //Get Query
        function getquery()
        {
            return $this->c_query;
        }
        
        //Set Database
        function setdatabase($database)
        {
            $this->c_database = $database;
        }
        
        //Get Database
        function getdatabase()
        {
            return $this->c_database;
        }
        
        //Get Results
        function getresults()
        {
            return $this->c_results;
        }
        
        //Get Number Of Results
        function getnumberofresults()
        {
            return $this->c_number_of_results;
        }
        
        //Read Query Constructor
        function ReadQuery($Query)
        {
            $this->c_connection = new Connection();
            $this->runquery($Query);
        }
        
        //Run Query
        function runquery($query)
        {
        	//echo($query);
            $this->c_query = $query;
            if($this->c_query){
                $this->c_results=$this->c_connection->query($this->c_query);
               
                // printf("Select returned %d rows.\n", $this->c_results->num_rows);
                $this->c_number_of_results=$this->c_results->num_rows;

                //echo($query);
            }//end if
        }
    }
?>