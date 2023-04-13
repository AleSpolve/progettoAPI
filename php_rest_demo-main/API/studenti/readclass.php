<?php

// required headers
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
*/
// include database and object files
include_once './config/db.php';
include_once './object/studenti.php';

// instantiate database and classe object
$database = new db();
$db = $database->getConnection();

// initialize object
$studenti = new studenti($db);
$studenti->id = $id;

// query studenti
$stmt = $studenti->readclass();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // studenti array
    $studenti_arr= array();
    $studenti_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $studenti_item = array(
            "id" => $row['id'],
            "anno" => $row['anno'],
            "sezione" => $row['sezione'],
            "spec" => $row['spec']
        );
        array_push($studenti_arr["records"], $studenti_item);
    }
    echo json_encode($studenti_arr);
} else {
    echo json_encode(
            array("message" => "No products found.")
    );
}
