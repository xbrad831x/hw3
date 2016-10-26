<?php
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
    
    public function updateStory ($t, $a, $id, $g, $w) { 
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
    }
    
    public function saveStory ($t, $a, $id, $g, $w) {           
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
    }
    
    public function getStory ($id) {  
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