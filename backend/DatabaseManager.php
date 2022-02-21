<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
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

        public function getUsers() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function updateUser($userid, $field, $value) {
            $this->connect();
            $stmt = $this->pdo->prepare("UPDATE users set $field = ? WHERE id = ?");
            return $stmt->execute(array($value, $userid));
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

        public function getRecentUploads() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM files ORDER BY id DESC LIMIT 10");
            $stmt->execute();
            return $stmt->fetchAll();
        }
        
        public function getRecentNews() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 5");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getCategories() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM navigation ORDER BY value ASC");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getCategoriesByParent($parent = '/') {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT id FROM navigation WHERE value = ?");
            $stmt->execute(array($parent));
            $result = $stmt->fetch();
            $stmt = $this->pdo->prepare("SELECT * FROM navigation WHERE parent = ? ORDER BY value ASC");
            $stmt->execute(array($result['id']));
            return $stmt->fetchAll();
        }

        public function getCategoryByName($name = "Home") {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM navigation WHERE value = ?");
            $stmt->execute(array($name));
            return $stmt->fetch();
        }

        public function getFilesByCategory($category, $offset = 0) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM files WHERE category = :cat ORDER BY created DESC, id DESC LIMIT 25 OFFSET :offset");
            $stmt->bindValue(':cat', $category, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        }
      
        public function getFileByID($fileID) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM files WHERE id = ?");
            $stmt->execute(array($fileID));
            return $stmt->fetch();
        }
      
        public function insertNewFile($filename, $filesize, $creator, $category) {
            $this->connect();
            $stmt = $this->pdo->prepare("INSERT INTO files (filename, filesize, creatorid, category) VALUES (?, ?, ?, ?)");
            $stmt->execute(array($filename, $filesize, $creator, $category));
        }

        public function getFileCountByCategory($catgeoryID) {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT COUNT(id) FROM files WHERE category = ?");
            $stmt->execute(array($catgeoryID));
            return $stmt->fetch()[0];
        }

        public function getCarousselMessages() {
            $this->connect();
            $stmt = $this->pdo->prepare("SELECT * FROM messagecaroussel ORDER BY id DESC LIMIT 5");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>