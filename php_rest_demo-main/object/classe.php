<?php

/**
 * Description of class
 *
 * @author https://roytuts.com
 */
class classe
{

    // database connection and table name
    private $conn;
    private $table_name = "class";
    // object properties
    public $id;
    public $anno;
    public $sezione;
    public $spec;
    
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // read class
    function read()
    {
        // query to select all
        $query = "SELECT c.id, c.anno, c.sezione
            FROM
                " . $this->table_name . " c
            ORDER BY
                c.id";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    // read One class
    function readOne()
    {
        // query to select all
        $query = "SELECT c.id, c.anno, c.sezione, c.spec
            FROM
                " . $this->table_name . " c
            WHERE c.id = " . $this->id;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

    //read student on class
    function readstudents(){
        $query = "SELECT s.nome,s.cognome,s.codice_fiscale,s.data_nascita,s.id_classe
            FROM
                " . $this->table_name . " c
            JOIN students as s ON s.id_classe=c.id
            WHERE c.id = " . $this->id;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }


    // create class
    function create()
    {
        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                anno=:anno,
                sezione=:sezione,
                spec=:spec";
                
        // prepare query
        $stmt = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind values
        $stmt->bindParam(":anno", $this->anno);
        $stmt->bindParam(":sezione", $this->sezione);
        $stmt->bindParam(":spec", $this->spec);
       

        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // update the class
    function update()
    {
        // update query
        $query = "UPDATE
                " . $this->table_name . "
            SET
            anno=:anno,
            sezione=:sezione,
            spec=:spec
            WHERE
                id = :id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->anno = htmlspecialchars(strip_tags($this->anno));
        $this->sezione = htmlspecialchars(strip_tags($this->sezione));
        $this->spec = htmlspecialchars(strip_tags($this->spec));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind new values
        $stmt->bindParam(":anno", $this->anno);
        $stmt->bindParam(":sezione", $this->sezione);
        $stmt->bindParam(":spec", $this->spec);
        $stmt->bindParam(":id", $this->id);
       
        // execute the query
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // delete the class
    function delete()
    {
        // check if selected class contains students
        $query = "SELECT * FROM students WHERE id_classe = $this->id";        
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();        
       
        if (  $stmt -> rowCount() > 0 ) {
            return false;    
        } else {
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
}
