<?php
    require_once('./frames/menuitem.php');
    class Navigation {
        private $mainMenuItems;
        private $userIsLoggedIn;

        public function __construct($dbresult) {
            $this->mainMenuItems = array();
            $this->parseItemList($dbresult);
            $this->userIsLoggedIn = false;
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])) $this->userIsLoggedIn = true;
        }

        private function parseItemList($dbresult) {
            for($i = 0; $i < sizeof($dbresult); $i++) {
                $element = $dbresult[$i];
                $requiresLogin = false;
                if($element['requiresLogin'] == 1) $requiresLogin = true;
                if($element['parent'] == 0) {
                    $item = new MenuItem($element['id'], $element['target'], $element['value'], $requiresLogin, true);
                    array_push($this->mainMenuItems, $item);
                } else {
                    $item = new MenuItem($element['id'], $element['target'], $element['value'], $requiresLogin, false);
                    $this->mainMenuItems[$element['parent']-1]->addChild($item);
                }
            }
        }

        public function getNavigation() {
            $build = '<nav>';
            foreach($this->mainMenuItems as $mainMenuItem) {
                if(!$mainMenuItem->requiresLogin()) {
                    $build .= '<div class="mainMenuButton"><a href="';
                    $build .= $mainMenuItem->getTarget();
                    $build .= '">';
                    $build .= $mainMenuItem->getValue();
                    $build .= '</a>';
                    if(sizeof($mainMenuItem->getChildren()) != 0) {
                        $build += '<div>';
                        foreach($mainMenuItem->getChildren() as $child) {
                            $build .= '<div class="childMenuItem"><a href="';
                            $build .= $child->getTarget();
                            $build .= '">';
                            $build .= $child->getValue();
                            $build .= '</a></div>';
                        }
                        $build .= '</div>';
                    }
                    $build .= '</div>';
                } elseif ($this->userIsLoggedIn) {
                    $build .= '<div class="mainMenuButton"><a href="';
                    $build .= $mainMenuItem->getTarget();
                    $build .= '">';
                    $build .= $mainMenuItem->getValue();
                    $build .= '</a>';
                    if(sizeof($mainMenuItem->getChildren()) != 0) {
                        $build .= '<div>';
                        foreach($mainMenuItem->getChildren() as $child) {
                            $build .= '<div class="childMenuItem"><a href="';
                            $build .= $child->getTarget();
                            $build .= '">';
                            $build .= $child->getValue();
                            $build .= '</a></div>';
                        }
                        $build .= '</div>';
                    }
                    $build .= '</div>';
                }
            }
            $build .= '</nav>';
            return $build;
        }
    }
?>