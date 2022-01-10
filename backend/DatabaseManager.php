<?php
    class DatabaseManager {
        private $host;
        private $database;
        private $login;
        private $password;
        private $pdo;

        public function __construct($host, $database, $login, $password) {
			$this->host = $host;
			$this->database = $database;
			$this->login = $login;
			$this->password = $password;
		}

        private function connect() {
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->login, $this->password);
        }

        public function getUserData($username) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute(array($username));
            $row = $stmt->fetch();
            return $row;
        }

        public function getPermission($node) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM permissions WHERE node = ?");
            $stmt->execute(array($node));
            return $stmt->fetch();
        }

        public function getUserPermission($permissionid, $userid) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM userpermissions WHERE permissionid = ? AND userid = ?");
            $stmt->execute(array($permissionid, $userid));
            return $stmt->fetch();
        }

        public function getMenuEntries() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM navigation ORDER BY target ASC");
            $stmt->execute(array());
            return $stmt->fetchAll();
        }
    }
?>