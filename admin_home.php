<?php

include_once 'config/init.php';



$template = new Template('templates/admin_home_page.php');
//have a template util class just to load the contents
echo $template; //shows the sign up page
