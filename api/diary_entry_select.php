<?php
require_once __DIR__ . '/../config/error_reporting.php';
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

$filter = $_GET['filter'] ?? '';
$controller = new diary_entry_controller();
$entries = $controller->select($filter);

echo json_encode($entries);

// Testen: curl -v -X GET http://..../api/diary_entry_select.php?filter=...