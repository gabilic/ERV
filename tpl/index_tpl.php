<?php
$table_design = true;
$time_calculator = false;
require_once("header_shared.php");
?>
  <div class="card-content">
    <?php $person_header = array($this->model->getPersonModel()->getId(), $this->model->getPersonModel()->getName()); ?>
    <p><?php echo Strings::HOME_WELCOME_MESSAGE . " " . Strings::HOME_INSTRUCTIONS; ?></p>
    <h2><?php echo Strings::HOME_PERSONS; ?></h2>
    <table id="persons" class="selectable">
      <script>TableBuilder.buildTable(<?php echo json_encode($person_header) . ", " . json_encode($this->model->getPersonList()); ?>, "persons")</script>
    </table>
    <?php
    $record_header = array($this->model->getRecordModel()->getId(), $this->model->getRecordModel()->getDate(),
                           $this->model->getRecordModel()->getStart(), $this->model->getRecordModel()->getEnd());
    foreach ($this->model->getRecordModel()->getRecords() as $key => $value) {
        array_push($record_header, $key);
    }
    ?>
    <h2><?php echo Strings::HOME_LIST_OF_RECORDS; ?></h2>
    <div class="records-table">
      <table id="records" class="selectable">
        <script>TableBuilder.buildTable(<?php echo json_encode($record_header) . ", " . json_encode($this->model->getRecordList()); ?>, "records")</script>
      </table>
    </div>
    <span id="delete-confirm" style="display: none; visibility: hidden;"><?php echo Strings::BTN_DELETE_CONFIRM; ?></span>
    <div class="button-container">
      <input id="btn-new" type="button" class="button" value="<?php echo Strings::BTN_NEW_RECORD; ?>">
      <input id="btn-edit" type="button" class="button" value="<?php echo Strings::BTN_EDIT; ?>">
      <input id="btn-delete" type="button" class="button" value="<?php echo Strings::BTN_DELETE; ?>">
      <input id="btn-report" type="button" class="button" value="<?php echo Strings::BTN_REPORT; ?>">
    </div>
  </div>
<?php
$script = "index.js";
require_once("footer_shared.php");
?>
