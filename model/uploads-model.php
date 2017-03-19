<?php
/**
 * Created by PhpStorm.
 * User: rominapainter
 * Date: 3/15/17
 * Time: 12:03 PM
 */


// Add image information to the database table
function storeImages($imgPath, $prodId, $imgName) {
    $db = acme();
    $sql = 'INSERT INTO Images (invId, imgPath, imgName) VALUES (:prodId, :imgPath, :imgName)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->execute();

    // Make and store the thumbnail image information
    // Change name in path
    $imgPath = makeThumbnailName($imgPath);
    // Change name in file name
    $imgName = makeThumbnailName($imgName);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->bindValue(':imgPath', $imgPath, PDO::PARAM_STR);
    $stmt->bindValue(':imgName', $imgName, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Get Image Information from images table
function getImages() {
    $db = acme();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invName FROM Images JOIN inventory ON Images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $imageArray;
}


// Delete image information from the images table
function deleteImage($id) {
    $db = acme();
    $sql = 'DELETE FROM Images WHERE imgId = :imgId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':imgId', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}

// Check for an existing image
function checkExistingImage($name){
    $db = acme();
    $sql = "SELECT imgName FROM Images WHERE imgName = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}

function getProdImage($prodId) {
    $db = acme();
    $sql = 'SELECT imgId, imgPath, imgName, imgDate, inventory.invId, invName FROM Images JOIN inventory ON Images.invId = inventory.invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId);
    $stmt->execute();
    $image = $stmt->fetch();
    $stmt->closeCursor();
    return $image;
}

