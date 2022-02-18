<?php
    class File {
        private $id;
        private $filename;
        private $filesize;
        private $category;
        private $creator;

        public function __construct($id, $filename, $filesize, $creator, $category) {
            $this->id = $id;
            $this->filename = $filename;
            $this->filesize = $filesize;
            $this->category = $category;
            $this->creator = $creator;
        }

        public function getID() {
            return $this->id;
        }

        public function getFilename() {
            return $this->filename;
        }

        public function getCreatorID() {
            return $this->creator;
        }

        public function getCategory() {
            return $this->category;
        }
    }
?>