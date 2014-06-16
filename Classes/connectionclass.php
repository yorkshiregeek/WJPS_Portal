<?php

    class Connection
    {
    
        //Class Varibles
        var $c_server = DBSERVER;
        var $c_username = DBUSER;
        var $c_password = DBPASS;
        var $c_connection;
        
        //Connection Constructor
        function Connection()
        {
            //$this->c_connection = mysql_connect($this->c_server,$this->c_username,$this->c_password) or die ("Sorry - unable to connect to MySQL" . mysql_error());
        $this->c_connection = new mysqli("$this->c_server", "$this->c_username", "$this->c_password", DBNAME);
        if ($this->c_connection->connect_errno) 
            {
                printf("Connect failed: %s\n", $this->c_connection->connect_error);
                exit();
            }

        }

        public function query($sql)
        {
        return $this->c_connection->query($sql);
        }
        
        //Get Connection
        function getconnection()
        {
            return $this->c_connection;
        }
    }

?>