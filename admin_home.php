<?php

include_once 'config/init.php';

if(!isset($_SESSION['admin_id'])){
    redirect('index.php','Please log in as admin.','error');
}



$template = new Template('templates/admin_home_page.php');
//have a template util class just to load the contents
echo $template; //shows the sign up page
