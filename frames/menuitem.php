<?php
    class MenuItem {
        private $id;
        private $target;
        private $value;
        private $requiresLogin;
        private $isRoot;
        private $children;

        public function __construct($id, $target, $value, $requiresLogin, $isRoot) {
            $this->id = $id;
            $this->target = $target;
            $this->value = $value;
            $this->requiresLogin = $requiresLogin;
            $this->isRoot = $isRoot;
            $this->children = array();
        }

        public function addChild($item) {
            array_push($this->children, $item);
        }

        public function getID() {
            return $this->id;
        }

        public function getTarget() {
            return $this->target;
        }

        public function getValue() {
            return $this->value;
        }

        public function requiresLogin() {
            return $this->requiresLogin;
        }

        public function isRoot() {
            return $this->isRoot();
        }

        public function getChildren() {
            return $this->children;
        }
    }
?>