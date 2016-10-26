<?php

require_once("../configs/configs.php");
//require_once("./Controller.php");
include("../models/Story.php");

class PostController {
    
    private $con;
    
    public function __construct() {
        
        $configs = new Configs();
        $this->con = mysqli_connect(
            $configs->host,
            $configs->username,
            $configs->password,
            $configs->db_name
        );
        mysqli_select_db($this->con, $configs->db_name);
        
    }
    
    public function checkID ($id) {
        $results = mysqli_query($this->con,
            "SELECT * FROM story WHERE identifier='$id';"
        );
        $num_rows = mysqli_num_rows($results);
        if ($num_rows == 1) {
            return true;
        }
        return false;
    }
    
    public function updateStory ($t, $a, $id, $g, $w) {
        echo "Updating";
        echo $id;
        mysqli_query($this->con, "UPDATE story SET Title='$t',Author='$a',Text='$w' WHERE Identifier='$id';");
        mysqli_query($this->con, "UPDATE genre2 SET Animal=0, Funny=0, Cute=0, Crime=0, Fiction=0, Conspiracy=0 WHERE Identifier='$id';");
        foreach ($g as $genre) {
            mysqli_query($this->con, "UPDATE genre2 SET $genre=1 WHERE Identifier='$id';");
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
            ')");
        
        mysqli_query($this->con,
             "INSERT INTO genre2 ( Identifier, Animal, Funny, Cute, Crime, Fiction, Conspiracy) 
            VALUES ('$id', 0,0,0,0,0,0);");
        foreach ($g as $genre) {
            mysqli_query($this->con, "UPDATE genre2 SET $genre=1 WHERE Identifier='$id';");
        }
        
        mysqli_query($this->con, "INSERT INTO ratings (Identifier, Title, Num_Of_Ratings, Sum_of_Ratings) VALUES ('$id', '$t',0, 0);");
    }
    
    public function getStory ($id) {
         
        $genre_results = mysqli_query($this->con, "SELECT * FROM genre2 WHERE Identifier='$id';");
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
        
        $story = new Story(
            $row['Title'], 
            $row['Author'], 
            $row['Identifier'], 
            $genre,
            $row['Text']
        );
        //$story->print_details();
        
        return $story;
    }
    

}

/*
$postController = new PostController();
$url = $_SERVER['REQUEST_URI'];
$url = substr($url,0,24);
$url = $url."/views/write_something.php";
header("Location: ".$url);
echo $url;
*/