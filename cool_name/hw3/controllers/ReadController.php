<?php

require_once("../configs/configs.php");
require_once("../controllers/Controller.php");
require_once("../models/Story.php");

class ReadController extends Controller{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function set_rating($id, $rate) {
        $id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $rate = filter_var($rate, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        mysqli_query($this->con, 
             "UPDATE ratings 
             SET Num_Of_Ratings = Num_Of_Ratings+1, Sum_Of_Ratings = Sum_Of_Ratings+'$rate'
             WHERE Identifier='$id'"
        );
    }
    
    public function increment_view ($id) {
        mysqli_query($this->con, "UPDATE story SET Views=Views+1 WHERE Identifier='$id'");
        
    }
    
    public function get_title() {
        return $this->story->title;
    }
    
    public function get_author() {
        return $this->story->author;
    }
    
    public function get_date() {
        return $this->story->my_date;
    }
    
    public function get_rating() {
        if ($this->story->num_of_ratings == 0) {
            return 0;
        }
        return $this->story->sum_of_ratings/$this->story->num_of_ratings;
    }
    
    public function get_text() {
        return $this->story->text;
    }
    
}