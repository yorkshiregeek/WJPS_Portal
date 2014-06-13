<?php

    class Templates
    {
    
    	static function PageHeader($PageTitle,$ExtraScripts){
    	
    	?>
    		<!DOCTYPE html>
            <html lang="en">
    		
    		<? Templates::MetaHeader($PageTitle,$ExtraScripts); ?>
    		       	
    	    <body>
    	    
    	     	<div id="page">
    	    
    	    		<div id="header">
    		    		<div id="logo"></div>
    		    	</div>
    		    	
    		    	<?
    	}
    	
    	static function MetaHeader($PageTitle,$ExtraScripts)
    	{
    	
    	?>
    		<head>
    		    <title> <? print(SITENAME . " :: " . $PageTitle); ?> </title>
    		    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    		    <meta name="description" content="<? print(METADESC); ?>"/>
    		    <meta name="keywords" content="<? print(METAKEYWORDS); ?>"/>
    		    <meta name="revised" content="<? print(METAREVISED); ?>"/>
    		    
    		    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
                <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    		    <script type="text/javascript" src="Script/Script.js"></script>
                 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
    		    
    		    <?
    		    
    		    	if($ExtraScripts != ""){
    		    
    		    	foreach($ExtraScripts as $Script){
    		    	
    		    		print("<script type=\"text/javascript\" src=\"" . $Script . "\"></script>\n");
    		    	
    		    	}
    		    	
    		    	}
    		    
    		    ?>
    		</head>
    	<?
    		
    	}
    	
    	static function PageFooter(){
    	?>
    		<div id="footer">
    		    		<hr/>
    		    		<ul>
    		    			<li><a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.athp.org.uk%2Findex.php&amp;charset=(detect+automatically)&amp;doctype=Inline&amp;group=0">XHTML</a> |</li>
    		    			<li><a href="http://jigsaw.w3.org/css-validator/validator?uri=http%3A%2F%2Fwww.athp.org.uk%2Fstyles.css&amp;profile=css21&amp;usermedium=all&amp;warning=1&amp;lang=en">CSS</a> |</li>
    		    			<li><a href="sitemap.xml">Sitemap</a></li>
    		    		</ul>
    		    		<p class="copyright"><? print(COPYRIGHT); ?></p>
    		    		<p class="wjps"><a href="http://www.wjps.co.uk"><img src="Images/WJPS.png" alt="WJPS - Web Designers &amp; Developers" title="WJPS- Web Designers &amp; Developers"/></a></p>
    		    	</div>
    		    	
    		    	</div>
    		    
    		    	<? MetaData::GoogleAnalytics(); ?>
    		    
    		    </body>
    		    
    		</html>
    	<?
    	}
    }

?>