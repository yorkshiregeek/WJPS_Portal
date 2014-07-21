<?

    session_start();

    include_once("Classes/classes.php");
    include_once("Classes/noticesclass.php");
    include_once("Classes/documentsclass.php");
    include_once("Classes/sectionsclass.php");
    include_once("Classes/groupsclass.php");
    
    Templates::PageHeader("Restricted Area",$Scripts,$Page,0);
    
?>          
        <div class='col-md-12' id='content'>
        
            <?
            if(Users::login(0)){
            ?>
                
                <h2 class='page-header'>Welcome</h2>
                
                <p class='lead'>Welcome to the restricted area of <? print(SITENAME); ?> website. Using the Secure menu at the top of the page you can access the secure sections of the website including <a href="documents.php">documents</a>, <a href="notices.php">notices</a> and <a href="events.php">events</a>.</p>
                
                <h3>Latest Documents</h3>

                <p>Since your last login on <? echo($User->getlastlogin()); ?> the following documents have changed.</p>

                <p>The latest notices added to the system are shown below:</p>
                
            <?
                
                Notices::lastnotices();
            
            ?>
            
                <p>The latest documents added to the system are shown below:</p>
                
            <?
            
                Documents::lastdocuments();
                
            }
            ?>
            
        
            
        </div>
<?

    Templates::PageFooter();

?>
