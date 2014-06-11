<%@ Language=VBScript%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<%

mes = ""
IsSuccess = false

sTo = "@client_email@"
sFrom = Trim(Request.Form("txtFrom"))
sSubject = Trim(Request.Form("txtSubject"))
sMailServer = "127.0.0.1"
sBody = Trim(Request.Form("txtBody"))

if Request("__action")="TestEMail" then
	TestEMail()	
end if

Sub TestEMail()

	Set objMail = Server.CreateObject("CDO.Message")
	Set objConf = Server.CreateObject("CDO.Configuration") 
	Set objFields = objConf.Fields
	
	With objFields
		.Item("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2
		.Item("http://schemas.microsoft.com/cdo/configuration/smtpserver")  = sMailServer 
		.Item("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 10 
		.Item("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25
		.Update 
	End With

	With objMail
		Set .Configuration = objConf
		.From = sFrom
		.To = sTo
		.Subject = sSubject
		.TextBody = sBody
	End With
    
    Err.Clear 
	on error resume next

    objMail.Send
	if len(Err.Description) = 0 then
        mes = " The message was sent to " + sTo
        mes = mes + " "
        IsSuccess = true
    else
		mes = " " + Err.Description + " The mail sending test failed."
	end if
	Set objFields = Nothing
	Set objConf = Nothing
	Set objMail = Nothing
End sub

Sub Alert(html)
	if IsSuccess then
		Response.Write "<div class='testRelults' id='testSuccessful'><span class='testResult'>Success:</span>" & html & "</div>"
	else
		Response.Write "<div class='testRelults' id='testFailed'><span class='testResult'>Failure:</span>" & html & "</div>"
	end if
End Sub
%>
<html>
<head>
    <title>ASP Features Test</title>
    <meta name=vs_targetSchema content="http://schemas.microsoft.com/intellisense/ie5">
    <link rel="stylesheet" type="text/css" href="/css/winxp.blue.css" />
    <link rel="stylesheet" type="text/css" href="/css/tabs.css" />
    <script language="javascript" type="text/javascript" src="/header.js"></script>
    <script language="javascript" type="text/javascript">
        writeCopyFlag();
    </script>
    <style>
    .hidden{
        display: none;
    }
    </style>
</head>
<body>
<div class="screenLayout">
    <form id="form1" action="test_mail.asp?__action=TestEMail&tp=<%= rnd(1)*100*timer %>" method="POST" >
        <input id="__action" type="hidden" value="" />
        <!--**<HEADER>*******************************************************************************************************-->
<div class="headerContainer">
    <script language="javascript" type="text/javascript">
        if (window.product_copyrights) 
        {
            writeHeader(window.plesk_promo.virtuozzo);
        }
    </script>
</div>
        <!--**</HEADER>******************************************************************************************************-->
        <!--**<CONTENT>******************************************************************************************************-->
        <div class="contentLayout">
            <div class="contentContainer">
                <div class="pageContent">
                    <div class="pathBar">
                        <a href="/index.html">Site Home Page</a> &gt;</div>
                    <div class="screenTitle">
                        ASP Features Test</div>
                    <br />
                    <div id="screenTabs">
                        <div id="tabs">
					    <ul>
						    <li class="first"><a href="test_mysql.asp"><span>MySQL</span></a></li>
						    <li><a href="test_mssql.asp"><span>MSSQL</span></a></li>
						    <li><a href="test_msaccess.asp"><span>MS Access</span></a></li>
						    <li class="last" id="current"><a href="test_mail.asp"><span>E-Mail</span></a></li>
					    </ul>
				    </div>
                    </div>
                    <!-- MySQL server -->
                    <div class="tabContent">
                        <div class="formContainer">
                        <p>This page allows you to test mail sending through the local Plesk Control Panel's SMTP mail server. You need to supply the sender's e-mail address or name, message subject and body.</p>
                            <% if len(mes) > 0 then	Alert(mes) end if %>
                            <fieldset>
                                <legend id="LegendName">Test mail sending</legend>
                                <p>
                                        <table class="formFields" cellspacing="0" width="100%">
                                            <tr>
                                                <td class="name">
                                                    <label for="txtFrom">
                                                        From</label></td>
                                                <td>
                                                    <input name="txtFrom" size="25" value = "<% Response.Write(sFrom) %>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="name">
                                                    <label for="txtSubject">
                                                        Subject</label></td>
                                                <td>
                                                    <input name="txtSubject" size="25" value="<% Response.Write(sSubject) %>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="name">
                                                    <label for="txtBody">
                                                        Message body</label></td>
                                                <td rowspan="2">
                                                    <textarea name="txtBody" cols = "35" rows="4"><% Response.Write(sBody) %></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                </p>
                            </fieldset>
                            <div class="buttonsContainer">
                                <div class="commonButton" id="DBTestButton" title="Test">
                                    <button type="submit" name="bname_ok">
                                        Test</button><span>Test</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**</CONTENT>*****************************************************************************************************-->
    </form>
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
