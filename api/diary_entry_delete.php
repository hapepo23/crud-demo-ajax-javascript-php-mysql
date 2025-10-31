<?php
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    if (!$id) {
        echo json_encode(['success'=>false, 'error'=>'Invalid or missing ID']);
        exit;
    }
    $controller = new diary_entry_controller();
    $result = $controller->delete($id);
    echo json_encode(['success'=>$result]);
}

// Testen: curl -v -X POST -F "id=.." http://..../api/diary_entry_delete.php
