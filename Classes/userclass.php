<?php

    class Users
    {
    
        //Class Varibles
        var $c_ID;
        var $c_Username;
        var $c_Password;
        var $c_Firstname;
        var $c_Surname;
        var $c_Email;
        var $c_Hospital;
        var $c_Userlevel;
        var $c_UserCategory;
        var $c_LastLogin;
        var $c_Deleted;
        var $salt;
        
        function getid()
        {
            return $this->c_ID;
        }
        
        function setusername($Val)
        {
            $this->c_Username = $Val;
        }
        
        function getusername()
        {
            return $this->c_Username;
        }

        function setpassword($Val)
        {
            $this->c_Password = $Val;
        }
        
        function getpassword()
        {
            return $this->c_Password;
        }
                
        function setfirstname($Val)
        {
            $this->c_Firstname = $Val;
        }
        
        function getfirstname()
        {
            return $this->c_Firstname;
        }
        
        function setsurname($Val)
        {
            $this->c_Surname = $Val;
        }
        
        function getsurname()
        {
            return $this->c_Surname;
        }
        
        function getfullname()
        {
        	return $this->c_Firstname . " " . $this->c_Surname;
        }
        
         function setemail($Val)
        {
            $this->c_Email = $Val;
        }
        
        function getemail()
        {
            return $this->c_Email;
        }

        
        function sethospital($Val)
        {
        	$this->c_Hospital = $Val;
        }
        
        function gethospital()
        {
        	return $this->c_Hospital;	
        }
        
        function setuserlevel($Val)
        {
            $this->c_UserLevel = $Val;
        }
        
        function getuserlevel()
        {
            return $this->c_UserLevel;
        }

        function setlastlogin($Val)
        {
            $this->c_LastLogin = $Val;
        }
        
        function getlastlogin()
        {
            return $this->c_LastLogin;
        }

        function updatelastlogin()
        {
            $WQ = new WriteQuery("UPDATE Users Set LastLogin = '" . date("Y-m-d") . "' WHERE IDLNK = " . $this->c_ID . ";");
            //echo($WQ->getquery());
            $this->c_LastLogin = date("Y-m-d");
        }
        
        function getuserleveldesc()
        {
            switch ($this->c_UserLevel) {
			    case 1:
			        return "User";
			        break;
			    case 2:
			    	return "Document Admin";
			    	break;
			   	case 3:
			   		return "Global Admin";
			   		break;
			}
        }
        
        function setusercategory($Val)
        {
            $this->c_UserCategory = $Val;
        }
        
        function getusercategory()
        {
            return $this->c_UserCategory;
        }
        
        function setdeleted($Val)
        {
            $this->c_Deleted = $Val;
        }
        
        function getdeleted()
        {
            return $this->c_Deleted;
        }
        
        function getcategorys()
        {
        	$RQ = new ReadQuery("SELECT CategoryIDLNK FROM UsersCategorys WHERE UserIDLNK = " . $this->getid() . " AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        
        	$Counter = 0;
        	
        	//$Cats = new array;
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		$CatArray[$Counter] = $row["CategoryIDLNK"];
        		
        		$Counter ++;
        	}
        	
        	//print_r($CatArray);
        	
        	return $CatArray;
        }
        
        //Connection Constructor
        function __construct($ID)
        {
            if($ID > 0){
                //Load Using ID
                $RQ = new ReadQuery("SELECT * FROM Users WHERE IDLNK = " . $ID . ";");
                //$row = mysql_fetch_array($RQ->getresults());
                
                //Added by JNH to update depracted fetcharray
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
                $this->c_ID = $ID;
                $this->c_Username = $row["Username"];
                $this->c_Password = $row["Password"];
                $this->c_Firstname = $row["Firstname"];
                $this->c_Surname = $row["Surname"];
                $this->c_Email = $row["Email"];
                $this->c_Hospital = $row["Hospital"];
                $this->c_UserLevel = $row["Userlevel"];
                $this->c_UserCategory = $row["UserCategory"];
                $this->c_LastLogin = $row["LastLogin"];
                $this->c_Deleted = $row["Deleted"];
            }else{
                //Create New
                $this->setdeleted(false);
            }
        }
        
        function savenew()
        {
        	$UC = $this->getusercategory();
            $salt = 'sj*&3gs&3hksllas@@*!sbck29HSD';
            $salt .= $this->getpassword();
            //echo 'salt - '.$salt;
            //make password variable equal to salt plus the password the user was given.
            $password = $salt;
            //encrypt the password
            $password = md5($password);



            //echo 'password encrypted - '. $password; 
        	//Crypt Password
        	//$WQ = new WriteQuery("INSERT INTO Users (Username, Password, Firstname, Surname, Email, Hospital, UserLevel, Deleted) VALUES ('" . $this->getusername() ."','" . Crypt($this->getpassword(),'$1$rasmusle$') . "','" . $this->getfirstname(). "','" . $this->getsurname() . "','" . $this->getemail() . "','" . $this->gethospital() . "'," . $this->getuserlevel() . ",0)");
        	

            $WQ = new WriteQuery("INSERT INTO Users (Username, Password, Firstname, Surname, Email, Hospital, UserLevel, Deleted) VALUES ('" . $this->getusername() ."','" . $password . "','" . $this->getfirstname(). "','" . $this->getsurname() . "','" . $this->getemail() . "','" . $this->gethospital() . "'," . $this->getuserlevel() . ",0)");
        	
        	//echo($WQ->getquery());
            //$this->setid(mysql_insert_id);
        }
        
        function save()
        {
            $WQ = new WriteQuery("UPDATE Users SET Username = '" . $this->getusername() . "', Password = '" .$this->getpassword() . "', Firstname = '" . $this->getfirstname() . "', Surname = '" .$this->getsurname() . "', Email = '" . $this->getemail() ."', Hospital = '" . $this->gethospital() . "', Userlevel = " . $this->getuserlevel() . ", Deleted = " . $this->getdeleted() . " WHERE IDLNK = '" . $this->getid() . "';");
            //$WQ = new WriteQuery("UPDATE Users SET Username = '" . $this->getusername() . "', Password = '" .$this->getpassword() . "', Firstname = '" . $this->getfirstname() . "', Surname = '" .$this->getsurname() . "', Email = '" . $this->getemail() ."', Hospital = '" . $this->gethospital() . "', Userlevel = " . $this->getuserlevel() . ", Deleted = " . $this->getdeleted() . " WHERE IDLNK = '" . $this->getid() . "';");
			//echo($WQ->getquery());
        }
        
        function getusermenu($Page)
        {
            //echo($this->c_UserLevel);

        	 switch ($this->c_UserLevel) {
			    case 1:
			    	//User Menu
			        Menu::generateusermenu($Page,$this->c_ID);
			        break;
			    case 2:
			    	//Document Admim Menu
			    	Menu::generateusermenu($Page,$this->c_ID);
			    	break;
			   	case 3:
			   		//Global Admin Menu
			   		Menu::generateadminmenu($Page,$this->c_ID);
			   		break;
			}
        }
        
        static public function listall()
        {
     		//Normal
     			
			print("<p class='lead'>The list below shows all the system users. From this page you can add, edit or delete users.</p>");
			
			print("<p><a href='users.php?uid=-1'><span class =\"glyphicon glyphicon-plus\" alt=\"Add New User\"/></span> Add New User</a></p>");
				
			$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Deleted = 0 ORDER BY Surname, Firstname");
			
			//echo($RQ->getquery());
			
			$Col1 = array("Username","username",1);
			$Col2 = array("Fullname","fullname",1);
			$Col3 = array("Hospital","hospital",1);
            $Col4 = array("User Level","userlevel",1);
            $Col5 = array("","operations", 3);
            $Cols = array($Col1,$Col2,$Col3,$Col4,$Col5);
            $Rows = array();
            $RowCounter = 0;
			
			while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
				$User = new Users($row["IDLNK"]);
				$Row1 = array($User->getusername()," ");
				$Row2 = array($User->getfirstname() . " " . $User->getsurname()," ");
				$Row3 = array($User->gethospital()," ");
				$Row4 = array($User->getuserleveldesc()," ");
				$Row5 = array("<a href=?rid=". $User->getid() ." title=\"Reset Password\"><span class =\"glyphicon glyphicon-refresh alt=\"Reset Password\"></span></a>","button");
               
            
				$Row6 = array("<a href=?uid=". $User->getid() ." title=\"Edit User\"><span class=\"glyphicon glyphicon-pencil\" alt=\"Edit User\"/></span></a>","button");
				$Row7 = array("<a onclick=\"confirmdialog('Delete User " . $User->getusername() . "', '?uid=". $User->getid() ."&amp;aid=10');\" title=\"Delete User\"><span class=\"glyphicon glyphicon-trash\" alt=\"Delete User\"/></span></a>","button");
				
				$Rows[$RowCounter] = array($Row1,$Row2,$Row3,$Row4,$Row5,$Row6,$Row7);
                $RowCounter ++;
				
				//print("<li><a href=\"index.php?did=" . $Document->getid() . "\">" . $Document->gettitle() . "</a></li>");
			}
			
			Tables::generateadmintable("adminusertable",$Cols,$Rows);
        
        }
             
    	static public function addedit($UID)
	    {
			$Username = $_POST["username"];
			$Firstname = $_POST["firstname"];
			$Surname = $_POST["surname"];
			$Email = $_POST["email"];
			$Hospital = $_POST["hospital"];
			$UserLevel = $_POST["userlevel"];
			
			//Get Number of Categorys
			$NofC = UserCategory::gettotal();
			
			//$UserCategorys = new array();
			
			for($c=1;$c<=$NofC;$c++)
			{
				if(isset($_POST["usercategory" . $c])){
					//$UserCategory .= "," . $_POST["usercategory" . $c];
					$UserCategorys[$c-1] = $_POST["usercategory" . $c];
				}
			}
			
			//$UserCategory = substr($UserCategory, 1)
					
			$Submit = $_POST["submit"];
			
			$DefaultError = array("defaulterror","A user with this username already exists.");
        	$UsernameError = array("usernameerror","Please enter a username");
        	$EmailError = array("emailerror","Please enter an email address");
        	$AddressError = array("addresserror","Please enter a valid email address");
	         
	        if($UID > 0){
	            //Edit
	            //print("<h2>Edit User</h2>");

	        	if($Submit){
	                //Edit
	                 
					$NewUser = new Users($UID);
					
					$NewUser->setfirstname($Firstname);
					$NewUser->setsurname($Surname);
					$NewUser->setemail($Email);
					$NewUser->sethospital($Hospital);
					$NewUser->setuserlevel($UserLevel);
					$UC = new UserCategory($UserCategory);
					$NewUser->setusercategory($UC);
				
					$NewUser->save();
					
					//Delete Categorys
					
					$WQ = new WriteQuery("DELETE FROM userscategorys WHERE UserIDLNK = " . $NewUser->getid() . ";");
					
					//print_r($UserCategorys);
					
					foreach($UserCategorys as $UC)
					{
						$WQ = new WriteQuery("INSERT INTO UsersCategorys (UserIDLNK, CategoryIDLNK, Deleted) VALUES (" . $NewUser->getid() . ", " . $UC . ",0);");
						
						//echo($WQ->getquery());
					}
					
	                print("<p class='lead'>The users details have been succesfully edited.</p>");
	                
	                print("<p>Return to <a href=\"users.php\">Users Admin</a></p>");
	             } else {
	                //Form
	                print("<p class='lead'>To Edit the User complete the form below. Once you have completed it click the Edit User button.</p><p><b>N.B.</b> The Username cannot be changed.</p>");
	                
	                $Errors = array($UsernameError,$EmailError,$AddressError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                $User = new Users($UID);
	                	             	
	                Users::form($User->getusername(),$User->getfirstname(),$User->getsurname(),$User->getemail(),$User->gethospital(),$User->getuserlevel(),$User->getcategorys(),$User->getid(),false);
	             }
        	 } else {
        	 //Add
	            //print("<h2>Add New User</h2>");

	            if($Submit){
	                //Add
	                 
					$NewUser = new Users(0);
					
					$NewUser->setusername($Username);
					$NewUser->setpassword(Users::generatepassword());
					$NewUser->setfirstname($Firstname);
					$NewUser->setsurname($Surname);
					$NewUser->setemail($Email);
					$NewUser->sethospital($Hospital);
					$NewUser->setuserlevel($UserLevel);
					$UC = new UserCategory($UserCategory);
					$NewUser->setusercategory($UC);
					
					$UsernameNotReg = Users::usernamenotregistered($Username);
					
					if($UsernameNotReg){
					
						$NewUser->savenew();
						
						foreach($UserCategorys as $UC)
						{
							$WQ = new WriteQuery("INSERT INTO UsersCategorys (UserIDLNK, CategoryIDLNK, Deleted) VALUES (" . $NewUser->getid() . ", " . $UC . ",0);");
						}
						
						//Send Email to User
					       
						//$msg = SITENAME . URL . ") using your details below.</p><br/><dl><dt>Username:</dt><dd>$Username</dd><dt>Password:</dt><dd>" . $NewUser->getpassword() . "</dd></dl><br/><p>After you have logged onto the system we suggest that you change your password by using the change password link in the menu.</p>";
					    
                        
                        $Userpass = $NewUser->getpassword();



                        //$msg = "<h1>Account Setup</h1><p>You are now setup as a registered user on the " . SITENAME . " website. You can log into the website (" . URL . ") using your details below.</p><br/><dl><dt>Username:</dt><dd>$Username</dd><dt>Password:</dt><dd>" . $NewUser->getpassword() . "</dd></dl><br/><p>After you have logged onto the system we suggest that you change your password by using the change password link in the menu.</p>";


						Emails::newuser($Email,SITENAME . " Website Account",$Username, $Userpass, $Firstname, $Surname, URL);
					
	               		 print("<p class='lead'>You have succesfully added a new user. The users login details have been emailed to the users email address.</p>");
	               		 
	               		 print("<p>Return to <a href=\"users.php\">Users Admin</a></p>"); 
					
					} else {
						print("<p class='lead'>To Add a New User complete the form below. Once you have completed it click the Add User button.</p><p><b>N.B.</b> The Username must be unique.</p>");
				
						//if(!$UsernameNotReg)
						//	print("<p class=\"error\">A user with this username aready exists.</p>");
						//}
						
						$Errors = array($DefaultError,$UsernameError,$EmailError,$AddressError);
        			
        				Forms::generateerrors("Please correct the following errors before continuing.",$Errors,true);
						
						Users::form($Username,$Firstname,$Surname,$Email,$Hospital,$UserLevel,$UserCategorys,$UID,true);
					}
				} else {
	                //Form
	                print("<p class='lead'>To Add a New User complete the form below. Once you have completed it click the Add User button.</p><p><b>N.B.</b> The Username must be unique.</p>");
	                
	                $Errors = array($UsernameError,$EmailError,$AddressError);
        			
        			Forms::generateerrors("Please correct the following errors before continuing.",$Errors,false);
	                
	                Users::form($Username,$Firstname,$Surname,$Email,$Hospital,$UserLevel,$UserCategorys,$UID,true);
	            }
       		}
	    }
	     
    	static public function form($Username,$Firstname,$Surname,$Email,$Hospital,$UserLevel,$UserCategory,$UserID,$Add)
        {
        	$UserLevelArray = array(array(3,"Global Admin"),array(2,"Document Admin"),array(1,"User"));
        	
        	$UserCategoryArray = UserCategory::generatearray();


        	$UsernameField = array("Username","Text","username",30,0,$Username,"Enter username. N.B. This must be unique.","",!$Add);
            $FirstnameField = array("Firstname","Text","firstname",30,0,$Firstname,"Enter firstname");
            $SurnameField = array("Surname","Text","surname",30,0,$Surname,"Enter surname");
            $EmailField = array("Email","Text","email",30,0,$Email,"Enter email address");
            $HospitalField = array("Hospital","Text","hospital",30,0,$Hospital,"Enter associated hospital");

            $UserLevelField = array("User Level","Select","userlevel",0,0,$UserLevel,"",$UserLevelArray);
            $UserCategoryField = array("User Category","CheckboxArray","usercategory",0,0,$UserCategory,"",$UserCategoryArray);

			$UserIDField = array("","Hidden","id",0,0,$UserID);
			
			$Fields = array($UsernameField,$FirstnameField,$SurnameField,$EmailField,$HospitalField,$UserLevelField,$UserCategoryField);

            
			if($UserID == -1){
				$Button = "Add User";
            	Forms::generateform("UserForm","users.php?uid=$UserID","return checkuserform(this)",false,$Fields,$Button);
			} else {
				$Button = "Edit User";
				Forms::generateform("UserForm","users.php?uid=$UserID","return checkuserform(this)",false,$Fields,$Button);
			}
            
            
            
        }
                
    	static public function usernamenotregistered($Username)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Username = '" . $Username . "' AND Deleted = 0;");
        	//echo($RQ->getquery());
        	if($RQ->getnumberofresults() > 0){
        		return false;
        	} else {
        		return true;
        	}
        }
        
         static public function emailnotregistered($Email)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Email = '" . $Email . "' AND Deleted = 0;");
        	//echo($RQ->getquery());
        	if($RQ->getnumberofresults() > 0){
        		return false;
        	} else {
        		return true;
        	}
        }
        
        static public function exists($UID)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE IDLNK = '" . $UID . "';");
        	if($RQ->getnumberofresults() > 0){
				return true;
        	} else {
        		return false;	
        	}
        }
        
         static public function finduser($Email)
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Email = '" . $Email . "';");
        	if($RQ->getnumberofresults() > 0){
				$row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
				return $row["IDLNK"];
			} else {
        		return 0;	
        	}
        }
        
        static public function allemails()
        {
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Deleted = 0;");
        	
        	$List = "";
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
        		$User = new Users($row["IDLNK"]);
        		$List .= "," . $User->getemail();
        	}
        	
        	//echo(substr($List,1));
        	
        	return substr($List, 1);
        }

        static public function allusers()    {
            $RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE Deleted = 0;");
            
            $List = array();

            $c = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                $User = new Users($row["IDLNK"]);
                $List[$c] = $User;
                $c += 1;
            }
            
            //echo(substr($List,1));
            
            return $List;
        }
           
        static public function allemailsbycategory($Categorys)
        {
        	$RQ0 = new ReadQuery("SELECT UserIDLNK FROM UsersCategorys WHERE CategoryIDLNK IN (" . $Categorys . ");");
        	
        	//echo($RQ0->getquery());
        	
        	while($row = $RQ0->getresults()->fetch_array(MYSQLI_ASSOC))
        	{
        		$Users .= "," . $row["UserIDLNK"];
        	}
        
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users WHERE IDLNK IN (" . substr($Users,1) . ") AND Deleted = 0;");
        	
        	//echo($RQ->getquery());
        	
        	$List = "";
        	
        	while($row = $RQ->getresults()->fetch_array(MYSQLI_ASSOC)){
        		$User = new Users($row["IDLNK"]);
        		$List .= ";" . $User->getemail();
        	}
        	
        	//echo(substr($List,1));
        	
        	return substr($List, 1);
        }

                
        static public function login($UserLevel)
        {
        	$Submit = $_POST["submit"];
        	$Username = $_POST["username"];
        	$Password = $_POST["password"];

        	$LoginError = array("defaulterror","Your username and password do not match.");
        	$UsernameError = array("usernameerror","Please enter a username");
        	$PasswordError = array("passworderror","Please enter a password");
        	
        	if(($Submit) || ISSET($_SESSION["userid"])){
        		//Login Check
        		$LoginStatus = Users::logincheck($UserLevel);
        		
        		//echo($LoginStatus);
        		
        		if($LoginStatus > 0){
        			$User = new Users($LoginStatus);

                    $User->updatelastlogin();

        			$_SESSION["username"] = $User->getusername();

        			$_SESSION["password"] = $User->getpassword();
        			
                    $_SESSION["userid"] = $LoginStatus;

                    if($User->getuserlevel() == 3)
                    {
                        $_SESSION["isadmin"] = true;
                    }
        			return true;
        		} else {
        			//Wrong Combination

                    echo("<h2 class=page-header>Secure Login</h2>");
        			
        			echo("<p class='lead'>Before you can access the secure side of this site you must first login using you Username and Password.</p>");
        			    			
        			$Errors = array($LoginError,$UsernameError,$PasswordError);
        			
        			Forms::generateerrors("The following errors occuring during the login.",$Errors,true);
        			
        			Users::loginform();
        			return false;
        		}
        	} else {

                echo("<h2 class=page-header>Secure Login</h2>");
        		
        		echo("<p class='lead'>Before you can access the secure side of this site you must first login using you Username and Password.</p>");
        	
        		$Errors = array($UsernameError,$PasswordError);
        		
        		Forms::generateerrors("Correct the following errors before you can continue.",$Errors,false);
        		
        		Users::loginform();
        		return false;
        	}	
        }
        
        static public function logincheck($UserLevel)
        {
        	//Get Data
        	if($_SESSION["username"] && $_SESSION["password"]){
        		$Username = $_SESSION["username"];
        		$Password = $_SESSION["password"];
        		$UID = $_SESSION["userid"];	
        		$Submit = true;
        	} else {
        		$Username = $_POST["username"];
                $Password = $_POST["password"];

                $salt = SALT;
                $salt .= $Password;
                $Password = $salt;
                //encrypt the password
                 $Password = md5($Password);
        	}	
        
        	//Check Username and Password
        	$RQ = new ReadQuery("SELECT IDLNK FROM Users Where Username = '" . $Username . "' AND Password = '" . $Password . "' AND Deleted = 0;");

            //echo($RQ->getquery());

        	if($RQ->getnumberofresults() > 0)
        	{
        	
                //Updated by JNH to new MYSQLI_ASSOC           
                 
                $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);

        		$User = new Users($row["IDLNK"]);
        		
        		if($User->getuserlevel() >= $UserLevel){
    			     //Login	
    			     return $row["IDLNK"];
    		    }
            } 
        	
        		//Not Found
        		return 0;
        }
        
        static private function loginform()
        {	
        	$UsernameField = array("Username","Text","username",30,0,'','Enter your username.');
        	$PasswordField = array("Password","Password","password",30,0,'','Enter your password.');
        	
        	$Fields = array($UsernameField,$PasswordField);
        	
        	$Button = "Login";
        	
        	$Page =  substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
        	
        	Forms::generateform("LoginForm",$Page,"return checkloginform(this)",false,$Fields,$Button,$Errors);
        	
        	print("<h4><a href=\"forgottenpassword.php\">Forgotten Password</a></h4>");
        	
        	print("<p>If you require access to this site please contact <a href=\"mailton:" . DEFAULTEMAIL . "\">" . DEFAULTEMAIL . "</a> requesting access.</p>");
        }

        
        static public function changepassword(){
        	$Submit = $_POST["submit"];
        	$OldPassword = $_POST["old"];

            //Sprinkle some salt and encrypt for old password entered
            $salt = SALT ;
            //Append old password entered onto salt
            $salt .= $OldPassword;
            //Update OldPassword variable to combined salt and password
            $OldPassword = $salt;
            //Encrypt Oldpassword for checking against current held password
            $OldPassword = md5($OldPassword);



        	$NewPassword = $_POST["password"];
            //Sprinkle some salt and encrypt for new password entered
            $salt = SALT;
            //append new password to salt variable
            $salt .= $NewPassword;
            //Update NewPassword to comboned salt plus password
            $NewPassword = $salt;
            //Encrypt combined password 
            $NewPassword = md5($NewPassword);

        	
        	$OldError = array("oldpassworderror","Please enter your current password.");
        	$NewError = array("newpassworderror","Please enter your new password.");
        	$New1Error = array("new1passworderror","Please re-enter your new password.");
        	$MatchError = array("passwordmatcherror","Your new passwords do not match.");
        	$DefaultError = array("defaulterror","Your current password does not match the system.");
        	
        	if($Submit && $OldPassword && $NewPassword){
        		//Change
        		$User = new Users($_SESSION["userid"]);
        		
        		if($User->getpassword() == $OldPassword){
        			//Change Now
        			$User->setpassword($NewPassword);
        			$User->save();
        			$_SESSION["password"] = $User->getpassword();
        			echo("<p>Your password has been succesfully changed. The next time you log into the system you will be required to use your new password.</p><p>Return to the <a href=\"welcome.php\">Homepage</a>.</p>");
        		} else {
        			echo("<p>To change your password complete the form below and click the change password button.</p>");
        			
        			$Errors = array($DefaultError,$OldError,$NewError,$New1Error,$MatchError);
        		
        			Forms::generateerrors("Correct the following errors before you can continue.",$Errors,true);
        			
        			Users::changepasswordform();
        		}
        		
        	} else {
        		//Change Form
        		echo("<p>To change your password complete the form below and click the change password button.</p>");
        		
        		$Errors = array($OldError,$NewError,$New1Error,$MatchError);
        		
        		Forms::generateerrors("Correct the following errors before you can continue.",$Errors,false);

        		
        		Users::changepasswordform();
        	}
        }
        
        static private function changepasswordform(){
        	$OldPasswordField = array("Current Password","Password","old",30,0);
        	$NewPasswordField = array("New Password","Password","password",30,0);
        	$NewPassword2Field = array("Repeat New Password","Password","password2",30,0);
        	
        	$Fields = array($OldPasswordField,$NewPasswordField,$NewPassword2Field);
        	
        	$Button = "Change Password";
        	
        	Forms::generateform("changepasswordform","changepassword.php","return checkchangepasswordform(this)",false,$Fields,$Button);

        }
        
        static public function resetpassword($UID){
        	print("<h2 class='page-header'>Reset Password</h2>");
        	
        	$User = new Users($UID);
        	
        	//echo($User->getemail());
        	
        	$NewPassword = Users::generatepassword();
        	
        	$User->setpassword($NewPassword);
        	
        	$User->save();
        	
        	//$msg = "<h1>Reset Password</h1><p>You password for " . URL . " has been reset by the administrator. Your new user login details are show below.</p><br/><dl><dt>Username:</dt><dd>" . $User->getusername() . "</dd><dt>Password:</dt><dd>" . $User->getpassword() . "</dd></dl><br/>";
        	

            Emails::reset($User->getemail(),SITENAME . " Website Account",$User->getusername(), $User->getpassword(), URL);

        	//Emails::sendemail($User->getemail(),SITENAME . " Account",$msg);
        	
        	print("<p>The Users password has been succesfully reset and sent to them via email.</p>");
        	
        	print("<p><a href=\"users.php\">Return to User Admin</a></p>");

            //Now that the user has been told the current password lets grab the plain text passsword and salt and encrypt
            // and add to database    

            $salt = SALT;

            $NewPassword = $User->getpassword();

            $salt .= $NewPassword;

            $NewPassword = md5($salt);

            $User->setpassword($NewPassword);


        }
        
        static public function forgottenpassword(){
        	print("<h2 class='page-header'>Forgotten Password</h2>");
        
        	$Submit = $_POST["submit"];
        	$Email = $_POST["email"];
        	
        	$EmailError = array("emailerror","Please enter a email address");
        	$AddressErrors = array("addresserror","Please enter a valid email address");
        	$DefaultError = array("defaulterror","This email address is not registered on the system.");
        	
        	if($Submit && $Email){
        		//Send Out Reminder
        		if(!Users::emailnotregistered($Email)){
        			$UID = Users::finduser($Email);
        			$User = new Users($UID);
        			
        			$msg = "<h1>Account Details</h1><p>You can log into the website (" . URL . ") using your details below.</p><br/><dl><dt>Username:</dt><dd>" . $User->getusername() . "</dd><dt>Password:</dt><dd>" . $User->getpassword() . "</dd></dl><br/>";
					
					Emails::sendemail($Email,SITENAME . " Account",$msg);
        			
        			echo("<p class='lead'>You login details have been sent to your email address. Please check your email now, althought it may take upto 5 minutes for the details to come through.</p><p>Return to the <a href=\"welcome.php\">login page</a>.</p>");
        		} else {
        			//Not Registered
        			echo("<p class='lead'>If you have forgotten your password or username then please enter your email address below and your user details will be sent to your email address.</p>");
        			
        			$Errors = array($DefaultError,$EmailError,$AddressErrors);
        			
        			Forms::generateerrors("The following errors occured during this procedure.",$Errors,true);
        			
               		Users::forgottenpasswordform();
        		}
        	} else {
        		//Form
        		echo("<p>If you have forgotten your password or username then please enter your email address below and your user details will be sent to your email address.</p>");
        	
        		$Errors = array($EmailError,$AddressErrors);
        		
        		Forms::generateerrors("Correct the following error before you can continue.",$Errors,false);

        		Users::forgottenpasswordform();
        	}
        }
        
        static private function forgottenpasswordform(){
        	$EmailAddressField = array("Email Address:","Text","email",30,0);
        	
        	$Fields = array($EmailAddressField);
        	
        	$Button = "Forgotten Password";
        	
        	Forms::generateform("fogottenpasswordform","forgottenpassword.php","return checkforgottenpasswordform(this)",false,$Fields,$Button);
        }
        
        static public function logout(){
        	session_destroy();
        	
        }
        
        static public function deleteuser($UID){
        	$User = new Users($UID);
        	
        	$User->setdeleted(1);
        	
        	$User->save();
        }     
        
        static public function generatepassword()
        {
        	// start with a blank password
 			$password = "";

  			// define possible characters
  			$possible = "123456789bcdfghjklmnpqrstvwxyz"; 
    
  			// set up a counter
  			$i = 0; 
  			$length = 8;
    
  			// add random characters to $password until $length is reached
 			while ($i < $length) { 

    			// pick a random character from the possible ones
   				 $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    			// we don't want this character if it's already in the password
    			if (!strstr($password, $char)) { 
     				$password .= $char;
      				$i++;
 			   }

 			}

  			// done!
  			return $password;
        	
        }
         static public function encryptpass()
        {
            //Admin Function to update plain text passwords to new Salted Encrypted Version. Only run once.
            
            print("<h2>User List Encrypt Password Function</h2>");
                
            print("<p>The list below shows all the system users with the new secure encrypted password update.</p>");
            
           
                
            $RQ = new ReadQuery("SELECT * FROM Users ORDER BY Surname, Firstname");
            
           // Setyo Column heading variables for table construction

            $Col1 = array("Firstname","username",1);
            $Col2 = array("Surname","fullname",1);
           
            $Col3 = array("Salted Password","salt",1);
           
            $Cols = array($Col1,$Col2,$Col3,$Col4);
            $Rows = array();
            $RowCounter = 0;
            
    
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                
                //Sets variables for each effective <td> for table constuction class
                $Row1 = array($row['Firstname']," ");
                $Row2 = array($row['Surname']);

                $Password =  $row['Password'];
                // Grabs salt string from config 
                $salt = SALT;
                //Appends current password to salt
                $salt .= $Password;
                //Updates Password to combined salt and password
                $Password = $salt;
                //encrypt the password
                 $Password = md5($Password);
                 //Updates row3 to new salted encrupted password

                 $Row3 = array($Password);
                // Write Query Updates the Database with newly encrypted password.    
                $WQ = new WriteQuery("UPDATE Users SET Password = '".$Password . "' WHERE IDLNK =".$row['IDLNK']);
               

                //merges the table data into an array for all data
                  $Rows[$RowCounter] = array($Row1,$Row2,$Row3);
                //Iterates through each row to grab next line.
                $RowCounter ++;






            }
           //Use table class to generate table from while loop

            Tables::generateadmintable("adminusertable",$Cols,$Rows);
           
        
        }

        public static function generatearray()
        {
            $RQ = new ReadQuery("SELECT IDLNK, Firstname, Surname From Users WHERE Deleted = 0 ORDER BY Surname;");
            
            //echo($RQ->getquery());
            
            $ReturnArray = array();
            
            $Counter = 0;
            
            while($row = $RQ->getresults()->fetch_array(MYSQLI_BOTH)){
                //echo($row[1]);
                $ReturnArray[$Counter] = array($row[0],$row[1] . " " . $row[2]);
                $Counter ++;
            }
            
            return $ReturnArray;
            
        }

        public static function gettotal()
        {
            $RQ = new ReadQuery("SELECT Count(*) FROM Users WHERE Deleted = 0;");
            
            $row = $RQ->getresults()->fetch_array(MYSQLI_BOTH);
            
            return $row[0];
        }
        
        
    }

?>

