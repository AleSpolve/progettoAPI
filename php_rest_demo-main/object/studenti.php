<?php

/**
 * Description of Department
 *
 * @author https://roytuts.com
 */
class studenti
{

    // database connection and table name
    private $conn;
    private $table_name = "students";
    // object properties
    public $id;
    public $name;
    public $cognome;
    public $codiceFiscale;
    public $dataNascita;
    public $idClasse;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read students
    function read()
    {
        // query to select all
        $query = "SELECT s.id, s.name
            FROM
                " . $this->table_name . " s
            ORDER BY
                s.id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create students
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name,
                cognome=:cognome,
                codice_fiscale=:codice_fiscale
                data_nascita=:data_nascita
                id_classe=:id_classe";
                
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":cognome", $this->cognome);
        $stmt->bindParam(":codice_fiscale", $this->codiceFiscale);
        $stmt->bindParam(":data_nascita", $this->dataNascita);
        $stmt->bindParam(":id_classe", $this->idClasse);


        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // update the students
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            name=:name,
            cognome=:cognome,
            codice_fiscale=:codice_fiscale
            data_nascita=:data_nascita
            id_classe=:id_classe
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':cognome', $this->cognome);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':codice_fiscale', $this->codiceFiscale);
        $stmt->bindParam(':data_nascita', $this->dataNascita);
        $stmt->bindParam(':id_classe', $this->idClasse);
        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the students
    function delete()
    {
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind id of record to delete
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
