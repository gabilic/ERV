<?php

abstract class Languages
{
    const HR = "hr";

    private static $selected = self::HR;

    public static function getSelected() {
        return self::$selected;
    }
}
?>
