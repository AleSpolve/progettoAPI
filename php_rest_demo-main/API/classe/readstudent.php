<?php

// required headers
/*
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
*/
// include database and object files
include_once './config/db.php';
include_once './object/classe.php';

// instantiate database and classe object
$database = new db();
$db = $database->getConnection();

// initialize object
$classe = new classe($db);
$classe->id = $id;

// query classe
$stmt = $classe->readstudents();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // classe array
    $classe_arr = array();
    $classe_arr["records"] = array();

    // retrieve table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        extract($row);
        $classe_item = array(
            "nome" => $row['nome'],
            "cognome" => $row['cognome'],
            "codice_fiscale" => $row['codice_fiscale'],
            "data_nascita" => $row['data_nascita'],
            "id_classe" => $row['id_classe']
        );
        array_push($classe_arr["records"], $classe_item);
    }
    echo json_encode($classe_arr);
} else {
    echo json_encode(
            array("message" => "No students found.")
    );
}
