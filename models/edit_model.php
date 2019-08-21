<?php

class EditModel
{
    private $person_model;
    private $record_model;
    private $record;
    private $repository;

    public function __construct($person_model, $record_model, $repository) {
        $this->person_model = $person_model;
        $this->record_model = $record_model;
        $this->repository = $repository;
    }

    public function getPersonModel() {
        return $this->person_model;
    }

    public function getRecordModel() {
        return $this->record_model;
    }

    public function getRecord() {
        return $this->record;
    }

    public function setRecord($record) {
        $this->record = $record;
    }

    public function initialize($person) {
        $this->person_model->setName($this->repository->getPersonName($person));
        $this->record["person_id"] = $person;
    }

    public function retrieveRecordForEdit($record_id, $person_id) {
        $record_keys = $this->record_model->getRecords();
        $record = $this->repository->getRecordById($record_keys, $record_id, $person_id);
        $this->record = (DateTimeFormatter::formatRecordsInForm($record, $record_keys))[0];
    }

    public function upsertRecord() {
        $this->repository->upsertRecord($this->record, $this->record_model->getRecords());
        header("Location: index.php");
        exit();
    }
}
?>
