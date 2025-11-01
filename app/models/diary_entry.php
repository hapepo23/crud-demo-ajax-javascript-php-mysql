<?php
namespace app\models;
use app\core\database;
require_once __DIR__ . '/../../config/error_reporting.php';

class diary_entry extends database {

    public function insert($text){
        $stmt = $this->conn->prepare("INSERT INTO diaryentries (detext) VALUES (?)");
        $stmt->bind_param("s",$text);
        return $stmt->execute();
    }

    public function select($filter = '') {
        if ($filter) {
            $stmt = $this->conn->prepare("SELECT deid,dedate,detext FROM diaryentries WHERE dedate LIKE ? OR detext LIKE ? ORDER BY deid DESC");
            $param1 = '%' . $filter . '%';
            $param2 = '%' . $filter . '%';
            $stmt->bind_param("ss",$param1,$param2);
            $stmt->execute();
            $res = $stmt->get_result();
        } else {
            $res = $this->conn->query("SELECT deid,dedate,detext FROM diaryentries ORDER BY deid DESC");
        }
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function update($id,$text){
        $stmt = $this->conn->prepare("UPDATE diaryentries SET detext=? WHERE deid=?");
        $stmt->bind_param("si", $text, $id);
        return $stmt->execute();
    }

    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM diaryentries WHERE deid=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

}
