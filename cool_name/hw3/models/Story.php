<?php
require_once("../models/Model.php");

class Story extends Model {
    
    public $title;
	public $author;
	public $identifier;
	public $genre;
	public $text;
    public $my_date;
    public $num_of_ratings;
    public $sum_of_ratings;
    
    public function __construct($t,$a,$i,$g,$txt) {
        $this->title = $t;
        $this->author = $a;
        $this->identifier = $i;
        $this->genre = $g;
        $this->text = $txt;
    }
    
    public function print_details () {
        echo "<h2>Story</h2>";
        echo "<h2>$this->title</h2>";
        echo "<h2>$this->author</h2>";
        echo "<h2>$this->identifier</h2>";
        echo "<h2>$this->text</h2>";
        
        $this->print_genre();
    }
    
    private function print_genre() {
        foreach ($this->genre as $g) {
            echo "<p>$g<p>";
        }
    }
}