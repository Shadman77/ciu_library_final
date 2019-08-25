<?php

include_once 'config/init.php';

if(!isset($_SESSION['student_id'])){
    redirect('index.php','Please log in as student.','error');
}


$template = new Template('templates/student_home_page.php');
//have a template util class just to load the contents
echo $template; //shows the sign up page
