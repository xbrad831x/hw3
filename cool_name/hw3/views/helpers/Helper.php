<?php
use cool_name\hw3\models\Model;
use hw3\configs\Configs;
require_once("../models/Model.php");
require_once("../configs/configs.php");

class Helper {
/*namespace cool_name\hw3\helpers;*/
	private $column_names = [];
	protected $model;
    protected $configs;

	public function __construct() {
        $this->configs = new Configs();
        $this->column_names = $this->configs->genre_table_columns;
        array_shift($this->column_names);
    }
    
    public function generate_landing_genre ($selected_genre) {
        if ( empty($_SESSION['genre_filter']) || $_SESSION['genre_filter'] == "All Genres") {
            echo "<option value='All Genres' selected>All Genres</option>";
            foreach($this->column_names as $index=>$names) {
                echo '<option value="'.$names.'">'.$names.'</option>';
            }
        } else {
            echo "<option value='All Genres'>All Genres</option>";
            foreach($this->column_names as $index=>$names) {
                if ($selected_genre == $names) {
                    echo '<option value="'.$names.'" selected>'.$names.'</option>';
                } else {
                    echo '<option value="'.$names.'">'.$names.'</option>';
                }
            }
        } 
    }
    
    public function generate_genre_dropdown($selected_genres) {
        foreach($this->column_names as $index=>$names) {
            if ( sizeof($selected_genres)==sizeof($this->column_names) && $selected_genres[$index] == 1) {
                echo '<option value="'.$names.'" selected>'.$names.'</option>';
            }else {
                echo '<option value="'.$names.'">'.$names.'</option>';
            }
        }
	}
    
    public function render_list($results) {
        if ( $results==null) {
            return;
        }
        if (mysqli_num_rows($results) < 1 ) {
            return;
        }
        echo '<ol>';
        while( $row = mysqli_fetch_assoc($results) ) {
            echo ( 
                '<li>
                    <a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'
                        .$row["Title"].'
                    </a>
                </li>'
            );
        }
        echo '</ol>';
    }
    
    public function render_story($text) {
        $formatted = preg_split('/\r\n\r\n/', $text);
        foreach ($formatted as $line) {
            echo "<p>$line</p>";
        }
        
    }
    
}
?>