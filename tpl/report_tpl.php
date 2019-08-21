<?php
$table_design = true;
$time_calculator = false;
require_once("header_shared.php");
?>
  <div class="card-content">
    <h2 style="margin-bottom: 1.5em"><?php echo Strings::REPORT_TITLE; ?></h2>
    <?php
    $record_header = array($this->model->getRecordModel()->getId(), $this->model->getRecordModel()->getDate(),
                           $this->model->getRecordModel()->getStart(), $this->model->getRecordModel()->getEnd());
    foreach ($this->model->getRecordModel()->getRecords() as $key => $value) {
        array_push($record_header, $key);
    }
    ?>
    <span id="report-total" style="display: none; visibility: hidden;"><?php echo strtoupper(Strings::REPORT_TOTAL); ?></span>
    <div class="records-table">
      <?php
      foreach ($this->model->getPersonIds() as $id) {
          $records = array();
          foreach ($this->model->getReport() as $item) {
              if ($item["person_id"] === $id) {
                  $person_name = $item["name"];
                  unset($item["person_id"]);
                  unset($item["name"]);
                  $records[] = $item;
              }
          }
          echo "<h3>{$id} - " . mb_strtoupper($person_name) . "</h3><table id=\"{$id}\", class=\"report\"></table>" .
               "<script>TableBuilder.buildReport(" . json_encode($record_header) . ", " .
               json_encode($records) . ", \"{$id}\")</script>";
      }
      ?>
    </div>
  </div>
<?php
require_once("footer_shared.php");
?>
