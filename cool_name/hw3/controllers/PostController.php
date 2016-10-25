<?php

require_once("../configs/configs.php");
//require_once("./Controller.php");
include("../models/Story.php");

class PostController {
    
    private $con;
    
    public function __constructor() {
        
        $configs = new Configs();
        $this->con = mysqli_connect(
            $configs->host,
            $configs->username,
            $configs->password,
            $configs->db_name
        );
        
    }
    
    public function saveStory ($story) {
        
    }
    
    public function getStory ($id) {
        $con = mysqli_connect('localhost','root','');
		mysqli_select_db($con, 'story');
        $results = mysqli_query($con, "SELECT * FROM story WHERE Identifier='$id';");
        $row = mysqli_fetch_assoc($results);

        $story = new Story(
            $row['Title'], 
            $row['Author'], 
            $row['Identifier'], 
            [],
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