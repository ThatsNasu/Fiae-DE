<?php
    class Category {
        private $id;
        private $parent;
        private $label;
        private $target;
        private $inMainNavigation;
        private $inFooter;
        private $isUploadCategory;
        private $requiresLogin;


        public function __construct($id, $parent, $label, $target, $inMainNavigation, $inFooter, $uploadCategory, $requiresLogin) {
            $this->id = $id;
            $this->parent = $parent;
            $this->label = $label;
            $this->target = $target;
            $this->inMainNavigation = $inMainNavigation;
            $this->inFooter = $inFooter;
            $this->uploadCategory = $uploadCategory;
            $this->requiresLogin = $requiresLogin;
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

        public function inMainNavigation() {
            return $this->inMainNavigation;
        }

        public function inFooter() {
            return $this->inFooter;
        }

        public function isUploadCategory() {
            return $this->uploadCategory;
        }

        public function requiresLogin() {
            return $this->requiresLogin;
        }
    }
?>