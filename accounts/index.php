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
require_once '../model/reviews-model.php';
// Get the functions library
require_once '../library/functions.php';

session_start();

// Get the accounts model
$categories = getCategories();
$buildNav = buildNav();



$buildNav = buildNav();

$accLog = '<a href="/acmeproject/accounts/index.php?action=admin"> <img src="/acmeproject/images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="/acmeproject/accounts/index.php?action=register"><button type="button">Register</button></a>';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        header('location: /acmeproject/?action=registration');
        exit;
    }
}

switch ($action) {
//    case 'log':
//        include '../view/login.php';
//        break;
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







// Check for existing email address in the table


// Validate to check if form fields are empty
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit;
        } else {
            if($existingEmail){
                $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
                include '../view/login.php';
                exit;
            }

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


    case 'login':
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
        header('location: /acmeproject/accounts/index.php?action=admin');
        exit;
        break;



    case 'logout':
        session_destroy();
        setcookie(['clientData']['clientFirstname'], time() - 3600, '/');
        header('Location: /acmeproject');
        exit;

    case 'admin':
        $clientId = $_SESSION['clientData']['clientId'];
        $reviews = getClientreviews($clientId);

        if(count($reviews) > 0){
            $revList = '<h2>Reviews made by client</h2>';
            $revList .= '<table>';
            $revList .= '<thead>';
            $revList .= '<tr><th><span>Reviews by product:</span></th><th><tr>&nbsp;</tr><tr>&nbsp;</tr></tr></th>';
            $revList .= '</thead>';
            $revList .= '<tbody>';
            foreach ($reviews as $review) {
                $revList .= "<tr><td>$review[invName]</td>";
                $revList .= "<td>$review[reviewText]</td>";
                $revList .= "<td><a href='/acmeproject/reviews/index.php?action=mod&id=$review[reviewId]' title='Click to modify'>Modify</a></td>";
                $revList .= "<td><a href='/acmeproject/reviews/index.php?action=del&id=$review[reviewId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $revList .= '</tbody></table>';

        } else {
            $message = '<p class="notify">Sorry, no reviews have been made by the client.</p>';

        }

        include '../view/admin.php';
        break;

    case 'update':

        $clientId = $_SESSION['clientData']['clientId'];
        $firstname = $_SESSION['clientData']['clientFirstname'];
        $lastname = $_SESSION['clientData']['clientLastname'];
        $email = $_SESSION['clientData']['clientEmail'];

        $clientInfo = getClientInfo($clientId);

        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email');


        //Check for existing email
        $existingEmail= checkExistingEmail($email);

        if ($existingEmail !== $_SESSION['clientData']['clientEmail']) {

            if ($existingEmail == 1) {
                $message = "<p>An account is already associated with this email.<br> Please choose a different email or <a href='/acmeproject/accounts/index.php?action=login' title='login to existing account'>Login</a> with this email</p>";
                $_SESSION['message'] = $message;
                include '../view/admin.php';
                exit;
            }
        }

        if (empty($firstname) || empty($lastname) || empty($email)) {
            $message = '<p>Please provide information you would like to change.</p>';
            $_SESSION['message'] = $message;
            include '../view/client-update.php';
            exit;
        } else {
            $updateClient = updateClient($firstname, $lastname, $email, $clientId);



// Check and report the result
            if ($updateClient) {
                $clientData = getClient($email);
                array_pop($clientData);
                $_SESSION['clientData'] = $clientData;

                $message = "<p>$firstname, you have successfully updated your account information.</p>";
                $_SESSION['message'] = $message;

                setcookie('firstname', $firstname, strtotime('+1 year'), '/');
                    header('location: /acmeproject/accounts/index.php?action=update');
                    exit;

            }



            else {
                $message = "<p>Sorry, your client information did not update.</p>";
                $_SESSION['message'] = $message;
                include '../view/client-update.php';
                exit;
            }


        }
            break;

    case 'updatePassword':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $checkPassword = checkPassword($password);
        $password = password_hash($password, PASSWORD_DEFAULT);


        if (empty($checkPassword)) {
            $message = '<p>Please provide a password change.</p>';
            $_SESSION['message'] = $message;
            include '../view/client-update.php';
            exit;
        }
        else {
            $updatePassword = updatePassword($password, $clientId);
            var_dump($updatePassword);

            }

        if ($updatePassword) {
            $message = 'Your password has been updated.';
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        else {
            $message = 'Sorry, your password was not updated.';
            $_SESSION['message'] = $message;
            include '../view/admin.php';
            exit;
        }
        break;




}
