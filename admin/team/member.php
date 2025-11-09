<?php
    class Member {
        public $name;
        public $title;
        public $background;

        public function __construct($newName, $newTitle, $newBG){
            $this->name = $newName;
            $this->title = $newTitle;
            $this->background = $newBG;
        }

        public function returnAsArray() {
            return [
                'name' => $this->name,
                'title' => $this->title,
                'background' => $this->background
            ];
        }
    }
?>