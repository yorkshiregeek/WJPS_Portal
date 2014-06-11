<?php

    class MetaData
    {
        
        static public function GoogleAnalytics()
        {
       
        	print("<script type=\"text/javascript\">");
        	
        	print("var _gaq = _gaq || [];");
        	print("_gaq.push(['_setAccount', 'UA-1706096-13']);");
        	print("_gaq.push(['_trackPageview']);");
        	
        	print("(function() {
        	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        	  })();");
        	
        	print("</script>");
        
        	
        }
    }

?>