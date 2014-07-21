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

         function getusers()
        {
            $RQ = new ReadQuery("SELECT UserIDLNK FROM UsersCategorys WHERE CategoryIDLNK = " . $this->getid() . " AND Deleted = 0;");
            
            //echo($RQ->getquery());
        
            $Counter = 0;
            
            //$Cats = new array;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                $CatArray[$Counter] = $row["UserIDLNK"];
                
                $Counter ++;
            }
            
            //print_r($CatArray);
            
            return $CatArray;
        }
                
        //Connection Constructor
        function __construct($ID)
        {
//echo("Here" . $ID);

            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM UserCategorys WHERE IDLNK = " . $ID . ";");
                //echo($RQ->getquery());
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
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
            $this->c_ID = mysqli_insert_id;
        }
        
        function save()
        {
        	$WQ = new WriteQuery("UPDATE UserCategorys SET Title = '" . $this->gettitle() . "', Deleted = " . $this->getdeleted() . " WHERE IDLNK = " . $this->getid() . ";");
			//echo($WQ->getquery());
        }

        static public function listall()
        {
            //Normal
                
            print("<p class='lead'>The list below shows all user groups in the system. From this page you can add, edit or delete groups.</p>");
            
            print("<p><a href='usergroups.php?ugid=-1'><span class =\"glyphicon glyphicon-plus\" alt=\"Add New User Group\"/></span> Add New User Group</a></p>");
                
            $RQ = new ReadQuery("SELECT IDLNK FROM UserCategorys WHERE Deleted = 0 ORDER BY Title");
            
            $Col1 = array("Group Title","grouptitle",1);
            $Col2 = array("","operations", 3);
            $Cols = array($Col1,$Col2);
            $Rows = array();
            $RowCounter = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                $UserGroup = new UserCategory($row["IDLNK"]);
                $Row1 = array($UserGroup->gettitle()," ");
                $Row2 = array("<a href=?ugid=". $UserGroup->getid() ." title=\"Edit User Group\"><span class=\"glyphicon glyphicon-pencil\" alt=\"Edit User Group\"/></span></a>","button");
                $Row3 = array("<a onclick=\"confirmdialog('Delete User Group " . $UserGroup->gettitle() . "', '?ugid=". $UserGroup->getid() ."&amp;aid=10');\" title=\"Delete User Group\"><span class=\"glyphicon glyphicon-trash\" alt=\"Delete User Group\"/></span></a>","button");
                
                $Rows[$RowCounter] = array($Row1,$Row2,$Row3,);
                $RowCounter ++;
            }
            
            Tables::generateadmintable("adminusergrouptable",$Cols,$Rows);
        }

        static public function addedit($UGID)
        {
            $Title = $_POST["title"];
            
            
            //Get Number of Categorys
            $NofU = Users::gettotal();
            
            //$Users = new array();
            
            for($c=1;$c<=$NofU;$c++)
            {
                if(isset($_POST["users" . $c])){
                    $Users[$c-1] = $_POST["users" . $c];
                }
            }

            printf($Users);

            $Submit = $_POST["submit"];
            
            $DefaultError = array("defaulterror","A group with this title already exists.");
            $TitleError = array("usernameerror","Please enter a group title");
             
            if($UGID > 0){
                //Edit

                if($Submit){
                    //Edit
                     
                    $NewUserGroup = new UserCategory($UGID);
                    
                    $NewUserGroup->settitle($Title);
                    
                    //$U = new User($UserCategory);
                    //$NewUser->setusercategory($UC);
                
                    $NewUserGroup->save();
                    
                    //Delete Categorys
                    
                    $WQ = new WriteQuery("DELETE FROM userscategorys WHERE CategoryIDLNK = " . $NewUserGroup->getid() . ";");
                    
                    //print_r($UserCategorys);
                    
                    foreach($Users as $U)
                    {
                       $WQ = new WriteQuery("INSERT INTO UsersCategorys (UserIDLNK, CategoryIDLNK, Deleted) VALUES (" . $U . ", " . $NewUserGroup->getid() . ",0);");
                        
                        //echo($WQ->getquery());
                    }
                    
                    print("<p class='lead'>The user group has been succesfully edited.</p>");
                    
                    print("<p>Return to <a href=\"usergroups.php\">Users Group Admin</a></p>");
                 } else {
                    //Form
                    print("<p class='lead'>To Edit the User Group complete the form below. Once you have completed it click the Edit User Group button.</p><p><b>N.B.</b> The User Group Title cannot be changed.</p>");
                    
                    $Errors = array($TitleError);
                    
                    Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
                    
                    $UserGroup = new UserCategory($UGID);
                                        
                    UserCategory::form($UserGroup->gettitle(),$UserGroup->getid(),$UserGroup->getusers(),false);
                 }
             } else {
             //Add

                if($Submit){
                    //Add
                     
                    $NewUserGroup = new UserCategory(0);
                    
                    $NewUserGroup->settitle($Title);
                    
                    /*$UC = new UserCategory($UserCategory);
                    $NewUser->setusercategory($UC);*/
                    
                    $TitleNotReg = UserCategory::titlenotreg($Title);
                    
                    if($TitleNotReg){
                    
                        $NewUserGroup->savenew();
                        
                       foreach($Users as $U)
                        {
                           $WQ = new WriteQuery("INSERT INTO UsersCategorys (UserIDLNK, CategoryIDLNK, Deleted) VALUES (" . $U . ", " . $NewUserGroup->getid() . ",0);");
                            
                            //echo($WQ->getquery());
                        }
                        
                        print("<p class='lead'>You have succesfully added a new user group.</p>");
                         
                        print("<p>Return to <a href=\"usergroups.php\">User Group Admin</a></p>"); 
                    
                    } else {
                        print("<p class='lead'>To Add a New User Group complete the form below. Once you have completed it click the Add User Group button.</p><p><b>N.B.</b> The User Group Title must be unique.</p>");
                
                        //if(!$UsernameNotReg)
                        //  print("<p class=\"error\">A user with this username aready exists.</p>");
                        //}
                        
                        $Errors = array($DefaultError,$TitleError);
                    
                        Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
                        
                        UserCategory::form($Title,$UGID,$Users,true);
                    }
                } else {
                    //Form
                    print("<p class='lead'>To Add a New User Group complete the form below. Once you have completed it click the Add User Group button.</p><p><b>N.B.</b> The User Group Title must be unique.</p>");
                    
                    $Errors = array($TitleError);
                    
                    Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
                    
                    UserCategory::form($Title,$UGID,$Users,true);
                }
            }
        }
         
        static public function form($Title,$UserGroupID,$Users,$Add)
        {
            
            //$UserCategoryArray = UserCategory::generatearray();

            $UserArray = Users::generatearray();


            $TitleField = array("Title:","Text","title",30,0,$Title,"Enter a group name. This must be unique.","",!$Add);
            $UsersField = array("Users:","CheckboxArray","users",0,0,$Users,"",$UserArray);


            $UserGroupIDField = array("","Hidden","id",0,0,$UserGroupID);
            
            $Fields = array($TitleField,$UsersField,$UserGroupIDField);

            
            if($UserGroupID == -1){
                $Button = "Add User Group";
                Forms::generateform("UserGroupForm","usergroups.php?ugid=$UserGroupID","return checkuserform(this)",false,$Fields,$Button);
            } else {
                $Button = "Edit User Group";
                Forms::generateform("UserForm","usergroups.php?ugid=$UserGroupID","return checkuserform(this)",false,$Fields,$Button);
            }
            
            
            
        }

        static public function titlenotreg($Title)
        {
            $RQ = new ReadQuery("SELECT IDLNK FROM UserCategorys WHERE Title = '" . $Title . "' AND Deleted = 0;");
            //echo($RQ->getquery());
            if($RQ->getnumberofresults() > 0){
                return false;
            } else {
                return true;
            }
        }

        static public function deleteusergroup($UGID){

            $UserGroup = new UserCategory($UGID);
            
            $UserGroup->setdeleted(1);
            
            $UserGroup->save();
        }     
        
        public static function generatearray()
        {
        	$RQ = new ReadQuery("SELECT IDLNK, Title From UserCategorys WHERE Deleted = 0 ORDER BY Title;");
        	
        	//echo($RQ->getquery());
        	
        	$ReturnArray = array();
        	
        	$Counter = 0;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		//echo($row[1]);
        		$ReturnArray[$Counter] = array($row[0],$row[1]);
        		$Counter ++;
        	}
        	
        	return $ReturnArray;
        	
        	//printf($ReturnArray);
        }

        public static function generatearraybygroup($GroupID)
        {
            $RQ = new ReadQuery("SELECT IDLNK, Title From UserCategorys WHERE IDLNK IN (SELECT UserCategoryIDLNK FROM GroupUserCategorys WHERE GroupIDLNK = $GroupID) ORDER BY Title;");
            
            //echo($RQ->getquery());
            
            $ReturnArray = array();
            
            $Counter = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                //echo($row[1]);
                $ReturnArray[$Counter] = array($row[0],$row[1]);
                $Counter ++;
            }
            
            return $ReturnArray;
            
            //printf($ReturnArray);
        }

        public static function generatearraybysection($SectionID)
        {
            $RQ = new ReadQuery("SELECT IDLNK, Title From UserCategorys WHERE IDLNK IN (SELECT UserCategoryIDLNK FROM SectionUserCategorys WHERE SectionIDLNK = $SectionID) ORDER BY Title;");
            
            //echo($RQ->getquery());
            
            $ReturnArray = array();
            
            $Counter = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
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
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		//echo($row[1]);
        		$ReturnArray[$Counter] = array($row[0],$row[1]);
        		$Counter ++;
        	}
        	
        	return $ReturnArray;
        	
        	printf($ReturnArray);
        }
        
        public static function gettotal()
        {
        	$RQ = new ReadQuery("SELECT Count(*) FROM UserCategorys WHERE Deleted = 0;");
        	
        	$row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
        	
        	return $row[0];
        }

        public static function gettotalbygroup($GroupID)
        {
            $RQ = new ReadQuery("SELECT COUNT(*) FROM GroupUserCategorys WHERE GroupIDLNK = $GroupID;");

            $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
            
            return $row[0];
        }

        public static function gettotalbysection($SectionID)
        {
            $RQ = new ReadQuery("SELECT COUNT(*) FROM SectionUserCategorys WHERE SectionIDLNK = $SectionID;");

            echo($RQ->getquery());

            $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
            
            return $row[0];
        }
       
    }

?>