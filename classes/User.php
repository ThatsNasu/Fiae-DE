<?php
    class User {
        private $uuid;
        private $username;
        private $fullname;
        private $nickname;
        private $password;
        private $active;
        private $permissions;


        public function __construct($dataset) {
            $this->uuid = $dataset['id'];
            $this->username = $dataset['username'];
            $this->fullname = $dataset['fullname'];
            $this->nickname = $dataset['nickname'];
            $this->password = $dataset['password'];
            $this->active = $dataset['active'];
            $this->permissions = array();

            // REMOVE AFTER DEBUG
            
            $this->skills = array();
        }
        

        // -------------------- METHODS --------------------
        public function addSkill($skill) {
            if(!in_array($skill, $this->skills)) array_push($this->skills, $skill);
        }

        public function addSkills($skills) {
            foreach($skills as $skill) {
                $this->addSkill($skill);
            }
        }

        public function grantPermission($node) {
            if(!in_array($node, $this->permissions)) array_push($this->permissions, $node);
        }

        public function getPermissionByNode($node) {
            if(in_array($node, $this->permissions)) return true;
            return false;
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