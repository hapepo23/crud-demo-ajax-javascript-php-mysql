<?php
require_once __DIR__ . '/../app/bootstrap.php';
use app\controllers\diary_entry_controller;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $text = trim($_POST['text'] ?? '');
    if (!$text) {
        echo json_encode(['success'=>false, 'error'=>'Text darf nicht leer sein']);
        exit;
    }
    if (!$id) {
        echo json_encode(['success'=>false,'error'=>'Ungültige ID']);
        exit;
    }
    $controller = new diary_entry_controller();
    $result = $controller->update($id,$text);
    echo json_encode(['success'=>$result]);
}

// Testen: curl -v -X POST -F "id=.." -F "text=...." http://..../api/diary_entry_update.php
