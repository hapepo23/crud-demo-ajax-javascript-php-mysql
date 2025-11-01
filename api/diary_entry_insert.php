<?php
require_once __DIR__ . '/../config/error_reporting.php';
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['text'] ?? '');
    if (!$text) {
        echo json_encode(['success'=>false, 'error'=>'Diary Entry must not be empty']);
        exit;
    }
    $controller = new diary_entry_controller();
    $result = $controller->insert($text);
    echo json_encode(['success'=> $result]);
}

// Testen: curl -v -X POST -F "text=...." http://..../api/diary_entry_insert.php
