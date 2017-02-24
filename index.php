<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'library/connections.php';
require_once 'model/acme-model.php';
// Get the functions library
require_once 'library/functions.php';


// Create or access a Session
session_start();


$categories = getCategories();


$buildNav = buildNav();

$accLog = '<a href="?action=login"> <img src="/acmeproject/images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="?action=registration"><button type="button">Register</button></a>';
//
//echo $navList;
//exit;

//var_dump($categories);
//exit;


// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
$action = 'home';
}
//            if($action == NULL){
//              $action = 'login';
//            }
//            if($action == NULL){
//              $action = 'registration';
//            }
}


switch ($action) {
case 'home':
include 'view/home.php';
break;
case 'login':
include 'view/login.php';
break;
case 'registration':
include 'view/registration.php';
break;
case 'products-registry':



include 'view/products.php';
break;
case 'categories':
include 'view/categories.php';
break;
case 'products':
include 'view/products-management.php';
break;
default:
include 'sql/error.php';
break;

}
