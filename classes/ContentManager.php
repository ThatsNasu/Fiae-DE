<?php
    class ContentManager {
        private $url;

        public function __construct() {
            if(empty($_GET['url'])) {
                $this->url[0] = "Home";
            } else {
                $this->url = explode("/", $_GET['url']);
            }
        }

        public function loadContent() {
            if(file_exists('pages/'.$this->url[0].'.php')) {
                require_once('pages/'.$this->url[0].'.php');
            } elseif(file_exists('pages/'.$this->url[0].'.html')) {
                require_once('pages/'.$this->url[0].'.html');
            } else {
                require_once('pages/404.html');
            }
        }
    }
?>