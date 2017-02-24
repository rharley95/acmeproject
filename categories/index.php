<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../model/acme-model.php';
require_once '../model/products-model.php';
//require_once '../library/connections.php';
// Get the functions library
require_once '../library/functions.php';


session_start();

// Get the accounts model
$categories = getCategories();

$sanCategories = checkCat($categories);

$buildNav = buildNav();

$accLog = '<a href="?action=login"> <img src="images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="?action=registration"><button type="button">Register</button></a>';

//
//echo $navList;
//exit;
//var_dump($catList);
//exit;



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'categories';
    }
}


switch ($action) {
    case 'categories':
        include '../view/categories.php';
        break;
//    default:
//        include '../sql/error.php';
//        break;
}



// edit this to add to inventory :)
switch ($action) {
    case 'register':
// echo 'You are in the register case statement.';
        $catname = filter_input(INPUT_POST, 'catname', FILTER_SANITIZE_STRING);


// Validate to check if form fields are empty
        if (empty($catname)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/categories.php';
            exit;
        } else {

            $regOutcome = regCategory($catname);

// Check and report the result
            if ($regOutcome === 1) {
                $message = "<p>Thanks for registering $catname. ";
                include '../view/categories.php';
                exit;
            } else {
                $message = "<p>Sorry, your category did not register.</p>";
                include '../view/categories.php';
                exit;

                break;
            }
        }
}