<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once './config/db.php';
include_once './object/classe.php';

$database = new db();
$db = $database->getConnection();

// initialize object
$classe = new classe($db);

// set ID property of classe to be deleted
$classe->id = $id;

// delete the classe
if ($classe->delete()) {
    echo '{';
    echo '"message": "classe ' . $id . ' was deleted."';
    echo '}';
}

// if unable to delete the classe
else {
    echo '{';
    echo '"message": "Unable to delete classe."';
    echo '}';
}

