<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * The Acme Project :) swagger
 */

//function getCategories() {
//    $db = acme();
//    $sql = 'SELECT * FROM categories ORDER BY categoryName ASC';
//    $stmt = $db->prepare($sql);
//    $stmt->execute();
//    $categories = $stmt->fetchAll();
//    $stmt->closeCursor();
//
//
//    return $categories;
//}


function acmeProducts() {
    
$server = 'localhost';
$dbname= 'acme';
$username = 'romina';
$password = 'TvyQRAqCaqPfSuhn';
$dsn = 'mysql:host='.$server.';dbname='.$dbname;
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Now create the actual connection object and assign it to a variable
try {
   $link = new PDO($dsn, $username, $password, $options);
   return $link;
} catch(PDOException $e) {
   include 'error.php';
   exit;
}
}



// The function below will create a new inventory item into the inventory
/**
 * @param $invname
 * @param $invdesc
 * @param $invprice
 * @param $invstock
 * @param $invsize
 * @param $invloc
 * @param $invcat
 * @param $invvendor
 * @param $invstyle
 * @param $invweight
 * @return int
 */
function regInventory($invname, $invdesc, $invprice, $invstock, $invsize, $invloc, $invcat, $invvendor, $invstyle, $invweight){
// Create a connection object using the acme connection function
   $db = acmeProducts();
// The SQL statement
   $invimg = '/acmeproject/images/no-image.png';
   $invthumb = '/acmeproject/images/no-image.png';
//   $invweight = 3;
   $sql = 'INSERT INTO inventory (invName, invDescription, invImage, invThumbnail,
           invPrice, invStock, invSize, invLocation, categoryId, invVendor, invStyle, invWeight)
           VALUES (:invname, :invdesc, :invimg, :invthumb, :invprice, :invstock, :invsize, :invloc, :invcat, :invvendor, :invstyle, :invweight
           )';
// Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
   $stmt->bindValue(':invname', $invname, PDO::PARAM_STR);
   $stmt->bindValue(':invdesc', $invdesc, PDO::PARAM_STR);
   $stmt->bindValue(':invprice', $invprice, PDO::PARAM_INT);
   $stmt->bindValue(':invstock', $invstock, PDO::PARAM_INT);
   $stmt->bindValue(':invsize', $invsize, PDO::PARAM_INT);
   $stmt->bindValue(':invloc', $invloc, PDO::PARAM_STR);
   $stmt->bindValue(':invvendor', $invvendor, PDO::PARAM_STR);
   $stmt->bindValue(':invstyle', $invstyle, PDO::PARAM_STR);
   $stmt->bindValue(':invcat', $invcat, PDO::PARAM_INT);
   $stmt->bindValue(':invimg', $invimg, PDO::PARAM_STR);
   $stmt->bindValue(':invthumb', $invthumb, PDO::PARAM_STR);
   $stmt->bindValue(':invweight', $invweight, PDO::PARAM_INT);
// Insert the data
$stmt->execute();
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
// Close the database interaction
   $stmt->closeCursor();
// Return the indication of success (rows changed)
   return $rowsChanged;
}

// The function below will create a new inventory item into the inventory
function regCategory($catname){
// Create a connection object using the acme connection function
   $db = acme();
// The SQL statement
   $sql = 'INSERT INTO categories (categoryName)
           VALUES (:catname)';
// Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
   $stmt->bindValue(':catname', $catname, PDO::PARAM_STR);

// Insert the data
   $stmt->execute();
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
// Close the database interaction
   $stmt->closeCursor();
// Return the indication of success (rows changed)
   return $rowsChanged;
}

function getProductBasics() {
    $db = acme();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $products;
}

function getProductInfo($prodId){
    $db = acme();
    $sql = 'SELECT * FROM inventory WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $prodInfo;
}

/**
 * @param $invname
 * @param $invdesc
 * @param $invprice
 * @param $invstock
 * @param $invsize
 * @param $invloc
 * @param $invcat
 * @param $invvendor
 * @param $invstyle
 * @param $invweight
 * @param $prodId
 * @return int
 */
function updateProducts($invname, $invdesc, $invprice, $invstock, $invsize, $invloc, $invcat, $invvendor, $invstyle, $invweight, $prodId){
// Create a connection object using the acme connection function
    $db = acme();
// The SQL statement
//    $invimg = '/acmeproject/images/no-image.png';
//    $invthumb = '/acmeproject/images/no-image.png';
//   $invweight = 3;


    $testID= 3;
    $sql = 'UPDATE inventory SET invName = :invname, invDescription = :invdesc, invImage = :invimg, invThumbnail = :invthumb, invPrice = :invprice, invStock = :invstock, invSize = :invsize, invLocation = :invloc, categoryId = :invcat, invVendor = :invvendor, invStyle = :invstyle, invWeight = :invweight WHERE invId= :prodId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':invname', $invname, PDO::PARAM_STR);
    $stmt->bindValue(':invdesc', $invdesc, PDO::PARAM_STR);
    $stmt->bindValue(':invprice', $invprice, PDO::PARAM_INT);
    $stmt->bindValue(':invstock', $invstock, PDO::PARAM_INT);
    $stmt->bindValue(':invsize', $invsize, PDO::PARAM_INT);
    $stmt->bindValue(':invloc', $invloc, PDO::PARAM_STR);
    $stmt->bindValue(':invvendor', $invvendor, PDO::PARAM_STR);
    $stmt->bindValue(':invstyle', $invstyle, PDO::PARAM_STR);
    $stmt->bindValue(':invcat', $invcat, PDO::PARAM_INT);
    $stmt->bindValue(':invimg', $invimg, PDO::PARAM_STR);
    $stmt->bindValue(':invthumb', $invthumb, PDO::PARAM_STR);
    $stmt->bindValue(':invweight', $invweight, PDO::PARAM_INT);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}


// to delete a record
function deleteProduct($prodId){
// Create a connection object using the acme connection function
    $db = acme();
// The SQL statement
//    $invimg = '/acmeproject/images/no-image.png';
//    $invthumb = '/acmeproject/images/no-image.png';
//   $invweight = 3;


    $testID= 3;
    $sql = 'DELETE FROM inventory WHERE invId = :prodId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is

    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function getProductsByCategory($type){
    $db = acme();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}
