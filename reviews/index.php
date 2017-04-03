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
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/product-detail.php';
            exit;
        } else {
            $regRev = regReview($reviewText, $prodId, $clientId);
            return $regRev;

        }

        include '../views/product-detail.php';
        break;

}



