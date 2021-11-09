<?php
    class File {
        private $id;
        private $category;
        private $filename;
        private $creator;
        private $timestamp;
        private $filesize;
        private $diskpath;

        public function __construct($id, $category, $diskpath, $filename, $creator, $timestamp, $filesize) {
            $this->id = $id;
            $this->category = $category;
            $this->diskpath = $diskpath;
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

        public function getDiskpath() {
            return $this->diskpath;
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