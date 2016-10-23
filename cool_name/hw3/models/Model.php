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
		foreach($genres as $genre)
		{
			mysqli_query($this->con, "INSERT INTO genre ($genre) VALUES ('$identifier')");
		}
		mysqli_query($this->con,"INSERT INTO ratings (Identifier, Title) VALUES ('$identifier', '$title')");
	}

	public function get_author($identifier) {
		$result = mysqli_query($this->con, "SELECT * FROM story WHERE Identifier='$identifier'");
		$row = mysqli_fetch_assoc($result);
		return $row["Author"];
	}

	public function get_date($identifier) {
		$result = mysqli_query($this->con, "SELECT * FROM story WHERE Identifier='$identifier'");
		$row = mysqli_fetch_assoc($result);
		return $row["Date"];
	}

	public function get_text($identifier) {
		$result = mysqli_query($this->con, "SELECT * FROM story WHERE Identifier='$identifier'");
		$row = mysqli_fetch_assoc($result);
		return $row["Text"];

	}

	public function inc_view($identifier) {
		mysqli_query($this->con, "UPDATE story SET Views = Views+1 WHERE Identifier='$identifier'");
	}

	public function set_ratings($identifier, $rating) {
		mysqli_query($this->con, "UPDATE ratings SET Num_Of_Ratings = Num_Of_Ratings+1 WHERE Identifier='$identifier'");
		mysqli_query($this->con, "UPDATE ratings SET Sum_Of_Ratings = Sum_Of_Ratings+'$rating' WHERE Identifier='$identifier'");
	}

	public function get_average_ratings($identifier) {
		$result = mysqli_query($this->con, "SELECT * FROM ratings WHERE Identifier='$identifier' ");
		$row = mysqli_fetch_assoc($result);
		if($row["Num_Of_Ratings"] !=0)
			{
				return $row["Sum_Of_Ratings"] / $row["Num_Of_Ratings"];
			}
		else
			{
				return 0;
			}
	}

}
?>