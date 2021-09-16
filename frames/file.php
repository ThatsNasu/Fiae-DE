<?php
    class File {
        private $id;
        private $catergory;
        private $subcategory;
        private $filename;
        private $creator;
        private $timestamp;
        private $filesize;

        public function __construct($id, $category, $subcategory, $filename, $creator, $timestamp, $filesize) {
            $this->id = $id;
            $this->category = $category;
            $this->subcategory = $subcategory;
            $this->filename = $filename;
            $this->creator = $creator;
            $this->timestamp = $timestamp;
            $this->filesize = $filesize;
        }

        public function getID() {
            return $this->id;
        }

        public function getCategory() {
            return $this->category;
        }

        public function getSubCategory() {
            return $this->subcategory;
        }

        public function getFileName() {
            return $this->filename;
        }

        public function getCreator() {
            return $this->creator;
        }

        public function getTimestamp() {
            return $this->timestamp;
        }

        public function getFilesize() {
            return $this->filesize;
        }
    }
?>