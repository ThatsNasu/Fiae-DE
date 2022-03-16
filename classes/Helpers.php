<?php
    class Helpers {

        public static function getCategoryByID($categoryID, $categories) {
            foreach($categories as $category) if($category->getID() == $categoryID) return $category;
        }
      
        public static function getFullPathByCategory($category, $categories) {
            if($category->getParent() != 0) {
                foreach($categories as $cat) if($cat->getID() == $category->getParent()) return Helpers::getFullPathByCategory($cat, $categories).$category->getTarget();
            } else {
                return $category->getTarget();
            }
        }

        public static function getFullPathByCategoryID($categoryID, $categories) {
            foreach($categories as $category) if($category->getID() == $categoryID) return Helpers::getFullPathByCategory($category, $categories);
        }

        public static function isLoggedIn() {
            if(isset($_SESSION['user']) && $_SESSION['user']->getUUID()) return true;
            return false;
        }

        public static function getUrl() {
            if(!empty($_GET['url'])) {
                return explode('/', $_GET['url']);
            }
            return array();
        }

        public static function loadScript($path) {
            return '<script src="/'.$path.'" type="text/javascript"></script>';
        }
    }
?>