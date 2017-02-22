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



// Get the accounts model
$categories = getCategories();
$buildNav = buildNav();

$accLog = '<a href="?action=login"> <img src="images/account.gif" alt="suitcase login">My Account</a>';
$accReg = '<a href="?action=registration"><button type="button">Register</button></a>';


//$navList = '<ul>';
//$navList .= "<li><a href='/acmeproject/index.php' title='View the Acme home page'>Home</a></li>";
//foreach ($categories as $category) {
//    $navList .= "<li><a href='/acmeproject/index.php?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//}
//$navList .= '</ul>';
//
//$accLog = '<a href="?action=login"> <img src="images/account.gif" alt="suitcase login">My Account</a>';
//$accReg = '<a href="?action=registration"><button type="button">Register</button></a>';



//$catList = '<select name="invcat" id="invcat">';
//foreach ($categories as $category) {
//$catList .= "<option value='$category[categoryId]'> $category[categoryName] </option>";
//}
//$catList .= "</select>";




$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'products';
    }
}


switch ($action) {
    case 'products':
        include '../view/products.php';
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
        if (empty($invname) || empty($invdesc) || empty($invprice) || empty($invstock) || empty($invstyle) || empty($invloc) || empty($invvendor) || empty($invweight) || empty($invstyle)) {
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
}