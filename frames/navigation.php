<?php
    require_once('./frames/menuitem.php');
    class Navigation {
        private $mainMenuItems;
        private $userIsLoggedIn = false;

        public function __construct($dbresult) {
            $this->mainMenuItems = array();
            $this->parseItemList($dbresult);
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])) $this->userIsLoggedIn = true;
        }

        private function parseItemList($dbresult) {
            foreach($dbresult as $element) {
                $requiresLogin = false;
                if($element['parent'] == 0) {
                    if($element['requiresLogin'] == 1) $requiresLogin = true;
                    $item = new MenuItem($element['id'], $element['target'], $element['value'], $requiresLogin, true);
                    array_push($this->mainMenuItems, $item);
                } else {
                    $this->checkChild($this->mainMenuItems, $element);
                }
            }
        }

        public function checkChild($haystack, $needle) {
            foreach($haystack as $listentry) {
                $requiresLogin = false;
                if($listentry->getID() == $needle['parent']) {
                    if($needle['requiresLogin'] == 1) $requiresLogin = true;
                    $item = new MenuItem($needle['id'], $needle['target'], $needle['value'], $requiresLogin, false);
                    $listentry->addChild($item);
                }
                else $this->checkChild($listentry->getChildren(), $needle);
            }
        }

        public function getMainNavigation() {
            $build = '<nav>';
            foreach($this->mainMenuItems as $mainMenuItem) {
                if(!$mainMenuItem->requiresLogin()) {
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

        public function getFooterNavigation() {
            $build = '<footer>';
            foreach($this->mainMenuItems as $mainMenuItem) {
                if(!$mainMenuItem->requiresLogin()) {
                    $build .= '<div><span>';
                    $build .= $mainMenuItem->getValue();
                    $build .= '</span>';
                    if(sizeof($mainMenuItem->getChildren()) != 0) {
                        foreach($mainMenuItem->getChildren() as $child) {
                            $build .= '<a href="';
                            $build .= $child->getTarget();
                            $build .= '">';
                            $build .= $child->getValue();
                            $build .= '</a>';
                        }
                    }
                    $build .= '</div>';
                } elseif ($this->userIsLoggedIn) {
                    $build .= '<div><span>';
                    $build .= $mainMenuItem->getValue();
                    $build .= '</span>';
                    if(sizeof($mainMenuItem->getChildren()) != 0) {
                        foreach($mainMenuItem->getChildren() as $child) {
                            $build .= '<a href="';
                            $build .= $child->getTarget();
                            $build .= '">';
                            $build .= $child->getValue();
                            $build .= '</a>';
                        }
                    }
                    $build .= '</div>';
                }
            }
            $build .= '</footer>';
            return $build;
        }

        public function getMainMenuItems() {
            return $this->mainMenuItems;
        }
    }
?>