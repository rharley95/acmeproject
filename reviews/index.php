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
 echo 'You are in the register case statement.';
        $clientId = $_SESSION['clientData']['clientId'];
        $prodId = getProductId($prodId);

        $prodId = filter_input(INPUT_GET, 'prodId', FILTER_VALIDATE_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_STRING);

        $regReview = regReview($reviewText, $clientId, $prodId);

        include '/../views/product-detail.php';
        break;


}



