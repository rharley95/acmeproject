<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * The Acme Project :) swagger
 */
//
function acme() {

    $server = 'localhost';
    $dbname = 'acme';
    $username = 'romina';
    $password = 'TvyQRAqCaqPfSuhn';
    $dsn = 'mysql:host=' . $server . ';dbname=' . $dbname;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Now create the actual connection object and assign it to a variable
    try {
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch (PDOException $e) {
        include 'sql/error.php';
        exit;
    }
}

function getCategories() {
    $db = acme();
    $sql = 'SELECT * FROM categories ORDER BY categoryName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();


    return $categories;
}