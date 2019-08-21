<?php

class ErvRepository
{
    private $conn_provider;

    public function __construct($conn_provider) {
        $this->conn_provider = $conn_provider;
    }

    public function getPersonList() {
        return $this->conn_provider->query("SELECT id, name FROM person");
    }

    public function getPersonName($id) {
        return ($this->conn_provider->query("SELECT name FROM person WHERE id = ?", "i", array($id)))[0]["name"];
    }

    public function getRecordById($records, $record_id, $person_id) {
        return $this->conn_provider->query("SELECT id, date, start, end, " .
               strtolower(implode(", ", array_keys($records))) . ", person_id FROM record WHERE id = ? AND person_id = ?",
               "ii", array($record_id, $person_id));
    }

    public function getRecordList($records, $id) {
        return $this->conn_provider->query("SELECT id, date, start, end, " .
               strtolower(implode(", ", array_keys($records))) . " FROM record WHERE person_id = ?", "i", array($id));
    }

    public function getReportData($records) {
        return $this->conn_provider->query("SELECT r.id, date, start, end, " .
               strtolower(implode(", ", array_keys($records))) . ", person_id, name FROM record r JOIN person p ON p.id = person_id");
    }

    public function deleteRecord($id) {
        return $this->conn_provider->query("DELETE FROM record WHERE id = ?", "i", array($id));
    }

    public function upsertRecord($record, $record_keys) {
        foreach ($record as $key => $value) {
            if (empty($value)) {
                $record[$key] = null;
            }
        }
        $record_id_present = isset($record["record_id"]) && !empty($record["record_id"]);
        $number_of_arguments = count($record_keys) + 4 + ($record_id_present ? 1 : 0);
        $arguments = array($record["date"], $record["start"], $record["end"]);
        foreach (array_keys($record_keys) as $key) {
            array_push($arguments, $record[strtolower($key)]);
        }
        array_push($arguments, $record["person_id"]);
        if ($record_id_present) {
            array_unshift($arguments, $record["record_id"]);
        }
        return $this->conn_provider->upsert("REPLACE INTO record (" . ($record_id_present ? "id, " : "") . "date, start, end, " .
               strtolower(implode(", ", array_keys($record_keys))) . ", person_id) VALUES (" .
               implode(", ", array_fill(0, $number_of_arguments, "?")) . ")", ($record_id_present ? "i" : "") .
               "sss" . str_repeat("d", count($record_keys)) . "i", $arguments);
    }
}
?>
