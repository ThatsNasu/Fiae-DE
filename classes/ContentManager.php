<?php
    class ContentManager {
        private $url;

        public function __construct() {
            if(!isset($_GET['url']) && !empty($_GET['url'])) $this->url = "/";
            else $this->url = explode("/", $_GET['url']);
            var_dump($this->url);
        }

        public function loadContent() {
            return "qwer";
        }
    }
?>