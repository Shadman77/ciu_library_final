<?php
//Prevent Cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

//Start session
session_start();

//including system helper
require_once 'helpers/system_helper.php';

//Config file
require_once 'config.php'; //require_once works



//auto include class file function
//class name must be same as file name
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.php';
});


/**Notification for student */
if (isset($_SESSION['student_id'])) {
    if (!isset($_SESSION['notification'])) {
        $_SESSION['notification'] = true;
    }
    $request = new Request;
    $_SESSION['ready'] = $request->checkIfReady($_SESSION['student_id']);
}
