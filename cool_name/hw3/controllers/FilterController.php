<?php
require_once("../configs/configs.php");
require_once("../controllers/Controller.php");
require_once("../models/Story.php");

class FilterController extends Controller{
    
    public function __construct() {
        parent::__construct();
    }

    public function get_views() {
        $results = mysqli_query($this->con, 
            "SELECT 
                Title, 
                Identifier 
            FROM story 
            ORDER BY Views 
            DESC LIMIT 10;"
        );
        if ($results=="") {
            return null;
        }
        return $results;
        //render_list($results);
    }

	public function get_rated() {
		$results = mysqli_query($this->con, 
            "SELECT 
                Identifier, 
                Title 
            FROM ratings
            ORDER BY Sum_Of_Ratings/Num_Of_Ratings 
            DESC LIMIT 10;"
        );
        if ($results=="") {
            return null;
        }
        return $results;
        //render_list($results);
	}

	public function get_newest() {
		$results = mysqli_query($this->con, 
             "SELECT 
                story.Identifier, 
                story.Title 
            FROM story 
            ORDER BY Date 
            DESC LIMIT 10;"
        );
        if ($results=="") {
            return null;
        }
        return $results;
        //render_list($results);
	}
	
	public function get_filtered_views($text, $genre) {
        $text = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $genre = filter_var($genre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $filter = "";
        if ($text != "" && $genre != "") {
            $filter = "story.Title LIKE '%$text%' AND
                genre.$genre = 1";
        } elseif ($text != "" && $genre == "") {
            $filter = "story.Title LIKE '%$text%'";
        } else {
            $filter = "genre.$genre = 1";
        }
        
		$results = mysqli_query($this->con, 
            "SELECT 
                story.Title, 
                story.Identifier 
            FROM 
                story, 
                genre 
            WHERE 
                $filter AND 
                genre.Identifier = story.Identifier
            GROUP BY Identifier
            ORDER BY Views 
            DESC LIMIT 10;");
        if ($results=="") {
            return null;
        }
        return $results;
		//render_list($results);
	}
    
    public function get_filtered_rated($text, $genre) {
        $text = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $genre = filter_var($genre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $filter = "";
        if ($text != "" && $genre != "") {
            $filter = "story.Title LIKE '%$text%' AND
                genre.$genre = 1";
        } elseif ($text != "" && $genre == "") {
            $filter = "story.Title LIKE '%$text%'";
        } else {
            $filter = "genre.$genre = 1";
        }
        
		$results = mysqli_query($this->con, 
            "SELECT 
                story.Title, 
                story.Identifier 
            FROM 
                story, 
                genre, 
                ratings 
            WHERE 
                $filter AND 
                genre.Identifier = story.Identifier 
                        AND 
                ratings.Identifier = story.Identifier 
                        AND 
                genre.Identifier = ratings.Identifier 
            GROUP BY Identifier 
            ORDER BY Sum_Of_Ratings / Num_Of_Ratings 
            DESC LIMIT 10");
        if ($results=="") {
            return null;
        }
        return $results;
		//render_list($results);
	}
    
	public function get_filtered_newest($text, $genre) {
        $text = filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        $genre = filter_var($genre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        
        $filter = "";
        if ($text != "" && $genre != "") {
            $filter = "story.Title LIKE '%$text%' AND
                genre.$genre = 1";
        } elseif ($text != "" && $genre == "") {
            $filter = "story.Title LIKE '%$text%'";
        } else {
            $filter = "genre.$genre = 1";
        }
        
		$results = mysqli_query($this->con, 
            "SELECT 
                story.Title, 
                story.Identifier 
            FROM 
                story, 
                genre 
            WHERE 
                $filter AND 
                genre.Identifier = story.Identifier
            GROUP BY Identifier
            ORDER BY Date
            DESC LIMIT 10;");
        if ($results=="") {
            return null;
        }
        return $results;
		//render_list($results);
	}
}