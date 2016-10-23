<?php

require_once("../configs/configs.php");
//require_once("./Controller.php");
require_once("../models/Story.php");

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
        $story = new Story (
            "Some Title",
            "Some Author",
            "Some ID",
            null,
            "Some Writing"
        );
        
        return $story;
    }
    
}

$postController = new PostController();
$url = $_SERVER['REQUEST_URI'];
$url = substr($url,0,24);
$url = $url."/views/write_something.php";
header("Location: ".$url);
echo $url;

if ( isset($_POST['identifier']) ) {
    $story = $postController->getStory($_POST['identifier']);
    
    header($url);
    $_POST['title'] = $story->title;
    $_POST['author'] = $story->author;
    $_POST['identifier'] = $story->identifier;
    $_POST['genre'] = $story->genre;
    $_POST['writing'] = $story->text;
    
} elseif ( isset($_POST['title']) && 
     isset($_POST['author']) && 
     isset($_POST['identifier']) &&
     isset($_POST['genre']) &&
     isset($_POST['writing']) ) {
    
    $new_story = new Story(
        $_POST['title'],
        $_POST['author'],
        $_POST['identifer'],
        $_POST['genre'],
        $_POST['writing']
    );
    
    $postController->saveStory($story);

} else {
    header("Location: ".$url);
    echo "<h2>Error, please fill out all forms.</h2>";
}
