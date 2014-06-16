<?php 
	
    class Menu
    {
        static public function generatemenu($Page)
        {
            if($Page == "home"){ $Home = " class=\"selected\""; }
            if($Page == "links"){ $Links = " class=\"selected\""; }
            if($Page == "login"){ $Login = " class=\"selected\"";} 
            if($Page == "manu"){ $Manu = " class=\"selected\""; }
            
           	print("<div id=\"menu\">");
    		
    			print("<hr/>");
    			print("<h2>Menu</h2>");
    			
    			print("<ul class = \"nav nav-pills nav-stacked\">");
    				print("<li " . $Home . "><a href=\"index.php\">Welcome</a></li>");
    				print("<li " . $Links . "><a href=\"links.php\">Links</a></li>");
    				print("<li " . $Login . "><a href=\"welcome.php\">Login</a></li>");
    			print("</ul>");
    		
    		print("</div>");
        }
        
        static public function generateusermenu($Page)
        {
        	if($Page == "welcome"){ $Welcome = " class=\"selected\""; }
            if($Page == "logout"){ $Login = " class=\"selected\"";} 
            if($Page == "changepassword"){ $Change = " class=\"selected\"";} 
            if($Page == "notices") {$Notices = " class=\"selected\"";}
            if($Page == "documents") {$Docs = " class=\"selected\"";}
            if($Page == "directory") {$Dir = " class=\"selected\"";}
            if($Page == "events") { $Events = " class=\"selected\"";}
            if($Page == "home"){ $Home = " class=\"selected\""; }
            if($Page == "links"){ $Links = " class=\"selected\""; }
            if($Page == "login"){ $Login = " class=\"selected\"";} 
            if($Page == "manu"){ $Manu = " class=\"selected\""; }
            
           	print("<div id=\"menu\">");
           	
           		print("<hr/>");
    			print("<h2>Menu</h2>");
    			
    			print("<ul class = \"nav nav-pills nav-stacked\">");
    				print("<li " . $Home . "><a href=\"index.php\">Welcome</a></li>");
    				print("<li " . $Links . "><a href=\"links.php\">Links</a></li>");
    				print("<li " . $Logout . "><a href=\"logout.php\">Logout</a></li>");
    				print("<li " . $Change . "><a href=\"changepassword.php\">Change Password</a></li>");
    			print("</ul>");
    			
    			print("<h2>User Menu1</h2>");
    			
    			print("<ul class = \"nav nav-pills nav-stacked\">");
    				print("<li " . $Docs . "><a href=\"documents.php\">Documents</a></li>");
    				print("<li " . $Dir . "><a href=\"directory.php\">Directory</a></li>");
    				print("<li " . $Notices . "><a href=\"notices.php\">Notices</a></li>");
    				print("<li " . $Events . "><a href=\"events.php\">Events</a></li>");
    			print("</ul>");
    		
    		print("</div>");
        
        }
        
        static public function generateadminmenu($Page)
        {
        	if($Page == "home"){ $Welcome = " class=\"selected\""; }
            if($Page == "logout"){ $Login = " class=\"selected\"";}
            if($Page == "changepassword"){ $Change = " class=\"selected\"";}  
            if($Page == "users"){ $Users = " class=\"selected\"";}
            if($Page == "linkm"){$LinkM = " class=\"selected\"";}
            if($Page == "notices") {$Notices = " class=\"selected\"";}
            if($Page == "documents") {$Docs = " class=\"selected\"";}
            if($Page == "directory") {$Dir = " class=\"selected\"";}
            if($Page == "eventsm") {$EventsM = " class=\"selected\"";}
            if($Page == "manu"){ $Manu = " class=\"selected\""; }
            if($Page == "manum"){ $ManuM = " class=\"selected\""; }
            
           	print("<div id=\"menu\">");
    		
   				print("<hr/>");
    			print("<h2>Menu</h2>");
    			
    			print("<ul class = \"nav nav-pills nav-stacked\">>");
    				print("<li " . $Welcome . "><a href=\"welcome.php\">Welcome</a></li>");
    				print("<li " . $Links . "><a href=\"links.php\">Links</a></li>");
    				print("<li " . $Logout . "><a href=\"logout.php\">Logout</a></li>");
    				print("<li " . $Change . "><a href=\"changepassword.php\">Change Password</a></li>");
    			print("</ul>");
    			
    			print("<h2>Admin</h2>");
    			
    			print("<ul class = \"nav nav-pills nav-stacked\">>");
    				print("<li " . $Users . "><a href=\"users.php\">User Admin</a></li>");
    				print("<li " . $Docs . "><a href=\"documents.php\">Documents</a></li>");
    				print("<li " . $Dir . "><a href=\"directory.php\">Directory</a></li>");
    				print("<li " . $LinkM . "><a href=\"links.php?man=1\">Link Admin</a></li>");
    				print("<li " . $Notices . "><a href=\"notices.php\">Notices</a></li>");
    				
    				print("<li " . $EventsM . "><a href=\"events.php?man=1\">Events</a></li>");
    			print("</ul>");
    			
    			
    		
    		print("</div>");

        }
        
       
               
    }

?>
