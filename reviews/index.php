<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 3/27/17
 * Time: 11:50 AM
 */

session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/acme-model.php';
require_once '../model/products-model.php';
require_once '../model/reviews-model.php';



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


        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);


        if (empty($reviewText)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/product-detail.php';
            exit;
        } else {
            $regRev = regReview($reviewText, $prodId, $clientId);
            $_SESSION['message'] = '<p>Thanks for your feedback!</p>';
            header("location: /acmeproject/products/index.php?action=getInfo&type=$prodId");

        }


        break;


        //Working from Products!

    case 'mod':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $review = getOneReview($reviewId);
        if($_SESSION['clientData']['clientId'] !== $review['clientId']){
            header('location: /acmeproject');
            exit;
        }

        include '../view/rev-update.php';
        exit;
        break;

    case 'updateRev':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $review = getOneReview($reviewId);


// Validate to check if form fields are empty
        if (empty($reviewText)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/rev-update.php';
            exit;
        } else {

            $updateReview = updateReviews($reviewId, $reviewText, $prodId, $clientId);

// Check and report the result
            if ($updateReview) {
                $message = "<p>Thanks for updating your review! ";
                $_SESSION['message'] = $message;
                header('location: /acmeproject/accounts/index.php?action=admin');
                exit;
            } else {
                $message = "<p>Sorry, your product did not update.</p>";
                $_SESSION['message'] = $message;
                include '../view/rev-update.php';
                exit;
            }
            break;

        }


    case 'del':
        $product = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING); /*grabbing product id into product*/
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $review = getOneReview($id);

//        var_dump($review);
//        exit;
        if (count($review) < 1) {
            $message = "<p>Sorry, no product information could be found.</p> ";
            $_SESSION['message'] = $message;
        }
        include '../view/rev-delete.php';
        exit;
        break;


    case 'deleteRev':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $delete = deleteReview($reviewId);

        if ($delete) {
            $message = "<p class='notice'>Congratulations, review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acmeproject/accounts/index.php?action=admin');
            exit;
        } else {
            $message = "<p class='notice'>Error: review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acmeproject/accounts/index.php?action=admin');
            exit;
        }
        break;

}