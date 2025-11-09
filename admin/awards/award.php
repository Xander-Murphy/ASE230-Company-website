<?php
    class Award {
        public $year;
        public $title;
        public $detail;

        public function __construct($newYear, $newTitle, $newDetail){
            $this->year = $newYear;
            $this->title = $newTitle;
            $this->detail = $newDetail;
        }

        public function returnAsArray(){
            $array = [$this->year, $this->title, $this->detail];
            return $array;
        }
    }

?>
