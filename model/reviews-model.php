<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 3/27/17
 * Time: 12:16 PM
 */

function getClientReviews($clientId) {
    $db = acme();
    $sql = 'SELECT * FROM reviews WHERE clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $reviews;
}

function getProductReview($prodId){
    $db = acme();
    $sql = 'SELECT * FROM reviews WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodrev = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $prodrev;
}

function regReview($reviewText, $reviewId, $clientId, $invId){
// Create a connection object using the acme connection function
    $db = acme();
    $sql = 'INSERT INTO reviews (reviewText, reviewDate, reviewId, clientId, invId)
           VALUES (:reviewText, :reviewId, :clientId, :invId)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}