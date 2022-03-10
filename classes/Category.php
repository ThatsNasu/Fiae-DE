<?php
    class Category {
        private $id;
        private $parent;
        private $label;
        private $target;
        private $isUploadCategory;

        public function __construct($id, $parent, $label, $target, $uploadCategory) {
            $this->id = $id;
            $this->parent = $parent;
            $this->label = $label;
            $this->target = $target;
            $this->uploadCategory = $uploadCategory;
        }

        public function getID() {
            return $this->id;
        }

        public function getParent() {
            return $this->parent;
        }

        public function getLabel() {
            return $this->label;
        }

        public function getTarget() {
            return $this->target;
        }

        public function isUploadCategory() {
            return $this->uploadCategory;
        }
    }
?>