<?php 
	
    class Tables
    {
    
        //Forms Class
        
        //Field Array
        
        //[Description, Type, Name, Cols, Rows, Value]
        
        static public function generateadmintable($ID,$Cols,$Rows)
        {
            print("<table class=\"sorted_table admintable table table-hover\" id=\"" . $ID . "\">\n");
            print("<tbody>");
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
                print("</tbody>\n");
            print("</table>\n");
        }

        static public function generateadminsorttable($ID, $Cols, $Rows)
        {
            ?>
<ul id="sortable">
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 4</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 5</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 6</li>
  <li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 7</li>
</ul>
        <?
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
