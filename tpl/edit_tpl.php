<?php
$table_design = false;
$time_calculator = true;
require_once("header_shared.php");
?>
  <div class="card-content narrow">
    <h2><?php echo Strings::EDIT_TITLE; ?></h2>
    <form action="edit.php" method="post">
      <table style="margin-bottom: 30px;">
        <tr>
          <td style="width: 80px;"><label for="date"><?php echo Strings::RECORD_DATE; ?>:</label></td>
          <td style="width: 170px;"><input type="date" id="date" name="date" value="<?php
          echo (isset($this->model->getRecord()["date"]) ? $this->model->getRecord()["date"] : date("Y-m-d")); ?>" required></td>
        </tr><tr>
          <td><label for="person"><?php echo Strings::RECORD_PERSON; ?>:</label></td>
          <td><input type="text" id="person" name="person" value="<?php echo $this->model->getPersonModel()->getName(); ?>" disabled></td>
        </tr><tr>
          <td><label for="start"><?php echo Strings::RECORD_START; ?>:</label></td>
          <td><input type="time" id="start" name="start" value="<?php
          echo (isset($this->model->getRecord()["start"]) ? $this->model->getRecord()["start"] : date("H:i")); ?>"></td>
          <td rowspan="2" style="position: relative; width: 616px;">
            <fieldset style="bottom: 1px; height: 42px; position: absolute; width: 100%;">
              <legend><?php echo Strings::RECORD_TOTAL_HOURS; ?></legend>
              <span id="total_hours"></span>
              <span id="total_hours_error" style="display: none; visibility: hidden;"><?php echo Strings::RECORD_TOTAL_HOURS_ERROR; ?></span>
            </fieldset>
          </td>
        </tr><tr>
          <td><label for="end"><?php echo Strings::RECORD_END; ?>:</label></td>
          <td><input type="time" id="end" name="end" value="<?php
          echo (isset($this->model->getRecord()["end"]) ? $this->model->getRecord()["end"] : date("H:i")); ?>"></td>
        </tr>
        <?php
        $records_array = array_keys($this->model->getRecordModel()->getRecords());
        foreach ($records_array as $key) {
            echo "<tr><td><label for=\"" . strtolower($key) . "\">{$key}:</label></td>" .
                 "<td><input type=\"number\" id=\"" . strtolower($key) . "\" name=\"" . strtolower($key) .
                 "\" min=\"0\" step=\".01\" value=\"" . (isset($this->model->getRecord()[strtolower($key)]) ?
                 $this->model->getRecord()[strtolower($key)] : "") . "\"></td>";
            if ($key === "K5") {
                echo "<td rowspan=\"" . (count($records_array) - 1) . "\" style=\"position: relative;\">";
                require_once("records_tpl.php");
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
      </table>
      <input type="text" id="record_id" name="record_id" style="display: none; visibility: hidden;" value="<?php
      echo (isset($this->model->getRecord()["id"]) ? $this->model->getRecord()["id"] : ""); ?>">
      <input type="text" id="person_id" name="person_id" style="display: none; visibility: hidden;" value="<?php
      echo (isset($this->model->getRecord()["person_id"]) ? $this->model->getRecord()["person_id"] : ""); ?>">
      <div class="button-container">
        <input id="btn-accept" type="submit" class="button" value="<?php echo Strings::BTN_ACCEPT; ?>">
      </div>
    </form>
  </div>
<?php
$script = "edit.js";
require_once("footer_shared.php");
?>
