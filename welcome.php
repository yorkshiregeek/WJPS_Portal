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


                $UID = Users::logincheck(1);
        
                $User = new Users($UID);

                $LL = new DateTime($User->getlastlogin());
            ?>
                
                <h2 class='page-header'>Welcome</h2>
                
                <p class='lead'>Welcome to the restricted area of <? print(SITENAME); ?> website. Using the Secure menu at the top of the page you can access the secure sections of the website including <a href="documents.php">documents</a>, <a href="notices.php">notices</a> and <a href="events.php">events</a>.</p>
                
        </div>
        <div>
            <div class='col-md-6' id='content'>
               <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Latest Documents <span class="badge pull-right"><? echo(Documents::lastdocumentscount($User->getlastlogin())); ?></span></h3>

                  </div>
                  <div class="panel-body">
                    <p>Since your last login on <strong><? echo(date_format($LL,"d/m/y")); ?></strong> the following documents have changed.</p>
                    
                    <?Documents::lastdocuments($User->getlastlogin());?>
                  </div>
                </div>
            </div>
            <div class='col-md-6' id='content'>
               <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">Latest Notices<span class="badge pull-right"><? echo(Documents::lastdocumentscount($User->getlastlogin())); ?></span></h3>

                  </div>
                  <div class="panel-body">
                    <p>Since your last login on <strong><? echo(date_format($LL,"d/m/y")); ?></strong> the following notices have been added.</p>
                    
                    <? Notices::lastnotices(); ?>
                  </div>
                </div>
            </div>
              <?  
            }
            ?>
            
        
            
        </div>
<?

    Templates::PageFooter();

?>
