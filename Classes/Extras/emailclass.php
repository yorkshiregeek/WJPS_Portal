<?php 
	
    class Emails
    {
        
        static public function sendemail($To, $Subject, $Content)
        {
        	$headers  = "MIME-Version: 1.0" . "\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1" . "\n";
            $headers .= "From: " .  NOREPLYEMAIL . "\n";

            $Cont = "<html>";
            $Cont .= "<head>";
            $Cont .= "<title>" . SITENAME . "</title>";
             $Cont .= "<style type=\"text/css\">body{text-align:centre;border:0;padding:10px;margin:0;font-family:Arial, Helvetica;} h1{border:0;padding:0;margin:0;font-size:22px;color:#000000;}h2{border:0;padding:0;margin:0;font-size:14px;color:#08ae42;}p{border:0;padding:5px 0px 5px 0px;margin:0;color:#000000;font-size:12px;line-height:14px;}hr{height: 4px;border: 0px;background:#08ae42;}ul{color:#000000;font-size:12px;line-height:14px;font-family:verdana;}dl{font-size: 12px;}dl dt{color:#08ae42;font-weight: bold;}dl dd{position: relative;left: 60px;}</style>";
            $Cont .= "</head>";
            $Cont .= "<body>";
            $Cont .= "<p><img src=\"" . URL . LOGO . "\" alt=\"" . SITENAME . " Logo\"/></p><br/>";
            $Cont .= $Content . "<br/>";
            $Cont .= "<p>" . SITENAME . "<br/>Website: <a href=\"" . URL . "\">" . URL . "</a><br/>Email: <a href=\"mailto:" . DEFAULTEMAIL . "\">" . DEFAULTEMAIL . "</a></p><br/><br/>";

            $Cont .= "</body>";
            $Cont .= "</html>";

            //Split the To String into an array

            $ToArray = split(',',$To);
            $EmailCounter = 0;
            $NewTo = "";

        	foreach ($ToArray as $SingleTo) {
        		
        		if ($EmailCounter == 10)
        		{
        			//Send Email
        			//mail($NewTo,$Subject,$Cont,$headers,"-f " . NOREPLYEMAIL);

        			echo("Debug - Send to " . $NewTo);
        			$EmailCounter = 0;
        			$NewTo = "";
        		}

    			//Continue to Append
    			$EmailCounter += 1;
				$NewTo .= $NewTo . "," . $SingleTo;
        		
        	}

            //Send Remainder
            //mail($NewTo,$Subject,$Cont,$headers,"-f " . NOREPLYEMAIL);
            echo("Debug - Send to " . $NewTo);
            //mail("wjamesproctor@hotmail.com",$Subject,$Cont,$headers);
		}
       
    
    }

?>
