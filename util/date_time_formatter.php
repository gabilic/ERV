<?php

abstract class DateTimeFormatter
{
    public function formatDateTime($array, $key, $value) {
        foreach ($array as &$item) {
            if ($item[$key] !== null) {
                $item[$key] = date($value, strtotime($item[$key]));
            }
        }
        return $array;
    }

    public function formatDecimalValues($array, $records) {
        foreach ($array as &$item) {
            foreach (array_keys($records) as $record) {
                $key = strtolower($record);
                if ($item[$key] !== null) {
                  $item[$key] = str_replace(".", ",", $item[$key]);
                }
            }
        }
        return $array;
    }

    public function formatRecordsInForm($array, $records) {
        $array = self::formatDateTime($array, "start", "H:i");
        return self::formatDateTime($array, "end", "H:i");
    }

    public function formatRecordsInTable($array, $records) {
        $array = self::formatDateTime($array, "date", "d.m.Y");
        $array = self::formatDecimalValues($array, $records);
        return self::formatRecordsInForm($array, $records);
    }
}
?>
