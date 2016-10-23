<?php
class Model {
/*namespace cool_name\hw3\models;*/
	
	private $con;

	public function db_connect() {
		$this->con = mysqli_connect('localhost','root','');
		mysqli_select_db($this->con, 'story');
	}

	public function sql_query($query) {
		return mysqli_query($this->con,$query);
	}

	public function fetch_column_names($result) {
		return mysqli_fetch_field($result);
	}

	public function sql_insert_story($identifier, $title, $author, $genres, $text) {
		$my_date = date("Y-m-d H:i:s");
		mysqli_query($this->con,"INSERT INTO story (Identifier, Title, Author, Text, Date) VALUES ('$identifier','$title','$author','$text','$my_date')");
		foreach($genres as $genre)    {
			mysqli_query($this->con, "INSERT INTO genre ($genre) VALUES ('$identifier')");
		}
	}

}
?>