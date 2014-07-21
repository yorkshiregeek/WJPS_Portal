<?php 
	
    class Menu
    {
        static public function generatemenu($Page)
        {
            if($Page == "home"){ $Home = " class='active'"; }
            if($Page == "links"){ $Links = " class='active'"; }
            if($Page == "login"){ $Login = " class='active'";} 
            if($Page == "manu"){ $Manu = " class='active'"; }

            ?>

            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"><? echo(SITENAME); ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li <?echo($Home);?>><a href="index.php">Home</a></li>
                        <li <?echo($Links);?>><a href="links.php">Links</a></li>
                      </ul>
              
                      <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" role="search" action="welcome.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" id="username" name="username">
                                <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                            </div>
                            <button type="submit" class="btn btn-default" name="submit" id="submit" value="Login">Login</button>
                        </form>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <?
        }
        
        static public function generateusermenu($Page)
        {
        	if($Page == "home"){ $Welcome = " class='selected'"; }
            if($Page == "logout"){ $Login = " class='selected'";}
            if($Page == "changepassword"){ $Change = " class='selected'";}  
            if($Page == "users"){ $Users = " class='selected'";}
            if($Page == "linkm"){$LinkM = " class='selected'";}
            if($Page == "notices") {$Notices = " class='selected'";}
            if($Page == "documents") {$Docs = " class='selected'";}
            if($Page == "directory") {$Dir = " class='selected'";}
            if($Page == "eventsm") {$EventsM = " class='selected'";}
            if($Page == "manu"){ $Manu = " class='selected'"; }
            if($Page == "manum"){ $ManuM = " class='selected'"; }

            if(ISSET($_SESSION["userid"])){
                $UID = $_SESSION["userid"];
            }

            ?>

            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"><? echo(SITENAME); ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li <?echo($Home);?>><a href="index.php">Home</a></li>
                        <li <?echo($Links);?>><a href="links.php">Links</a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Secure Area<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="documents.php">Documents</a></li>
                                <li><a href="directory.php">Directory</a></li>
                                <li><a href="messages.php">Messages</a></li>
                                <li><a href="linkm.php">Link Admin</a></li>
                                <li><a href="notices.php">Notices</a></li>
                                <li><a href="events.php">Events</a></li>
                            </ul>
                        </li>
                      </ul>
              
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <? $User = new Users($UID); print($User->getusername()); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="welcome.php">Welcome Page</a></li>
                                <li><a href="changepassword.php">Change Password</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <?
        
        }
        
        static public function generateadminmenu($Page,$UID = 0)
        {
        	
            if(ISSET($_SESSION["userid"])){
                $UID = $_SESSION["userid"];
            }

            ?>

            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="#"><? echo(SITENAME); ?></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li <?echo($Home);?>><a href="index.php">Home</a></li>
                        <li <?echo($Links);?>><a href="links.php">Links</a></li>
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Secure Area<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="users.php">User Admin</a></li>
                                <li><a href="usergroups.php">User Group Admin</a></li>
                                <li><a href="documents.php">Documents</a></li>
                                <li><a href="directory.php">Directory</a></li>
                                <li><a href="messages.php">Messages</a></li>
                                <li><a href="linkm.php">Link Admin</a></li>
                                <li><a href="notices.php">Notices</a></li>
                                <li><a href="events.php">Events</a></li>
                            </ul>
                        </li>
                      </ul>
              
                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <? $User = new Users($UID); print($User->getusername()); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="welcome.php">Welcome Page</a></li>
                                <li><a href="changepassword.php">Change Password</a></li>
                                <li><a href="logout.php">Log Out</a></li>
                            </ul>
                        </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <?
        }
        
       
               
    }

?>
