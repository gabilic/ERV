<?php

class EditController
{
    private $model;

    public function __construct($model) {
        $this->model = $model;
        $this->initialize();
    }

    private function initialize() {
        if (isset($_GET["person"]) && !empty($_GET["person"])) {
            $this->model->initialize(InputValidator::testInput($_GET["person"]));

            if (isset($_GET["record"]) && !empty($_GET["record"])) {
                $this->model->retrieveRecordForEdit(InputValidator::testInput($_GET["record"]),
                                                    InputValidator::testInput($_GET["person"]));
            }
        }
    }

    public function upsertRecord() {
        foreach ($_POST as $key => $value) {
            if (isset($value) && !empty($value)) {
                $_POST[$key] = InputValidator::testInput($value);
            }
        }
        $this->model->setRecord($_POST);
        $this->model->upsertRecord();
    }
}
?>
