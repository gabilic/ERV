<?php

class HomeView
{
    private $controller;
    private $model;

    public function __construct($controller, $model) {
        $this->controller = $controller;
        $this->model = $model;
    }

    public function output() {
        require_once("tpl/index_tpl.php");
    }
}
?>
