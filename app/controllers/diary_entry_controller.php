<?php
namespace app\controllers;
use app\models\diary_entry;

class diary_entry_controller {

    private $diary_entry;

    public function __construct(){
        $this->diary_entry = new diary_entry();
    }

    public function insert($text){
        return $this->diary_entry->insert($text);
    }

    public function select(){
        return $this->diary_entry->select();
    }

    public function update($id,$text){
        return $this->diary_entry->update($id,$text);
    }

    public function delete($id){
        return $this->diary_entry->delete($id);
    }
    
}
