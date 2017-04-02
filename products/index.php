<?php /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
        $action = 'products';
    }
}


switch ($action) {
    case 'products':
    $products = getProductBasics();
        if(count($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }
    case 'mod':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if(count($prodInfo)<1){
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
    include '../view/products-management.php';



    break;

    case 'mod':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if(count($prodInfo)<1){
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;
   
}



// edit this to add to inventory :)
switch ($action) {
    case 'register':
// echo 'You are in the register case statement.';
        $invname = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $invdesc = filter_input(INPUT_POST, 'invdesc', FILTER_SANITIZE_STRING);
        $invprice = filter_input(INPUT_POST, 'invprice', FILTER_SANITIZE_STRING);
        $invstock = filter_input(INPUT_POST, 'invstock', FILTER_SANITIZE_NUMBER_INT);
        $invsize = filter_input(INPUT_POST, 'invsize', FILTER_SANITIZE_NUMBER_INT);
        $invloc = filter_input(INPUT_POST, 'invloc', FILTER_SANITIZE_STRING);
        $invcat = filter_input(INPUT_POST, 'invcat', FILTER_SANITIZE_STRING);
        $invvendor = filter_input(INPUT_POST, 'invvendor', FILTER_SANITIZE_STRING);
        $invstyle = filter_input(INPUT_POST, 'invstyle', FILTER_SANITIZE_STRING);
        $invweight = filter_input(INPUT_POST, 'invweight', FILTER_SANITIZE_NUMBER_INT);

// Validate to check if form fields are empty
        if (empty($invname) || empty($invdesc) || empty($invprice) || empty($invstock) || empty($invsize) || empty($invloc) || empty($invvendor) || empty($invweight) || empty($invstyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/products.php';
            exit;
        } else {

            $regOutcome = regInventory($invname, $invdesc, $invprice, $invstock, $invsize, $invloc, $invcat, $invvendor, $invstyle, $invweight);


// Check and report the result
            if ($regOutcome === 1) {
                $message = "<p>Thanks for registering $invname. ";
                include '../view/products.php';
                exit;
            } else {
                $message = "<p>Sorry, your category did not register.</p>";
                include '../view/products.php';
                exit;

                break;
            }
        }

    case 'prod-list':
        $products = getProductBasics();
        if(count($products) > 0){
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acmeproject/products/index.php?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acmeproject/products/index.php?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }

        include '../view/products-management.php';
        break;

    case 'updateProd':

        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
        $invname = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $invdesc = filter_input(INPUT_POST, 'invdesc', FILTER_SANITIZE_STRING);
        $invprice = filter_input(INPUT_POST, 'invprice', FILTER_SANITIZE_STRING);
        $invstock = filter_input(INPUT_POST, 'invstock', FILTER_SANITIZE_NUMBER_INT);
        $invsize = filter_input(INPUT_POST, 'invsize', FILTER_SANITIZE_NUMBER_INT);
        $invloc = filter_input(INPUT_POST, 'invloc', FILTER_SANITIZE_STRING);
        $invcat = filter_input(INPUT_POST, 'invcat', FILTER_SANITIZE_STRING);
        $invvendor = filter_input(INPUT_POST, 'invvendor', FILTER_SANITIZE_STRING);
        $invstyle = filter_input(INPUT_POST, 'invstyle', FILTER_SANITIZE_STRING);
        $invweight = filter_input(INPUT_POST, 'invweight', FILTER_SANITIZE_NUMBER_INT);

// Validate to check if form fields are empty
        if (empty($invname) || empty($invdesc) || empty($invprice) || empty($invstock) || empty($invsize) || empty($invloc) || empty($invcat) || empty($invvendor) || empty($invweight) || empty($invstyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/prod-update.php';
            exit;
        } else {

            $updateResult = updateProducts($invname, $invdesc, $invprice, $invstock, $invsize, $invloc, $invcat, $invvendor, $invstyle, $invweight, $prodId);

// Check and report the result
            if ($updateResult) {
                $message = "<p>Thanks for updating $invname. ";
                $_SESSION['message'] = $message;
                header('location: /acmeproject/products/index.php?action=prod-list');
                exit;
            } else {
                $message = "<p>Sorry, your product did not update.</p>";
                include '../view/prod-update.php';
                exit;
            }
                break;

        }

    case 'del':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;


    case 'deleteProd':
        $invname = filter_input(INPUT_POST, 'invname', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($prodId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations, $invname was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acmeproject/products/index.php?action=prod-list');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invname was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acmeproject/products/index.php?action=prod-list');
            exit;
        }
        break;

    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if(!count($products)){
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);

        }
        include '../view/category.php';
        break;

    case 'getInfo':
        $product = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING); /*grabbing product id into product*/
        $info = getProductInfo($product);
        $thumbs = getProdThumb($product);

        if(!count($info)) {
            $message = "<p class='notice'> Sorry no information was found. </p> ";
        } else {
            $prodInfoDisplay = buildProductsInfoDisplay($info);
            $thumbDisplay = buildThumbDisplay($thumbs);
        }

        include '../view/product-detail.php';

    break;


}
