print <<END_of_Multiline_Text;
Content-type: text/html


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="/css/winxp.blue.css" />
		<link rel="stylesheet" type="text/css" href="/css/tabs.css" />
        <script language="javascript" type="text/javascript" src="/header.js"></script>
        <script language="javascript" type="text/javascript">
            writeCopyFlag();
        </script>
	</head>
<body>

<div class="screenLayout">

<div class="headerContainer">
	<div class="pageHeader">
		<div>
            <script language="javascript" type="text/javascript">
                if (window.product_copyrights) 
                {
                    writeHeader(window.plesk_promo.virtuozzo);
                }
            </script>
		</div>
	</div>
</div>

<div class="contentLayout">
	<div class="contentContainer">
		<div class="pageContent">
			<div class="pathBar"><a href="/index.html">Site Home Page</a> &gt;</div>
			<div class="screenTitle">Perl Features Test</div>
		<br/>
			<div id="screenTabs">
				<div id="tabs">
					<ul>
						<li id="current" class="first"><a href="test.pl"><span>Environment</span></a></li>
					</ul>
				</div>
			</div>
			<div class="tabContent">
		<p>This page allows to check if the extension environment settings can be retrieved.</p>


		<div class="formContainer">

		<fieldset>
			<legend>Installed modules</legend>
			
			<p>
				<table class="formFields" cellspacing="0" width="100%">
                                    <tr>
                                       <td>
                                         Perl version: $]
                                         <br>
                                         <br>
					<iframe src="test_info.pl" height ="320px" width="100%"></iframe>
			</td></tr>
			</table>
			</p>
			
		</fieldset>

		</div>
		</div>
		</div>
	</div>
</div>
<div class="footerContainer">
    <script language="javascript" type="text/javascript">
        if (window.product_copyrights) 
        {
            writeFooter(window.plesk_promo.virtuozzo);
        }
    </script>
</div>

</div>
</body>
</html>
END_of_Multiline_Text

