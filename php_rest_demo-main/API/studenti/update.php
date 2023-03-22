<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../../config/db.php';
include_once '../../object/studenti.php';

$database = new db();
$db = $database->getConnection();

// initialize object
$studenti = new studenti($db);

// get posted data
$data = json_decode(file_get_contents("php://input", true));

// set ID property of studenti to be updated
$studenti->id = $data->id;
// set studenti property value
$studenti->nickname = $data->nickname;
$studenti->age = $data->age;
$studenti->level = $data->level;
// update the studenti
if ($studenti->update()) {
    echo '{';
    echo '"message": "studenti was updated."';
    echo '}';
}

// if unable to update the studenti, tell the user
else {
    echo '{';
    echo '"message": "Unable to update studenti."';
    echo '}';
}
