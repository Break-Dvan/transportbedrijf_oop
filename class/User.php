<?php
class User {
    // database connection and table name
    private $conn;
    private $table_name = "gebruiker";
    //object properties
    public $id;
    public $inlognaam;
    public $wachtwoord;
    public $rol_id;

    public function __construct($db){
        $this->conn = $db;
    }
    public function readAll($from_record_num, $records_per_page){
        //$qryLimit = "LIMIT " .$from_record_num.",". $records_per_page.";";
    // ophalen gebruikers uit database
        // select query
        $query="SELECT id, inlognaam, wachtwoord, rol_id, (SELECT naam FROM rol where id=rol_id) as rol
                FROM " . $this->table_name . "
                ORDER BY inlognaam
  				LIMIT
					?, ?";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // bind variable values
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }
    public function insertUser($inlognaam, $wachtwoord, $rol_id) {
        $qryInsertUser = "INSERT INTO ". $this->table_name . "
                    (inlognaam, wachtwoord, rol_id)
                    values(:inlognaam, :wachtwoord, :rol_id)
                    ";
        $stmt=$this->conn->prepare($qryInsertUser);
        //bind variable values
        $stmt->bindParam(':inlognaam', $inlognaam, PDO::PARAM_STR);
        $stmt->bindParam(':wachtwoord', $wachtwoord, PDO::PARAM_STR);
        $stmt->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);

        $affectedRows = $stmt->execute();
        return $affectedRows;
    }

    public function editUser($id, $inlognaam, $wachtwoord, $role_id)
    {
        $queryUpdate = "UPDATE {$this->table_name} SET inlognaam = :inlognaam, wachtwoord = :wachtwoord, rol_id = :rol_id WHERE id = :id;";

        try {
//            echo "Inlognaam: $inlognaam, wachtwoord: $wachtwoord <br>";
            $stmt = $this->conn->prepare($queryUpdate);
            $stmt->bindParam(':inlognaam', $inlognaam, PDO::PARAM_STR);
            $stmt->bindParam(':wachtwoord', $wachtwoord, PDO::PARAM_STR);
            $stmt->bindParam(':rol_id', $role_id, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function editUserWerkt($id, $inlognaam, $wachtwoord, $role_id)
    {
        $queryUpdate = "UPDATE {$this->table_name} SET inlognaam = ?, wachtwoord = ?, rol_id = ? WHERE id = ?;";

        try {
            $stmt = $this->conn->prepare($queryUpdate);
            $stmt->execute([
                $inlognaam,
                $wachtwoord,
                $role_id,
                $id
            ]);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getUser(int $id)
    {
        $query = "SELECT id, inlognaam, rol_id, wachtwoord FROM {$this->table_name} WHERE id = ? LIMIT 1;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt;
    }
    public function deleteUser($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id;";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function countUsers() {
        $sql_count = "SELECT count(id) as aantal FROM gebruiker;";
        $stmt = $this->conn->prepare($sql_count);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row=$stmt->fetch();
        $total_rows=$row['aantal'];
        return $total_rows;
    }
}

?>