<?php

/*
 * This is the model for the accounts
 *

 *
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */






/*
 *  the new function will handle site registration for product in the inventory
 */

function regVisitor($firstname, $lastname, $email, $password){
// Create a connection object using the acme connection function
   $db = acme();
// The SQL statement
   $sql = 'INSERT INTO clients (clientFirstname, clientLastname,
           clientEmail, clientPassword)
           VALUES (:firstname, :lastname, :email, :password)';
// Create the prepared statement using the acme connection
   $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
   $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
   $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
   $stmt->bindValue(':email', $email, PDO::PARAM_STR);
   $stmt->bindValue(':password', $password, PDO::PARAM_STR);
// Insert the data
   $stmt->execute();
// Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
// Close the database interaction
   $stmt->closeCursor();
// Return the indication of success (rows changed)
   return $rowsChanged;
}

// Check for an existing email address
function checkExistingEmail($email) {
  $db = acme();
  $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();

  if(empty($matchEmail)){
    return 0;
//      echo 'Nothing Found';
//      exit;
  } else {
    return 1;
//      echo 'Match found';
//      exit;
  }
}

// Get client data based on an email address
function getClient($email){
    $db = acme();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}



function updateClient($firstname, $lastname, $email, $password, $clientId){
// Create a connection object using the acme connection function
    $db = acme();
// The SQL statement
    $sql = 'UPDATE clients SET clientFirstname = :firstname, clientLastname = :lastname, clientEmail = :email, clientPassword = :password WHERE clientId = :clientId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}
