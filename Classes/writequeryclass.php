<?php

   
    class WriteQuery
    {
        //Class Varibles
        var $c_connection;
        var $c_query;
        var $c_database = DBNAME;
        
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
    
        //Write Query Constrcutor
        function WriteQuery($Query)
        {
            $this->c_connection = new Connection();
            $this->runquery($Query);
        }
        
        //Run Query
        function runquery($query)
        {
            $this->c_query = $query;
            if($this->c_query){
              
                 $this->c_results=$this->c_connection->query($this->c_query);
            }//end if
        }
    
    }
    
?>