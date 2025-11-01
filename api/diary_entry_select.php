<?php
require_once __DIR__ . '/../config/debugging.php';
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filter = $_POST['filter'] ?? '';
    $controller = new diary_entry_controller();
    $entries = $controller->select($filter);
    echo json_encode($entries);
}

// Test: curl -v -X POST -F "filter=...." http://..../api/diary_entry_select.php
