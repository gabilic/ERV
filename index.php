<?php
include_once("resources/strings/lang.php");
include_once("resources/strings/lang-" . Languages::getSelected() . ".php");
include_once("util/date_time_formatter.php");
include_once("util/input_validator.php");
include_once("models/home_model.php");
include_once("models/person_model.php");
include_once("models/record_model.php");
include_once("controllers/home_controller.php");
include_once("data_access/mysql_conn_provider.php");
include_once("data_access/erv_repository.php");
include_once("views/home_view.php");

$erv_repository = new ErvRepository(new MysqlConnProvider);
$model = new HomeModel(new PersonModel, new RecordModel, $erv_repository);
$controller = new HomeController($model);
$view = new HomeView($controller, $model);

if (isset($_GET["action"]) && !empty($_GET["action"]) && isset($_GET["id"]) && !empty($_GET["id"])) {
    $controller->{InputValidator::testInput($_GET["action"])}();
} else {
    echo $view->output();
}
?>
