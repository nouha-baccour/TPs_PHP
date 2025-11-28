<?php
class Model {
    protected $table;
    protected $db;

    public function __construct($db, $table) {
        $this->db = $db;
        $this->table = $table;
    }

    public function save($data) {
        try {
            if (isset($data['code'])) {
                // Update an existing record
                $columns = array_keys($data);
                $sets = [];
                $i=0;
                foreach ($columns as $column) {
                    $sets[$i] = "$column = :$column";
                    $i++;
                }
                $setString = implode(', ', $sets);

                $sql = "UPDATE $this->table SET $setString WHERE code = :code";
            } else {
                // Insert a new record
                $columns = implode(', ', array_keys($data));
                $placeholders = ':' . implode(', :', array_keys($data));
                $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo("Error saving data: " . $e->getMessage());
            return false;
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error saving data: " . $e->getMessage());
        }
    }

    public function find($code) {
        try {
            $sql = "SELECT * FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error finding data: " . $e->getMessage());
        }
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error finding data: " . $e->getMessage());
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error finding all data: " . $e->getMessage());
        }
    }

    public function create($data) {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Error creating data: " . $e->getMessage());
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error creating data: " . $e->getMessage());
        }
    }

    public function update($code, $data) {
        try {
            $data['code'] = $code;
            $columns = array_keys($data);
            $sets = [];
            $i = 0;
            foreach ($columns as $column) {
                $sets[$i] = "$column = :$column";
                $i++;
            }
            $setString = implode(', ', $sets);

            $sql = "UPDATE $this->table SET $setString WHERE code = :code";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            echo("Error updating data: " . $e->getMessage());
            return false;
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error updating data: " . $e->getMessage());
        }
    }

    public function delete($code) {
        try {
            $sql = "DELETE FROM $this->table WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['code' => $code]);
            return true;
        } catch (PDOException $e) {
            echo("Error deleting data: " . $e->getMessage());
            return flase;
            // Handle database-related exceptions, e.g., connection errors, SQL errors
            // You can log the error or perform other actions as needed
            // Throw or return an error message or response if necessary
            // Example: throw new Exception("Error deleting data: " . $e->getMessage());
        }
    }

    public function customQuery($sql){
        try {
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error selecting data: " . $e->getMessage());
            // Handle exceptions, log errors, or throw exceptions as needed
        }
    }
    public function join($table1, $table2, $joinCondition, $columns = '*', $where = '', $params = array()) {
        $query = "SELECT $columns FROM $table1
                  JOIN $table2 ON $joinCondition";
        if (!empty($where)) {
            $query .= " WHERE $where";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
