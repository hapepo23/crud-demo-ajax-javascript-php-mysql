<?php
namespace app\core;
require_once __DIR__ . '/../../config/error_reporting.php';

class database {
    protected $conn;

    public function __construct() {
        $config = require __DIR__ . '/../../config/config.php';
        $this->conn = new \mysqli($config['host'], $config['user'], $config['pass'], $config['dbname']);
    }

}
