<?php 
	
    class Tables
    {
    
        //Forms Class
        
        //Field Array
        
        //[Description, Type, Name, Cols, Rows, Value]
        
        static public function generateadmintable($ID,$Cols,$Rows)
        {
            print("<table class=\"admintable\" id=\"" . $ID . "\">\n");
                print("<tr>\n");
                foreach($Cols as $Col)
                {
                    print("<th class=\"" . $Col[1] . "\" colspan=\"" . $Col[2] . "\">" . $Col[0] . "</th>\n");
                }
                print("</tr>\n");
                foreach($Rows as $Row)
                {
                    print("<tr>\n");
                    foreach($Row as $Item)
                    {
                        if($Item[1])
                        {
                            $Class = " class = \"" . $Item[1] . "\" ";
                        }
                        print("<td" .  $Class . ">" . $Item[0] . "</td>\n");
                    }
                    print("</tr>\n");
                }
            print("</table>\n");
        }
        
        static public function generateemailtable($ID,$Rows)
        {
            $returnstr = "";
            $returnstr .= "<table class=\"emailtable\" id=\"" . $ID . "\">";
                foreach($Rows as $Row)
                {
                    $returnstr .= "<tr>";
                    foreach($Row as $Item)
                    {
                        if($Item[1])
                        {
                            $Class = " class = \"" . $Item[1] . "\" ";
                        }
                        $returnstr .= "<td" .  $Class . ">" . $Item[0] . "</td>";
                    }
                    $returnstr .= "</tr>";
                }
            $returnstr .= "</table>";
            
            return $returnstr;
        }
    
    }

?>
