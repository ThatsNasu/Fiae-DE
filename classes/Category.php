<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    class Category {
        private $id;
        private $parent;
        private $value;
        private $target;
        private $isUploadCategory;

        public function __construct($id, $parent, $value, $target, $uploadCategory) {
            $this->id = $id;
            $this->parent = $parent;
            $this->value = $value;
            $this->target = $target;
            $this->uploadCategory = $uploadCategory;
        }

        public function getID() {
            return $this->id;
        }

        public function getParent() {
            return $this->parent;
        }

        public function getValue() {
            return $this->value;
        }

        public function getTarget() {
            return $this->target;
        }

        public function isUploadCategory() {
            return $this->uploadCategory;
        }
    }
?>