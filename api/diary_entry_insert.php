<?php
require_once __DIR__ . '/../config/debugging.php';
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

// Test: curl -v -X POST -F "text=...." http://..../api/diary_entry_insert.php
