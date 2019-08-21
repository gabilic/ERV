<?php

abstract class InputValidator
{
    public function testInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
}
?>
