<?php

class Story extends Model {
    
    public $title;
	public $author;
	public $identifier;
	public $genre;
	public $text;
    
    public function __constructor($t,$a,$i,$g,$txt) {
        $this->$title = $t;
        $this->$author = $a;
        $this->$identifier = $i;
        $this->$genre = $g;
        $this->$text = $txt;
    }
}