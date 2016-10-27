<?php
namespace cool_name\hw3\controllers;
use hw3\configs\Configs;
use cool_name\hw3\models\Story;
require_once("../models/Model.php");
require_once("../configs/configs.php");
require_once("../models/Story.php");

class Controller {
/*namespace cool_name\hw3\controllers;*/
    
    protected $configs;
	protected $con;
	protected $story;

	public function __construct() {
        $this->configs = new Configs();
        $this->con = mysqli_connect(
            $this->configs->host,
            $this->configs->username,
            $this->configs->password,
            $this->configs->db_name
        );
        mysqli_select_db($this->con, $this->configs->db_name);
    }
    
    public function checkForErrors($t, $a, $id, $g, $w) {
        echo "Title: ".$t.".";
        if ($t == "") {
            echo "<h1>Error, Enter a Valid Title</h1>";
            return false;
        }
        if ($a == "") {
            echo "<h1>Error, Enter a Valid Author</h1>";
            return false;
        }
        if ($id == "") {
            echo "<h1>Error, Invalid ID</h1>";
            return false;
        }
        if ($g == [0,0,0,0,0,0]) {
            echo "<h1>Error, Select a Genre</h1>";
            return false;
        }
        if ($w == "") {
            echo "<h1>Error, Enter a Valid Story</h1>";
            return false;
        }
        return true;
    }
    
    public function updateStory ($t, $a, $id, $g, $w) {
        $t = filter_var($t, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $a = filter_var($a, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $w = filter_var($w, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $valid = $this->checkForErrors($t, $a, $id, $g, $w);
        if (!$valid) {
            return false;
        }
        
        mysqli_query($this->con, 
             "UPDATE story 
             SET 
                Title='$t',
                Author='$a',
                Text='$w' 
            WHERE 
                Identifier='$id';"
        );
        mysqli_query($this->con, 
             "UPDATE genre 
             SET 
                Animal=0, 
                Funny=0, 
                Cute=0, 
                Crime=0, 
                Fiction=0, 
                Conspiracy=0 
             WHERE Identifier='$id';"
        );
        foreach ($g as $genre) {
            mysqli_query($this->con, 
                 "UPDATE genre 
                 SET $genre=1 
                 WHERE Identifier='$id';"
            );
        }
        return $valid;
    }
    
    public function saveStory ($t, $a, $id, $g, $w) { 
        $t = filter_var($t, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $a = filter_var($a, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $w = filter_var($w, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $valid = $this->checkForErrors($t, $a, $id, $g, $w);
        if (!$valid) {
            return false;
        }
        
        $my_date = date("Y-m-d H:i:s");
        
        mysqli_query($this->con,
             "INSERT INTO story (
                Identifier, 
                Title, 
                Author, 
                Text, 
                Date) 
            VALUES (
                '$id',
                '$t',
                '$a',
                '$w',
                '$my_date
            ')"
        );
        mysqli_query($this->con,
             "INSERT INTO genre ( 
                Identifier, 
                Animal, 
                Funny, 
                Cute, 
                Crime, 
                Fiction, 
                Conspiracy) 
             VALUES ('$id', 0,0,0,0,0,0);"
        );
        foreach ($g as $genre) {
            mysqli_query($this->con, 
                 "UPDATE genre 
                 SET $genre=1 
                 WHERE Identifier='$id';"
            );
        }
        mysqli_query($this->con, 
             "INSERT INTO ratings (
                Identifier, 
                Title, 
                Num_Of_Ratings, 
                Sum_of_Ratings) 
            VALUES ('$id', '$t', 0, 0);"
        );
        return $valid;
    }
    
    public function getStory ($id) {
        $id = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        if ($id == "") {
            echo "<h1>Error Invalid ID</h1>";
        }
        
        $genre_results = mysqli_query($this->con, "SELECT * FROM genre WHERE Identifier='$id';");
        $genre_row = mysqli_fetch_assoc($genre_results);
        $genre = [
            $genre_row['Animal'], 
            $genre_row['Funny'], 
            $genre_row['Cute'], 
            $genre_row['Crime'], 
            $genre_row['Fiction'], 
            $genre_row['Conspiracy'] 
        ];

        $results = mysqli_query($this->con, "SELECT * FROM story WHERE Identifier='$id';");
        $row = mysqli_fetch_assoc($results);
        $num_rows = mysqli_num_rows($results);
        if ($num_rows != 1) {
            echo "<h1>Error Invalid ID</h1>";
        }
        
        $this->story = new Story(
            $row['Title'], 
            $row['Author'], 
            $row['Identifier'], 
            $genre,
            $row['Text']
        );
        $this->story->my_date = $row['Date'];
        
        $results = mysqli_query($this->con, "SELECT * FROM ratings WHERE Identifier='$id';");
        $row = mysqli_fetch_assoc($results);
        $this->story->num_of_ratings = $row['Num_Of_Ratings'];
        $this->story->sum_of_ratings = $row['Sum_Of_Ratings'];
        
        return $this->story;
    }
}