<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 2/16/17
 * Time: 8:06 PM
 */


function checkEmail($email){
    $sanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $valEmail = filter_var($sanEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}


// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($password){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
    return preg_match($pattern, $password);
}

$categories = getCategories();

function checkCat($category){
    $sanCategory = filter_var($category, FILTER_SANITIZE_STRING);
    return $sanCategory;
}






function buildNav(){

    $categories = getCategories();

    $navList = '<ul>';
    $navList .= "<li><a href='/acmeproject/' title='View the Acme home page'>Home</a></li>";
        foreach ($categories as $category) {
            $navList .= "<li><a href='/acmeproject/products/index.php?action=category&type=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
        }
    $navList .= '</ul>';

    return $navList;
}

function buildProductsDisplay($products){
    $pd = '<ul id="prod-display">';
    foreach ($products as $product) {
        $pd .= '<li>';
        $pd .= "<img src='/acmeproject/images/products/$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= "<h2><a href='/acmeproject/products/index.php?action=getInfo&type=$product[invId]'>$product[invName]</a></h2>";
        $pd .= "<span>$product[invPrice]</span>";
        $pd .= '</li>';
    }
    $pd .= '</ul>';
    return $pd;
}

function buildProductsInfoDisplay($product){
    $pd = '<section class="prod-info">';
        $pd .= "<img src='/acmeproject/images/products/$product[invImage]' alt='Image of $product[invName] on Acme.com'>";
        $pd .= "<h2>$product[invName]</h2>";
    $pd .= "<span>$product[invDescription]</span>";
    $pd .= "</br>";
        $pd .= "<span>$$product[invPrice]</span>";
    $pd .= "</br>";
    $pd .= "<span>$product[invSize]</span>";
    $pd .= "</br>";
    $pd .= "<span>$product[invWeight]</span>";
    $pd .= "</br>";
    $pd .= "<span>$product[invLocation]</span>";
    $pd .= "</br>";
    $pd .= "<span>$product[invVendor]</span>";
    $pd .= "</br>";
    $pd .= "<span>$product[invStyle]</span>";
        $pd .= '</li>';
    $pd .= '</section>';
    return $pd;
}


