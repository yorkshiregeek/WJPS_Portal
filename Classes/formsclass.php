<?php 
	
    class Forms
    {
    
        //Forms Class
        
        //Field Array
        
        //[Description, Type, Name, Cols, Rows, Value]
        
        static public function generateerrors($ErrorTitle,$Errors,$ShowDefault)
        {
        	if($ShowDefault)
        	{
        		//Show By Default
        		print("<div id=\"errorsshow\">");
        	} else {
        		print("<div id=\"errors\">");
        	}
        	
            	print("<p class=\"title\">$ErrorTitle</p>");
            	print("<ul>");
            	foreach($Errors as $Error)
            	{
            		if($Error[0] == "defaulterror")
            		{
            			print("<li id=\"defaulterror\">" . $Error[1] . "</li>");
            		} else {
            			print("<li id=\"" . $Error[0] . "\">" . $Error[1] . "</li>");
            		}
            	}
            	print("</ul>");
            print("</div>");
        }
        
        static public function generateform($FormName, $Action, $OnSubmit, $Enc, $Fields, $Button)
        {
            if($OnSubmit){$OnSubmit = " onsubmit=\"" . $OnSubmit . "\"";}
            if($Enc){$Enc = " enctype=\"multipart/form-data\"";}
            
            print("<form class=\"adminform\" name=\"" . $FormName . "\" id=\"" . $FormName . "\" method=\"post\" action=\"" . $Action . "\"" . $OnSubmit . $Enc . ">");
                print("<dl>");
                    foreach($Fields as $Field)
                    {
                        if($Field[1] != "Hidden")
                        {
                            print("<dt id=\"" . $Field[2] . "Title\">" . $Field[0] . "</dt>");
                        }
                        forms::generatefield($Field);
                    }
                print("</dl>");
                if($Button){
                    print("<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"" . $Button . "\"/>");
                }                 
            print("</form>");
        }
        
        static public function generateformmini($FormName, $Action, $OnSubmit,$Enc, $Fields, $Button)
        {
            if($OnSubmit){$OnSubmit = " onsubmit=\"" . $OnSubmit . "\"";}
            if($Enc){$Enc = " enctype=\"multipart/form-data\"";}
            print("<form class=\"adminformmini\" name=\"" . $FormName . "\" id=\"" . $FormName . "\" method=\"post\" action=\"" . $Action . "\"" . $OnSubmit . $Enc . ">");
                print("<dl>");
                    foreach($Fields as $Field)
                    {
                        print("<dt id=\"" . $Field[2] . "Title\">" . $Field[0] . "</dt>");
                        forms::generatefield($Field);
                    }
                print("</dl>");
                if($Button){
                    if($Button[2]){
                        $Class= " class=\"" . $Button[2] . "\"";
                    }
                    print("<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"" . $Button . "\"/>");
                }
            print("</form>");
        }
        
        static private function generatefield($Field){
            $Description = $Field[0];
            $Type = $Field[1];
            $Name = $Field[2];
            $Cols = $Field[3];
            $Rows = $Field[4];
            $Value = $Field[5];
            $Options = $Field[6];
            $Action = $Field[7];
            $ReadOnly = $Field[8];
            $Class= $Field[9];
            $RowHeaders = $Field[10];
            $ColumnHeaders = $Field[11];
            
            if($ReadOnly){ 
                $ReadOnly = " readonly = \"readonly\" "; 
                $Disabled = " disabled = \"disabled\" "; 
            }
            
            if($Type == "Text")
            {
                //Text Box
                print("<dd id=\"" . $Name . "Field\"><input type=\"text\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"" . $Cols . "\" value=\"" . $Value . "\"" . $ReadOnly . "/></dd>");
            } elseif($Type == "DynamicText") {
                //Dynamic Text Box
                print("<dd id=\"" . $Name . "Field\"><input type=\"text\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"" . $Cols . "\" value=\"" . $Value . "\" onchange=\"" . $Action . "\"/><span id=\"" . $Name . "Image\"></span></dd>");
            } elseif($Type == "DatePicker"){
                //Date Picker
                $dp = new datepicker();
                
                if(strlen($Value) == 10){
                    //Useable Date
                    $Day = substr($Value,0,2);
                    $Month = substr($Value,3,2);
                    $Year = substr($Value,6,4);
                    $unix_timestamp = mktime(0,0,0, $Month, $Day , $Year );
                    $dp->preselectedDate = $unix_timestamp;
                    $ControlName = $dp->show($Name,$Month,$Year);
                } else {
                    $ControlName = $dp->show($Name);
                }
                //print("<dd id=\"" . $Name . "Field\"><input type=\"text\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"10\" value=\"" . $Value . "\"" . $ReadOnly . "/><input type=\"button\" value=\"...\" onclick=\"" . $ControlName . "\"></dd>");
                print("<dd id=\"" . $Name . "Field\"><input type=\"text\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"10\" value=\"" . $Value . "\"" . $ReadOnly . "/> <input class=\"calendarbutton\" type=\"image\" src=\"../Images/Pres/Calendar.gif\" onclick=\"" . $ControlName . "\" height=\"16\"/></dd>");
            } elseif($Type == "Password") {
                //Password Text Box
                print("<dd id=\"" . $Name . "Field\"><input type=\"password\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"" . $Cols . "\" value=\"" . $Value . "\"/></dd>");            
            } elseif($Type == "Hidden") {
                //Hidden Field
                print("<input type=\"hidden\" name=\"" . $Name . "\" id=\"" . $Name . "\" value=\"" . $Value . "\"\>");
            } elseif($Type == "TextArea") {
                //Text Area
                print("<dd id=\"" . $Name . "Field\"><textarea name=\"" . $Name . "\" id=\"" . $Name . "\" cols=\"" . $Cols . "\" rows=\"" . $Rows . "\"" . $ReadOnly . ">" . $Value . "</textarea></dd>");
            } elseif($Type == "File") {
                //File Input
                print("<dd id=\"" . $Name . "Field\"><input type=\"file\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"" . $Cols . "\"/></dd>");
            } elseif($Type == "DynamicFile") {
                //File Input
                print("<dd id=\"" . $Name . "Field\"><input type=\"file\" name=\"" . $Name . "\" id=\"" . $Name . "\" size=\"" . $Cols . "\" onchange=\"" . $Action ."\"/></dd>");
            } elseif($Type == "Select") {
                //Select
                print("<dd id=\"" . $Name . "Field\" class=\"" . $Class . "\"><select name=\"" . $Name . "\" id=\"" . $Name . "\">");
                    foreach($Options as $Option)
                    {
                        if($Option[0] == $Value){
                            print("<option value=\"" . $Option[0] . "\" selected=selected>" . $Option[1] . "</option>");
                        } else {
                            print("<option value=\"" . $Option[0] . "\">" . $Option[1] . "</option>");
                        }
                    }
                print("</select></dd>");
            } elseif($Type == "Checkbox") {
                //Checkbox
                if($Action)
                {
                    $OnChange = "onclick=\"" . $Action . "\"";
                } else {
                    $OnChange = "";
                }
                if($Value == $Options)
                {
                    //Checked
                    print("<dd id=\"" . $Name . "Field\"><input type=\"checkbox\" name=\"" . $Name . "\" value=\"" . $Options . "\" checked=\"checked\" " . $OnChange . "/></dd>");
                } else {
                    //Unchecked
                    print("<dd id=\"" . $Name . "Field\"><input type=\"checkbox\" name=\"" . $Name . "\" value=\"" . $Options . "\" " . $OnChange . "/></dd>");
                }
            } elseif($Type == "CheckboxArray") {
                //Checkbox Array
                print("<dd id=\"" . $Name . "Field\">");
                    print("<table id=\"" . $Name  . "Table\" class=\"checkboxtable\">");
                        $ColCounter = 1;
                        $CheckCounter = 1;
                        foreach($Options as $Option)
                        {
                            //if($ColCounter == 1)
                            //{
                                //New Row
                                print("<tr>");
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                                }
                            //} elseif($ColCounter == 4) {
                            //    if(Forms::checkedoption($Option[0],$Value))
                            //    {
                            //        print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                            //    } else {
                            //        print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                            //    }
                                print("</tr>");
                           //     $ColCounter = 0;
                            //} else {
                            //    if(Forms::checkedoption($Option[0],$Value))
                            //    {
                            //        print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                              //  } else {
                                //    print("<td>" . $Option[1] . ":</td><td><input type=\"checkbox\" name=\"" . $Name . $CheckCounter . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                                //}
                            //}
                            $ColCounter ++;
                            $CheckCounter ++;
                        }
                    print("</table>");
                print("</dd>");
            } elseif($Type == "OptionsArray") {
                //Options Array
                print("<dd id=\"" . $Name . "Field\">");
                    print("<table id=\"" . $Name  . "Table\" class=\"checkboxtable\">");
                        $ColCounter = 1;
                        $CheckCounter = 1;
                        foreach($Options as $Option)
                        {
                            if($ColCounter == 1)
                            {
                                //New Row
                                print("<tr>");
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name  . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                                }
                            } elseif($ColCounter == 3) {
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                                }
                                print("</tr>");
                                $ColCounter = 0;
                            } else {
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name . "\" value =\"" . $Option[0] . "\" checked=\"checked\"" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type=\"radio\" name=\"" . $Name . "\" value =\"" . $Option[0] . "\"" . $Disabled . "/></td>");
                                }
                            }
                            $ColCounter ++;
                            $CheckCounter ++;
                        }
                    print("</table>");
                print("</dd>");
            } elseif($Type == "Static"){
                if($Options){
                    $Class = " class=\"" . $Options . "\"";
                }
                print("<dd id=\"" . $Name . "Field\"" . $Class . ">" . $Value . "</dd>");
            } elseif($Type == "DynamicSelect") {
                print("<dd id=\"" . $Name . "Field\"><select name=\"" . $Name . "\" id=\"" . $Name . "\" onchange=\"" . $Action . "\">");
                foreach($Options as $Option)
                {
                    if($Option[0] == $Value){
                        print("<option value=\"" . $Option[0] . "\" selected=selected>" . $Option[1] . "</option>");
                    } else {
                        print("<option value=\"" . $Option[0] . "\">" . $Option[1] . "</option>");
                    }
                }
                print("</select></dd>");
            } elseif($Type == "RadioButtons") {
                print("<dd id=\"" . $Name . "Field\">");
                    foreach($Options as $Option)
                    {
                        if($Option[0] == $Value){
                            print($Option[1] . "<input type=\"radio\" name=\"" . $Name . "\" value=\"" . $Option[0] . "\" checked/>");
                        } else {
                            print($Option[1] . "<input type=\"radio\" name=\"" . $Name . "\" value=\"" . $Option[0] . "\"/>");
                        }
                    }
                print("</dd>");
            }
        }
        
        static private function checkedoption($Search,$Values)
        {
            $Found = false;
            if($Values != ""){
                foreach($Values as $Value)
                {
                    if($Value == $Search){
                        $Found = true;
                    }
                }
                return $Found;
            }
        }
        
        //static private function checkedoptions($Search,$Values)
        //{
        //	$Found = false;
        //	
        //}
    
    }

?>
