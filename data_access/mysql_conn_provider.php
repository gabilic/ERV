<?php

class MysqlConnProvider
{
    private $user;
    private $password;
    private $database;
    private $host;
    private $conn;

    public function __construct($user = "root", $password = "", $database = "erv", $host = "localhost") {
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;
        $this->conn = $this->connect();
        $this->conn->set_charset("utf8mb4");
    }

    public function __destruct() {
        $this->conn->close();
    }

    protected function connect() {
        return new mysqli($this->host, $this->user, $this->password, $this->database);
    }

    private function processRequest($query, $types, $prepared_array) {
        if ($types === null && $prepared_array === null) {
            $result = $this->conn->query($query);
        } else {
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param($types, ...$prepared_array);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        }
        return $result;
    }

    public function query($query, $types = null, $prepared_array = null) {
        $results = array();
        $result = $this->processRequest($query, $types, $prepared_array);
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        return $results;
    }

    public function upsert($query, $types = null, $prepared_array = null) {
        return $this->processRequest($query, $types, $prepared_array);
    }
}
?>
