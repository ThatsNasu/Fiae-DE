<?php
    class MenuItem {
        private $id;
        private $value;
        private $target;
        private $cssClass;
        private $childs;
        private $inMainMenu;
        private $inFooter;
        private $requiresLogin;


        private $child;

        public function __construct($id, $parent, $value, $target, $cssClass, $inMainMenu, $inFooter, $requiresLogin, $result) {
            $this->id = $id;
            $this->value = $value;
            $this->target = $target;
            $this->cssClass = $cssClass;
            $this->inMainMenu = $inMainMenu;
            $this->inFooter = $inFooter;
            $this->requiresLogin = $requiresLogin;
            $this->childs = array();
            foreach($result as $row) {
			    if($row['parent'] == $this->id) array_push($this->childs, new MenuItem($row['id'], $row['parent'], $row['value'], $row['target'], $row['cssClass'], $row['inMainNavigation'], $row['inFooter'], $row['requiresLogin'], $result));
		    }
        }

        // -------------------- GETTER --------------------
        public function getID() {
            return $this->id;
        }
        
        public function getValue() {
            return $this->value;
        }

        public function getTarget() {
            return $this->target;
        }

        public function getCSSClass() {
            return $this->cssClass;
        }

        public function inMainMenu() {
            return $this->inMainMenu;
        }

        public function inFooter() {
            return $this->inFooter;
        }

        public function requiresLogin() {
            return $this->requiresLogin;
        }

        public function getChilds() {
            return $this->childs;
        }

        public function hasChildren() {
            if(sizeof($this->childs) == 0) return false;
            return true;
        }

        public function showChildren($roottarget) {
            foreach($this->childs as $child) {
                $this->child .= '<li class="'.$child->getCSSClass().'"style="padding-left: 10px; list-style: none;"><a href="'.$roottarget.$child->getTarget().'">'.$child->getValue().'</a>';
                if($child->hasChildren()) {
                    $this->child .= '<ul style="padding-left: 10px; list-style: none;">';
                    $this->child .= $child->showChildren($roottarget.$child->getTarget());
                    $this->child .= '</ul>';
                }
                $this->child .= '</li>';
            }
		    return $this->child;
	    }
    }
?>