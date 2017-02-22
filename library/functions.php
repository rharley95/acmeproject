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
    $navList .= "<li><a href='/acmeproject/index.php' title='View the Acme home page'>Home</a></li>";
        foreach ($categories as $category) {
            $navList .= "<li><a href='/acmeproject/index.php?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
        }
    $navList .= '</ul>';

    return $navList;
}

