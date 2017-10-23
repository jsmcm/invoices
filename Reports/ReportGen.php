<?php
$StartDate = $_POST["StartDate"];
$EndDate = $_POST["EndDate"];
$ReportType = $_POST["ReportType"];

header("Location: ".$ReportType.".php?StartDate=".$StartDate."&EndDate=".$EndDate);
?>
