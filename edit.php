<?php
include_once("resources/strings/lang.php");
include_once("resources/strings/lang-" . Languages::getSelected() . ".php");
include_once("util/date_time_formatter.php");
include_once("util/input_validator.php");
include_once("models/edit_model.php");
include_once("models/person_model.php");
include_once("models/record_model.php");
include_once("controllers/edit_controller.php");
include_once("data_access/mysql_conn_provider.php");
include_once("data_access/erv_repository.php");
include_once("views/edit_view.php");

$erv_repository = new ErvRepository(new MysqlConnProvider);
$model = new EditModel(new PersonModel, new RecordModel, $erv_repository);
$controller = new EditController($model);
$view = new EditView($controller, $model);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller->upsertRecord();
}

echo $view->output();
?>
