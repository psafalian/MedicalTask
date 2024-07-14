<?php

    class DBConnection
    {
        private static $instance;
        private $connection;
        private $readConnection;
        private $writeConnection;
        private $config;

        private function __construct()
        {
            $this->config = require 'config.php';
        }

        public static function getInstance()
        {
            if (!self::$instance) {
                self::$instance = new DBConnection();
            }
            return self::$instance;
        }

        public function connect($type = 'READ')
        {
            $host = $this->config['database']['host'];
            $dbname = $this->config['database']['dbname'];
            $username = $this->config['database']['username'];
            $password = $this->config['database']['password'];

            if ($type == 'READ') {
                if (!$this->readConnection) {
                    $this->readConnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                }
                $this->connection = $this->readConnection;
            } elseif ($type == 'WRITE') {
                if (!$this->writeConnection) {
                    $this->writeConnection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                }
                $this->connection = $this->writeConnection;
            }
            return $this->connection;
        }

        public function query($sql, $params = [])
        {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }
    }
?>
