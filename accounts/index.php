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

session_start();

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

        // Check for existing email address in the table
        $existingEmail = checkExistingEmail($email);


        if($existingEmail){
            $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }




// Check for existing email address in the table


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
                setcookie('firstname', $firstname, time() + 3600, '/');
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
            $email = checkEmail($email);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($password);

        // Run basic checks, return if errors
            if (empty($email) || empty($passwordCheck)) {
                $message = '<p class="notice">Please provide a valid email address and password.</p>';
                include '../view/login.php';
                exit;
            }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
            $clientData = getClient($email);
        // Compare the password just submitted against
        // the hashed password for the matching client
            $hashCheck = password_verify($password, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
        // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
            array_pop($clientData);
        // Store the array into the session
            $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
            header('location: ../view/admin.php') ;
            exit;
        break;



    case 'logout':
        session_destroy();
        setcookie(['clientData']['clientFirstname'], time() - 3600, '/');
        header('Location: /acmeproject');
        exit;

    case 'admin':
        include '../view/admin.php';
        break;

    case 'update':

        $clientId = $_SESSION['clientData']['clientId'];

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $email = $_SESSION['clientData']['clientEmail'];
        $firstname = $_SESSION['clientData']['clientFirstname'];
        $lastname = $_SESSION['clientData']['clientLastname'];
        $password = $_SESSION['loggedin']['clientData']['clientPassword'];

        $clientData = getClient($email);


        //*check for emptiness*/

        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit;
        }
        else {

            $updateclient = updateClient($firstname, $lastname, $email, $password, $clientId);

            $hashCheck = password_verify($password, $clientData['clientPassword']);
            // If the hashes don't match create an error
            // and return to the login view
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include '../view/login.php';
                exit;
            }
            /*check difference in email*/


            $email = checkEmail($email);
            $checkPassword = checkPassword($password);
            $existingEmail = checkExistingEmail($email);

            /*-check the new email, function below*/
            // Check for existing email address in the table
            if($existingEmail){
                /* errors, send back to fix with message*/
                $message = '<p class="notice">Sorry, that email is taken. Please pick a new one.</p>';
                header ('location: ../view/client-update.php');
                exit;
            }

// Check and report the result
            /* attempt update through sql command (model) */
            /*let them know of result*/
            if ($updateclient) {
                $message = "<p>Thanks for updating. ";
                $_SESSION['message'] = $message;
                header('location: /acmeproject/accounts/index.php?action=update');
                exit;
            } else {
                $message = "<p>Sorry, something happened..</p>";
                include '../view/client-update.php';
                exit;
            }
            break;

        }




























}
