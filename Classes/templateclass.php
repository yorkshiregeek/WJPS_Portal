<?php

    class Templates
    {
    
    	static function PageHeader($PageTitle,$ExtraScripts){
    	
    	?>
    		<!DOCTYPE html>
            <html lang="en">
    		
    		<? Templates::MetaHeader($PageTitle,$ExtraScripts); ?>
    		       	
    	    <body>

            <nav class="navbar navbar-default " role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Welcome</a></li>
                        <li><a href="#">Links</a></li>
                      </ul>
                      
                      <ul class="nav navbar-nav navbar-right">
                       <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                      </form>
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
        </nav>

    	 
    	     	<div class="container">
 
                    <div class="row">
                        <div id="header" class="col-md-12 ">
                            <h1><? print(SITENAME); ?></h1>
                            <h2><? print(SITENAMESUB); ?></h2>
                            <div id="logo"></div>
                        </div>
  
                    </div>
               
            

                    <div class="row">


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
                <link rel="stylesheet" type="text/css" href="css/jquery-sortable.css"/>
                <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    		    <script type="text/javascript" src="Script/Script.js"></script>
                 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
               <script src="http://codeorigin.jquery.com/jquery-2.0.3.min.js"></script>
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
            </div>
                </div>

                <footer>
        		<div class="container" id="footer">
               	
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
        		    <!-- Scripts for bootstrap tab loading-->

                    <script src="js/jquery.loadmask.js"></script>
                    <script src="js/bootstrap-remote-tabs.js"></script>
        		 
                </footer>
                  </body>
    		    
    		</html>
    	<? 
    	}
    }

?>