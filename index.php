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
require_once 'model/accounts-model.php';
require_once 'model/products-model.php';




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
            case 'admin':
                include 'view/admin.php';
                break;
            case 'mod':
                $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $prodInfo = getProductInfo($prodId);
                if (count($prodInfo) < 1) {
                    $message = 'Sorry, no product information could be found.';
                }
                include 'view/prod-update.php';
                exit;
                break;
            case 'del':
                $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                $prodInfo = getProductInfo($prodId);
                if (count($prodInfo) < 1) {
                    $message = 'Sorry, no product information could be found.';
                }
                include 'view/prod-delete.php';
                exit;
                break;
            case 'deleteProd':
                $invname = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
                $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

                $deleteResult = deleteProduct($prodId);
                if ($deleteResult) {
                    $message = "<p class='notice'>Congratulations, $invname was successfully deleted.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /acmeproject/products/');
                    exit;
                } else {
                    $message = "<p class='notice'>Error: $invname was not deleted.</p>";
                    $_SESSION['message'] = $message;
                    header('location: /acmeproject/products/');
                    exit;
                }
                break;

            case 'category':
                $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
                $products = getProductsByCategory($type);
                if (!count($products)) {
                    $message = "<p class='notice'>Sorry, no $type products ccould be found.</p>";
                } else {
                    $prodDisplay = buildProductsDisplay($products);
                }
                echo $prodDisplay;
                exit;

                include '/view/category.php';
                break;
            default:
//include 'sql/error.php';
                echo 'nothing is here';
                break;

        }
    }
}


