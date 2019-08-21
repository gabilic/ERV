<?php

class ReportModel
{
    private $record_model;
    private $repository;
    private $report;

    public function __construct($record_model, $repository) {
        $this->record_model = $record_model;
        $this->repository = $repository;
        $this->initialize();
    }

    public function getRecordModel() {
        return $this->record_model;
    }

    public function getReport() {
        return $this->report;
    }

    public function initialize() {
        $report = $this->repository->getReportData($this->record_model->getRecords());
        $this->report = DateTimeFormatter::formatRecordsInTable($report, $this->record_model->getRecords());
    }

    public function getPersonIds() {
        $person_ids = array();
        foreach ($this->report as $item) {
            $person_ids[] = $item["person_id"];
        }
        return array_unique($person_ids);
    }
}
?>
