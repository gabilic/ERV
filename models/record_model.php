<?php

class RecordModel
{
    private $id;
    private $date;
    private $start;
    private $end;
    private $records;

    public function __construct() {
        $this->id = Strings::RECORD_ID;
        $this->date = Strings::RECORD_DATE;
        $this->start = Strings::RECORD_START;
        $this->end = Strings::RECORD_END;
        $this->generateRecords();
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStart() {
        return $this->start;
    }

    public function getEnd() {
        return $this->end;
    }

    public function getRecords() {
        return $this->records;
    }

    private function generateRecords() {
        for ($i = 4; $i <= 21; $i++) {
            $this->records["K{$i}"] = "";
            if ($i === 5 || $i === 7 || $i === 9) {
                $this->records["K{$i}A"] = "";
            }
            if ($i === 5) {
                $this->records["K{$i}B"] = "";
            }
        }
    }
}
?>
