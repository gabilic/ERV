<?php

class HomeController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function retrieveRecords() {
        $this->model->retrieveRecords(InputValidator::testInput($_GET["id"]));
    }

    public function deleteRecord() {
        $this->model->deleteRecord(InputValidator::testInput($_GET["id"]));
    }
}
?>
