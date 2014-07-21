<?php 
    
    class Emails
    {

       static public function newuser ($To, $Subject, $User, $Pass, $First, $Last, $URL)
        {

            require 'Classes/Mandrill.php';

            $mandrill = new Mandrill(MANDRILL_APIKEY); 

            // If are not using environment variables to specific your API key, use:
            // $mandrill = new Mandrill("YOUR_API_KEY")

            $message = array(
                'subject' => $Subject,
                'from_email' => NOREPLYEMAIL,
                //'html' => '<p>this is a test message with Mandrill\'s PHP wrapper!.</p>',
                'to' => array(array('email' => $To, 'name' => $First)),
                'global_merge_vars' => array(
                        array(
                            'name' => 'URL',
                            'content' => URL),
                        array(
                            'name' => 'SITENAME',
                            'content' => $Subject),
                        array(
                            'name' => 'DEFAULTEMAIL',
                            'content' => DEFAULTEMAIL),
                        array(
                            'name' => 'SUBNAME',
                            'content' => SHORTNAME)
                  ),

                'merge_vars' => array(array(
                    'rcpt' => $To,
                    'vars' =>
                    array(
                        array(
                            'name' => 'FIRSTNAME',
                            'content' => $First),
                        array(
                            'name' => 'LASTNAME',
                            'content' => $Last),
                        array(
                            'name' => 'PASSWORD',
                            'content' => $Pass),
                        array(
                            'name' => 'USER',
                            'content' => $User)                        
                ))));

            //This refers to the Mandrill template name
            $template_name = 'new-user-email';

            $template_content = array(
               // array(
                    //This is the DIV 
                 //   'name' => 'main',
                 //   'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up. Your user name is *|USER|* and your password is *|PASSWORD|* . Please Login at *|URL|*'),
               // array(
                 //   'name' => 'footer',
                   // 'content' => 'Copyright 2014.')

                    );

        //For error checking
       $mandrill_array=$mandrill->messages->sendTemplate($template_name, $template_content, $message);

      // print_r($mandrill_array);
            
        }

         static public function reset ($To,$Subject, $User, $Pass, $URL)
        {

            require 'Classes/Mandrill.php';

            $mandrill = new Mandrill(MANDRILL_APIKEY); 

            // If are not using environment variables to specific your API key, use:
            // $mandrill = new Mandrill("YOUR_API_KEY")

            $message = array(
                'subject' => $Subject,
                'from_email' => NOREPLYEMAIL,
                //'html' => '<p>this is a test message with Mandrill\'s PHP wrapper!.</p>',
                'to' => array(array('email' => $To, 'name' => $First)),
                'global_merge_vars' => array(
                        array(
                            'name' => 'URL',
                            'content' => URL),
                        array(
                            'name' => 'SITENAME',
                            'content' => $Subject),
                        array(
                            'name' => 'DEFAULTEMAIL',
                            'content' => DEFAULTEMAIL),
                        array(
                            'name' => 'SUBNAME',
                            'content' => SHORTNAME)
                  ),

                'merge_vars' => array(array(
                    'rcpt' => $To,
                    'vars' =>
                    array(
                        array(
                            'name' => 'FIRSTNAME',
                            'content' => $First),
                        array(
                            'name' => 'LASTNAME',
                            'content' => $Last),
                        array(
                            'name' => 'PASSWORD',
                            'content' => $Pass),
                        array(
                            'name' => 'USER',
                            'content' => $User)
                ))));

            //This refers to the Mandrill template name
            $template_name = 'reset-password';

            $template_content = array(
              //  array(
                    //This is the DIV 
                 //   'name' => 'main',
                   // 'content' => 'Your password for *|URL|* has been reset by the administrator. Your new user login details are shown below. < /br> Username: *|USER|* </ br> New Password: *|PASSWORD|* < /br> Please Login at *|URL|*'),
             //   array(
               //     'name' => 'footer',
  //                  'content' => 'Copyright WJPS Ltd, 2014.')
//
                    );

        //For error checking
        //For error checking
       $mandrill_array=$mandrill->messages->sendTemplate($template_name, $template_content, $message);

      // print_r($mandrill_array);
        }
                

      static public function sendemail($To, $Subject, $Content)
        {
         

          $tos = array();  
          $rctps = array();

          $testarray =array(array('name' => 'fname','content' => 'james'));

          $c = 0;
          
          foreach($To as $Rctp){
            
            $tos[$c] = array('email' => $Rctp->getemail(),'name' => $Rctp->getfullname(),'type' => 'bcc');
            $rctps[$c] = array('rcpt' => $Rctp->getemail(), 'vars' => array(array('name' => 'FIRSTNAME','content' => $Rctp->getfirstname())));

           $c += 1;
          }

         require 'Classes/Mandrill.php';

          $mandrill = new Mandrill(MANDRILL_APIKEY); 

          // If are not using environment variables to specific your API key, use:
          // $mandrill = new Mandrill("YOUR_API_KEY")


            $message = array(
                'subject' => $Subject,
                'from_email' => NOREPLYEMAIL,

                 'global_merge_vars' => array(
                        array(
                            'name' => 'URL',
                            'content' => URL),
                        array(
                            'name' => 'SITENAME',
                            'content' => SITENAME),
                        array(
                            'name' => 'DEFAULTEMAIL',
                            'content' => DEFAULTEMAIL),
                        array(
                            'name' => 'SUBNAME',
                            'content' => SITENAMESUB),
                        array(
                            'name' => 'DETAIL',
                            'content' => $Content)
                  ),
    
    

    
                //'html' => '<p>this is a test message with Mandrill\'s PHP wrapper!.</p>',
    
    'to' => $tos,


                'merge_vars' => $rctps);

            //This refers to the Mandrill template name
            $template_name = 'mailer-template';

            $template_content = array(
                array(
                    //This is the DIV 
                    'name' => 'DETAIL',
                    'content' => $Content)

                    );

        //For error checking
        print_r($mandrill->messages->sendTemplate($template_name, $template_content, $message));

  

  }






    
    }

?>
