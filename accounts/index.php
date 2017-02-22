<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../library/connections.php';
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the accounts model
$categories = getCategories();
$buildNav = buildNav();


//$navList = '<ul>';
//$navList .= "<li><a href='/acmeproject/index.php' title='View the Acme home page'>Home</a></li>";
//foreach ($categories as $category) {
//    $navList .= "<li><a href='/acmeproject/index.php?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//}
//$navList .= '</ul>';

$accLog = '<a href="?action=login"> <img src="images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="?action=registration"><button type="button">Register</button></a>';
//
//echo $navList;
//exit;
//var_dump($categories);
//exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        header('location: /acmeproject/?action=registration');
        exit;
    }
}


switch ($action) {
    case 'register':
// echo 'You are in the register case statement.';
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $email = checkEmail($email);
        $checkPassword = checkPassword($password);

        $existingEmail = checkExistingEmail($email);

// Check for existing email address in the table
if($existingEmail){
  $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
  include '../view/login.php';
  exit;
}

// Validate to check if form fields are empty
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        } else {

            // Hash the checked passcode
            $password = password_hash($password, PASSWORD_DEFAULT);

            //Send data to mooodel!
            $regOutcome = regVisitor($firstname, $lastname, $email, $password);

// Check and report the result
            if ($regOutcome === 1) {
                $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p>Sorry $firstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
                exit;

                break;
            }
        }


        case 'Login':
            $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $email = checkEmail($email);
        $checkPassword = checkPassword($password);
        break;

}
