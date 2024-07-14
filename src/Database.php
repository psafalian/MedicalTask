<?php
    abstract class Database
    {
        protected $connection;

        public function __construct()
        {
            $this->connection = DBConnection::getInstance()->connect('READ');
        }

        public function connect($type = 'READ')
        {
            $this->connection = DBConnection::getInstance()->connect($type);
        }

        public function disconnect()
        {
            $this->connection = null;
        }

        public function select($sql, $params = [])
        {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert($sql, $params = [])
        {
            $this->connect('WRITE');
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $this->connection->lastInsertId();
        }

        public function delete($sql, $params = [])
        {
            $this->connect('WRITE');
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($params);
        }

        public function update($sql, $params = [])
        {
            $this->connect('WRITE');
            $stmt = $this->connection->prepare($sql);
            return $stmt->execute($params);
        }
    }
