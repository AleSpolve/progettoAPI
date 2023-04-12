<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once './config/db.php';
include_once './object/classe.php';

$database = new db();
$db = $database->getConnection();

// initialize object
$classe = new classe($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set ID property of classe to be updated
$classe->id = $id;
// set classe property value
$classe->anno = $data->anno;
$classe->sezione = $data->sezione;
$classe->spec = $data->spec;
// update the classe
if ($classe->update()) {
    echo '{';
    echo '"message": "classe was updated."';
    echo '}';
}

// if unable to update the classe, tell the user
else {
    echo '{';
    echo '"message": "Unable to update classe."';
    echo '}';
}
