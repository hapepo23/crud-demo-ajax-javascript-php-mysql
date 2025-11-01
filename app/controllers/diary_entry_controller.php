<?php
namespace app\controllers;
use app\models\diary_entry;
require_once __DIR__ . '/../../config/error_reporting.php';

class diary_entry_controller {

    private $diary_entry;

    public function __construct(){
        $this->diary_entry = new diary_entry();
    }

    public function insert($text){
        return $this->diary_entry->insert($text);
    }

    public function select($filter=""){
        return $this->diary_entry->select($filter);
    }

    public function update($id, $text){
        return $this->diary_entry->update($id,$text);
    }

    public function delete($id){
        return $this->diary_entry->delete($id);
    }
    
}
