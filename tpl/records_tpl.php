<fieldset style="bottom: 1px; position: absolute; width: 100%;">
  <legend><?php echo Strings::RECORD_DESCRIPTION; ?></legend>
  <?php
  foreach ($records_array as $key) {
      echo "<span>" . ($key === "K5A" || $key === "K5B" ? "&nbsp;&nbsp;" : "") .
           "{$key} - " . constant("Strings::RECORD_{$key}") . "</span><br>";
  }
  ?>
</fieldset>
