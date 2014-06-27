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
                
                <p>Welcome to the restricted area of <? print(SITENAME); ?> website. From here you can view <a href="documents.php">documents</a> and <a href="notices.php">notices</a>.</p>
                
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
