<?php

include_once 'config/init.php';

$template = new Template('templates/landing_page.php');
//have a template util class just to load the contents

$records = new Record;


$results = $records->getAllBooks(7, 'all', 'all');
if ($results) {
    $template->newArrivals = $results;
    echo $template; //shows the landing page
} else {
    echo "Something went Wrong!";
}
