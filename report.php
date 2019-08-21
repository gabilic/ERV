<?php
include_once("resources/strings/lang.php");
include_once("resources/strings/lang-" . Languages::getSelected() . ".php");
include_once("util/date_time_formatter.php");
include_once("models/report_model.php");
include_once("models/record_model.php");
include_once("controllers/report_controller.php");
include_once("data_access/mysql_conn_provider.php");
include_once("data_access/erv_repository.php");
include_once("views/report_view.php");

$erv_repository = new ErvRepository(new MysqlConnProvider);
$model = new ReportModel(new RecordModel, $erv_repository);
$controller = new ReportController($model);
$view = new ReportView($controller, $model);

echo $view->output();
?>
