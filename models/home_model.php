<?php

class HomeModel
{
    private $person_model;
    private $record_model;
    private $person_list;
    private $record_list;
    private $repository;

    public function __construct($person_model, $record_model, $repository) {
        $this->person_model = $person_model;
        $this->record_model = $record_model;
        $this->repository = $repository;
        $this->initialize();
    }

    public function getPersonModel() {
        return $this->person_model;
    }

    public function getRecordModel() {
        return $this->record_model;
    }

    public function getPersonList() {
        return $this->person_list;
    }

    public function getRecordList() {
        return $this->record_list;
    }

    public function initialize() {
        $this->person_list = $this->repository->getPersonList();
    }

    public function retrieveRecords($id) {
        $record_keys = $this->record_model->getRecords();
        $records = $this->repository->getRecordList($record_keys, $id);
        echo json_encode(DateTimeFormatter::formatRecordsInTable($records, $record_keys));
    }

    public function deleteRecord($id) {
        echo $this->repository->deleteRecord($id);
    }
}
?>
