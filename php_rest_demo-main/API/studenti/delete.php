<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once './config/db.php';
include_once './object/studenti.php';

$database = new db();
$db = $database->getConnection();

// initialize object
$studenti = new studenti($db);

// set ID property of studenti to be deleted
$studenti->id = $id;

// delete the studenti
if ($studenti->delete()) {
    echo '{';
    echo '"message": "studenti was deleted."';
    echo '}';
}

// if unable to delete the studenti
else {
    echo '{';
    echo '"message": "Unable to delete studenti."';
    echo '}';
}

