<?php
class Role {
    private $id;
    public $inlognaam;
    public $rol_id;
    public $rol;

    public function __construct($db){
        $this->conn = $db;
    }
    public function readRoleAll() {
        $qryRol = "SELECT id, naam FROM rol
                    ORDER BY naam";
        // prepare query statement
        $stmt = $this->conn->prepare( $qryRol );

        // bind variable values n.v.t.

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }



}