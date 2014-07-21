<?php
require 'Classes/Mandrill.php';

$mandrill = new Mandrill("_uJ1wXayJBnYRHQnv2XrXw"); 

// If are not using environment variables to specific your API key, use:
// $mandrill = new Mandrill("YOUR_API_KEY")

$message = array(
    'subject' => 'Test message',
    'from_email' => 'jason@jnhconsulting.co.uk',
    'html' => '<p>this is a test message with Mandrill\'s PHP wrapper!.</p>',
    'to' => array(array('email' => 'jason@hayhurst.co', 'name' => 'Jase')),
    'merge_vars' => array(array(
        'rcpt' => 'jason@hayhurst.co',
        'vars' =>
        array(
            array(
                'name' => 'FIRSTNAME',
                'content' => 'Jason'),
            array(
                'name' => 'LASTNAME',
                'content' => 'Hayhurst')
    ))));

$template_name = 'test';

$template_content = array(
    array(
        'name' => 'main',
        'content' => 'Hi *|FIRSTNAME|* *|LASTNAME|*, thanks for signing up.'),
    array(
        'name' => 'footer',
        'content' => 'Copyright 2012.')

);

print_r($mandrill->messages->sendTemplate($template_name, $template_content, $message));

?>