<?php
    class User {
        private $uuid;
        private $username;
        private $fullname;
        private $nickname;
        private $password;
        private $active;


        public function __construct($dataset) {
            $this->uuid = $dataset['id'];
            $this->username = $dataset['username'];
            $this->fullname = $dataset['fullname'];
            $this->nickname = $dataset['nickname'];
            $this->password = $dataset['password'];
            $this->active = $dataset['active'];
        }

        public function getUUID() {
            return $this->uuid;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getFullname() {
            return $this->fullname;
        }

        public function getNickname() {
            return $this->nickname;
        }

        public function getPassword() {
            return $this->password;
        }

        public function isActive() {
            return $this->active;
        }
    }
?>