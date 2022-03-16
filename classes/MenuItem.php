<?php
    if(strpos($_SERVER['REQUEST_URI'], '.')) header("Location: /");
    class MenuItem {
        private $id;
        private $parent;
        private $label;
        private $target;
        private $children;
        private $requiresLogin;
        private $navigationPositions;

        public function __construct($id, $parent, $label, $target, $requiresLogin) {
            $this->children = array();
            $this->navigationPositions = array();
            $this->id = $id;
            $this->parent = $parent;
            $this->label = $label;
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
            $tree .= '<li><a href="'.$parenttarget.$this->target.'">'.$this->label.'</a>';
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
        
        public function getLabel() {
            return $this->label;
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