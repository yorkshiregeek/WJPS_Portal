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
        		print("<div id='errorsshow' class='alert alert-danger'>");
        	} else {
        		print("<div id='errors' class='alert alert-danger'>");
        	}
        	
            	print("<p class='title'>$ErrorTitle</p>");
            	print("<ul>");
            	foreach($Errors as $Error)
            	{
            		if($Error[0] == "defaulterror")
            		{
            			print("<li id='defaulterror'>" . $Error[1] . "</li>");
            		} else {
            			print("<li id='" . $Error[0] . "'>" . $Error[1] . "</li>");
            		}
            	}
            	print("</ul>");
            print("</div>");
        }
        
        static public function generateform($FormName, $Action, $OnSubmit, $Enc, $Fields, $Button)
        {
            if($OnSubmit){$OnSubmit = " onsubmit='" . $OnSubmit . "'";}
            if($Enc){$Enc = " enctype='multipart/form-data'";}
            
            print("<form class='form-horizontal' class='form-group' role='form' name='" . $FormName . "' id='" . $FormName . "' method='post' action='" . $Action . "'" . $OnSubmit . $Enc . ">");
                //print("<dl>");
                    foreach($Fields as $Field)
                    {
                        if($Field[1] != "Hidden")
                        {

                             print("<div class='form-group'>");
                               
                                    print("<div class='col-sm-8'>");
                                     print("<label for='" . $Field[2] . "' class='control-label'>" . $Field[0] .  "</label>");
                        }
                                        forms::generatefield($Field);

                        if($Field[1] != "Hidden"){
                                    print("</div>");
                                print("</div>");

                        }
                    }
                //print("</dl>");
                if($Button){
                    print("<div class='form-group '>");
                        print("<div class='col-sm-offset-2 col-sm-8'>");
                        print("<input type='submit' class='btn btn-default' id='submit' name='submit' value='" . $Button . "'/>&nbsp;");
                        print("<a href='?'><input type='button' class='btn btn-default' id='cancel' name='cancel' value='Cancel'/></a>");
                        print("</div>");
                    print("</div>");
                }               
            print("</form>");
        }
        
        static public function generateformmini($FormName, $Action, $OnSubmit,$Enc, $Fields, $Button)
        {
            if($OnSubmit){$OnSubmit = " onsubmit='" . $OnSubmit . "'";}
            if($Enc){$Enc = " enctype='multipart/form-data'";}
            print("<form class='form-group' name='" . $FormName . "' id='" . $FormName . "' method='post' action='" . $Action . "'" . $OnSubmit . $Enc . ">");
                print("<dl>");
                    foreach($Fields as $Field)
                    {
                        print("<dt class='form-control' id='" . $Field[2] . "Title'>" . $Field[0] . "</dt>");
                        forms::generatefield($Field);
                    }
                print("</dl>");
                if($Button){
                    if($Button[2]){
                        $Class= " class='" . $Button[2] . "'";
                    }
                    print("<div class='form-group'>");
                    print("<input class='form-control' type='submit' id='submit' name='submit' value='" . $Button . "'/>");
                }   print("</div>");
            print("</form>");
        }
        
        static private function generatefield($Field){
            $Description = $Field[0];
            $Type = $Field[1];
            $Name = $Field[2];
            $Cols = $Field[3];
            $Rows = $Field[4];
            $Value = $Field[5];
            $EntryText = $Field[6];
            $Options = $Field[7];
            $Action = $Field[8];
            $ReadOnly = $Field[9];
            $Class= $Field[10];
            $RowHeaders = $Field[11];
            $ColumnHeaders = $Field[12];
            
            if($ReadOnly){ 
                $ReadOnly = " readonly = 'readonly' "; 
                $Disabled = " disabled = 'disabled' "; 
            }
            
            if($Type == "Text")
            {
                //Text Box
                print("<input class='form-control' placeholder = '" . $EntryText ."' type='text' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "' value='" . $Value . "'" . $ReadOnly . "/>");
            } elseif($Type == "DynamicText") {
                //Dynamic Text Box
                print("<textarea class='form-control' placeholder = '" . $EntryText ."' type='text' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "' value='" . $Value . "' onchange='" . $Action . "'><span id='" . $Name . "Image'></span></textarea>");
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
                //print("<dd id='" . $Name . "Field'><input type='text' name='" . $Name . "' id='" . $Name . "' size='10' value='" . $Value . "'" . $ReadOnly . "/><input type='button' value='...' onclick='" . $ControlName . "'></dd>");
                print("<input class='form-control 1' placeholder = '" . $EntryText ."' type='text' name='" . $Name . "' id='" . $Name . "' size='10' value='" . $Value . "'" . $ReadOnly . "/> <input class='calendarbutton' type='image' src='../Images/Pres/Calendar.gif' onclick='" . $ControlName . "' height='16'/>");
            } elseif($Type == "Password") {
                //Password Text Box
                print("<input class='form-control' placeholder = '" . $EntryText ."' type='password' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "' value='" . $Value . "'/>");            
            } elseif($Type == "Hidden") {
                //Hidden Field
                print("<input class='form-control' placeholder = '" . $EntryText ."' type='hidden' name='" . $Name . "' id='" . $Name . "' value='" . $Value . "'\>");
            } elseif($Type == "TextArea") {
                //Text Area
                print("<textarea class='form-control' placeholder ='" . $EntryText . "' name='" . $Name . "' id='" . $Name . "' cols='" . $Cols . "' rows='" . $Rows . "'" . $ReadOnly . ">" . $Value . "</textarea>");
            } elseif($Type == "WYSIWYG") {
                //WYSIWYG

                ?>

                <script src="js/nicEdit.js" type="text/javascript"></script>
                <script type="text/javascript">
                    bkLib.onDomLoaded(function() {    
                        new nicEditor({iconsPath : 'js/nicEditorIcons.gif', buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('<? echo($Name); ?>');
                    });
                </script>

                <?

                print("<textarea class='form-control' placeholder ='" . $EntryText . "' name='" . $Name . "' id='" . $Name . "' cols='" . $Cols . "' rows='" . $Rows . "'" . $ReadOnly . ">" . $Value . "</textarea>");
            } elseif($Type == "File") {
                //File Input
                print("<input type='file' class='form-control' placeholder = '" . $EntryText ."' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "'/>");
            } elseif($Type == "DynamicFile") {
                //File Input
                print("<input class='form-control' placeholder = '" . $EntryText ."' type='file' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "' onchange='" . $Action ."'/>");
            } elseif($Type == "FileUpload") {

   
                 print("<span class='btn btn-default fileinput-button'>");
                    print("<i class='glyphicon glyphicon-plus'></i>");
                    print("<span>Select file</span>");
                    print("<input id='fileupload' type='file' name='files[]'>");
                print("</span>");

                print("<br/><br/>");
                 print("<div id='progress' class='progress'>");
                    print("<div class='progress-bar progress-bar-success'></div>");
                print("</div>");
  
                
                    
                print("<div id='files' class='files'></div>");
            } else if($Type == "FileURL"){

                print("<ul class='nav nav-tabs' role='tablist' id='fileuploadtabs'>");
                    print("<li class='active'><a href='#file' role='tab' data-toggle='tab'>File</a></li>");
                    print("<li><a href='#url' role='tab' data-toggle='tab'>URL</a></li>");
                print("</ul>");

                print("<div class='tab-content'>");
                    print("<div class='tab-pane active' id='file'>");
                        print("<p></p>");
                        print("<span class='btn btn-default fileinput-button' style='float:left;'>");
                            print("<i class='glyphicon glyphicon-plus'></i>");
                            print("<span>Select file</span>");
                            print("<input id='fileupload' type='file' name='files[]' multiple>");
                        print("</span>");

                        print("<br/><br/>");
                         print("<div id='progress' class='progress'>");
                            print("<div class='progress-bar progress-bar-success'></div>");
                        print("</div>");

                        print("<input class='form-control' type='hidden' name='fileurl' id='fileurl' value='" . $Value . "'\>");

                    print("</div>");
                    print("<div class='tab-pane' id='url'>");
                        print("<p></p>");
                            print("<input class='form-control' placeholder = 'Enter a URL to link to.' type='text' name='fileuploadurl' id='fileuploadurl' size='60' value='" . $Value . "'" . $ReadOnly . "/>");
                    print("</div>");
                print("</div>");


            } elseif($Type == "Select") {
                //Select
                print("<select class='form-control' placeholder = '" . $EntryText ."' name='" . $Name . "' id='" . $Name . "'>");

                    foreach($Options as $Option)
                    {
                        if($Option[0] == $Value){
                            print("<option value='" . $Option[0] . "' selected=selected>" . $Option[1] . "</option>");
                        } else {
                            print("<option value='" . $Option[0] . "'>" . $Option[1] . "</option>");
                        }
                    }
                print("</select>");
            } elseif($Type == "Checkbox") {
                //Checkbox
                if($Action)
                {
                    $OnChange = "onclick='" . $Action . "'";
                } else {
                    $OnChange = "";
                }
                if($Value == $Options)
                {
                    //Checked
                    print("<input placeholder = '" . $EntryText ."' class=' form-control checkbox' type='checkbox' name='" . $Name . "' value='" . $Options . "' checked='checked' " . $OnChange . "/>");
                } else {
                    //Unchecked
                    print("<input class='form-control checkbox' type='checkbox' name='" . $Name . "' value='" . $Options . "' " . $OnChange . "/>");
                }
            } elseif($Type == "CheckboxArray") {
                //Checkbox Array
                    print("<table id='" . $Name  . "Table' class='table'>");
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
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                            } elseif($ColCounter == 4) {
                                 if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                                print("</tr>");
                                $ColCounter = 0;
                            } else {
                                 if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                            }
                            $ColCounter ++;
                            $CheckCounter ++;
                        }
                    print("</table>");
            } elseif($Type == "CheckboxArrayCollapse") {
                //Checkbox Array

                    print("<div class='panel-group' id='accordion'>");
                        print("<div class='panel panel-default'>");
                            print("<div class='panel-heading'>");
                                print("<p class='panel-title' style='font-size:11px;'>");
                                    print("<a data-toggle='collapse' data-parent='#accordion' href='#collapseOne'>Click to view " . substr($Description,0,strlen($Description)-1) . "</a>");
                                print("</p>");
                            print("</div>");
                            print("<div id='collapseOne' class='panel-collapse collapse'>");
                                print("<div class='panel-body'>");
      
                                    print("<table id='" . $Name  . "Table' class='table'>");
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
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                                } else {
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                                }
                                            } elseif($ColCounter == 4) {
                                                 if(Forms::checkedoption($Option[0],$Value))
                                                {
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                                } else {
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                                }
                                                print("</tr>");
                                                $ColCounter = 0;
                                            } else {
                                                 if(Forms::checkedoption($Option[0],$Value))
                                                {
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                                } else {
                                                    print("<td>" . $Option[1] . ":</td><td><input class='checkbox' type='checkbox' name='" . $Name . $CheckCounter . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                                }
                                            }
                                            $ColCounter ++;
                                            $CheckCounter ++;
                                        }
                                    print("</table>");

                                print("</div>");
                            print("</div>");
                        print("</div>");
                    print("</div>");

                
            } elseif($Type == "OptionsArray") {
                //Options Array
                    print("<table id='" . $Name  . "Table' class='table'>");
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
                                    print("<td>" . $Option[1] . ":</td><td style='border: 1px solid '><input type='radio' name='" . $Name  . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type='radio' name='" . $Name . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                            } elseif($ColCounter == 3) {
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type='radio' name='" . $Name . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type='radio' name='" . $Name . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                                print("</tr>");
                                $ColCounter = 0;
                            } else {
                                if(Forms::checkedoption($Option[0],$Value))
                                {
                                    print("<td>" . $Option[1] . ":</td><td><input type='radio' name='" . $Name . "' value ='" . $Option[0] . "' checked='checked'" . $Disabled . "/></td>");
                                } else {
                                    print("<td>" . $Option[1] . ":</td><td><input type='radio' name='" . $Name . "' value ='" . $Option[0] . "'" . $Disabled . "/></td>");
                                }
                            }
                            $ColCounter ++;
                            $CheckCounter ++;
                        }
                    print("</table>");
            } elseif($Type == "Static"){
                if($Options){
                    $Class = " class='" . $Options . "'";
                }
                print($Value);
            } elseif($Type == "DynamicSelect") {
                print("<select name='" . $Name . "' id='" . $Name . "' onchange='" . $Action . "'>");
                foreach($Options as $Option)
                {
                    if($Option[0] == $Value){
                        print("<option value='" . $Option[0] . "' selected=selected>" . $Option[1] . "</option>");
                    } else {
                        print("<option value='" . $Option[0] . "'>" . $Option[1] . "</option>");
                    }
                }
                print("</select>");
            } elseif($Type == "RadioButtons") {
                foreach($Options as $Option)
                {
                    if($Option[0] == $Value){
                        print($Option[1] . "<input type='radio' name='" . $Name . "' value='" . $Option[0] . "' checked/>");
                    } else {
                        print($Option[1] . "<input type='radio' name='" . $Name . "' value='" . $Option[0] . "'/>");
                    }
                }
            } else if($Type == "Tag"){
                print("<div class='bs-example'>");
                    print("<input class='form-control' name='". $Name . "' size='" . $Cols . "' id='" . $Name . "' type='text' value='" . $Value . "' data-role='tagsinput' placeholder='" .$PlaceHolder . "' />");
                print("</div>");

                //print("<input class='form-control' placeholder='" . $EntryText . "' type='text' name='" . $Name . "' id='" . $Name . "' size='" . $Cols . "' value='" . $Value . "'" . $ReadOnly . " data-role='tagsinput' />");

            }

            print($closing);
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
        
    
    }

?>
