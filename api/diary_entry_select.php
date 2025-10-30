<?php
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

$controller = new diary_entry_controller();
$entries = $controller->select();
echo json_encode($entries);

// Testen: curl -v -X POST http://..../api/diary_entry_select.php