<?php
namespace app\core;

class database {
    protected $conn;

    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $this->conn = new \mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
    }

}
