<?php
    class MenuItem {
        private $id;
        private $parent;
        private $value;
        private $target;
        private $children;
        private $requiresLogin;
        private $navigationPositions;

        public function __construct($id, $parent, $value, $target, $requiresLogin) {
            $this->children = array();
            $this->navigationPositions = array();
            $this->id = $id;
            $this->parent = $parent;
            $this->value = $value;
            $this->target = $target;
            $this->requiresLogin = $requiresLogin;
        }

        // -------------------- METHODS --------------------

        public function addNavigationPosition($navigationPosition) {
            if(!in_array($navigationPosition, $this->navigationPositions)) array_push($this->navigationPositions, $navigationPosition);
        }

        public function addChild($child) {
            if(!in_array($child, $this->childs)) array_push($this->childs, $child);
        }

        public function renderItem($navigationPosition, $parenttarget = '') {
            $tree = '';
            if(!in_array($navigationPosition, $this->navigationPositions)) return;
            $tree .= '<li><a href="'.$parenttarget.$this->target.'">'.$this->value.'</a>';
            $string = '';
            foreach($this->children as $child) {
                $string .= $child->renderItem($navigationPosition, $parenttarget.$this->target);
            }
            if($string !== '') $tree .= '<ul>'.$string.'</ul>';
            $tree .=  '</li>';
            return $tree;
        }

        // -------------------- GETTER --------------------
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

        public function requiresLogin() {
            return $this->requiresLogin;
        }

        // -------------------- SETTER --------------------

        public function setChildren($children) {
            $this->children = $children;
        }
    }
?>