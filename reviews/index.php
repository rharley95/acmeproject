<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 3/27/17
 * Time: 11:50 AM
 */

require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
require_once '../library/connections.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';

session_start();

// Get the accounts model
$categories = getCategories();
$buildNav = buildNav();

$accLog = '<a href="/acmeproject/accounts/index.php?action=admin"> <img src="/acmeproject/images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="/acmeproject/accounts/index.php?action=registration"><button type="button">Register</button></a>';



$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'reviews';
    }
}

switch ($action) {
    case 'new':
// echo 'You are in the register case statement.';
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

// Validate to check if form fields are empty
        if (empty($reviewText)) {
            $message = '<p>Please provide a review for the product.</p>';
            include '../view/products.php';
            exit;
        } else {
            $regReview = regReview($reviewText, $reviewId, $clientId, $invId);


// Check and report the result
            if ($regReview === 1) {
                $message = "<p>Thanks for giving us feedback! ";
                include '../view/product-detail.php';
                exit;
            } else {
                $message = "<p>Sorry, your review did not register.</p>";
                include '../view/product-detail.php';
                exit;

                break;
            }
        }

}



