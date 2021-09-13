<?php
	class DBManager {
	    private $host, $dbname, $login, $pass;
		private $pdo;
		
		public function __construct($host, $dbname, $login, $pass) {
			$this->host = $host;
			$this->dbname = $dbname;
			$this->login = $login;
			$this->pass = $pass;
		}
		
		public function connect() {
		    $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname, $this->login, $this->pass);
		}
		
		public function getLogin($user) {
		    $this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = ?");
			$stmt->execute(array($user));
			$row = $stmt->fetch();
			return $row;
		}
		
		public function getPrivilegeStatus($userid, $privilegeid) {
		    $this->connect();
			$stmt = $this->pdo->prepare("SELECT granted FROM userprivileges WHERE userid = ? AND privilegeid = ?");
			$values = [$userid, $privilegeid];
		    $stmt->execute($values);
			$result = $stmt->fetch();
		    return $result[0];
		}
		
		public function getPrivilege($privilege) {
		    $this->connect();
		    $stmt = $this->pdo->prepare("SELECT id FROM privileges WHERE privilege = ?");
		    $stmt->execute(array($privilege));
		    $result = $stmt->fetch();
		    return $result[0];
		}
		
		public function getUserIDByName($name) {
		    $this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM users WHERE login = ?");
			$stmt->execute(array($name));
			$result = $stmt->fetch();
			return $result['id'];
		}
		
		public function getUsernameByID($id) {
		    $this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
			$stmt->execute(array($id));
			$result = $stmt->fetch();
			return $result['name'];
		}

		public function getNavigationItems($parentID = 0) {
			$this->connect();
			if($parentID != 0) {
				$stmt = $this->pdo->prepare("SELECT * FROM navigation WHERE parent = ?");
				$stmt->execute(array($parentID));
			} else {
				$stmt = $this->pdo->prepare("SELECT * FROM navigation");
				$stmt->execute();
			}
			$result = $stmt->fetchALL();
			return $result;
		}

		public function getPageContent($target) {
			$this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM pages WHERE target = ?");
			$stmt->execute(array($target));
			$result = $stmt->fetch();
			return $result;
		}

		public function loadMetas() {
			$this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM metadata");
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getFooterNav() {
			$this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM footernav WHERE parent = 0");
			$stmt->execute();
			$result = $stmt->fetchAll();
			return $result;
		}

		public function getFooterChilds($parentNodeID) {
			$this->connect();
			$stmt = $this->pdo->prepare("SELECT * FROM footernav WHERE parent = ?");
			$stmt->execute(array($parentNodeID));
			$result = $stmt->fetchAll();
			return $result;
		}
	}
?>