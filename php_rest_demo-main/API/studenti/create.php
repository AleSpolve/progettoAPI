<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once './config/db.php';
include_once './object/studenti.php';

$database = new db();
$db = $database->getConnection();

// initialize object
$studenti = new studenti($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set studenti property value
$studenti->name = $data->name;
$studenti->cognome = $data->cognome;
$studenti->codiceFiscale = $data->codiceFiscale;
// create the studenti
if ($studenti->create()) {
    echo '{';
    echo '"message": "studenti was created."';
    echo '}';
}

// if unable to create the studenti, tell the user
else {
    echo '{';
    echo '"message": "Unable to create studenti."';
    echo '}';
}