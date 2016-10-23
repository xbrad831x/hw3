<?php
require_once("../models/Model.php");

class Helper {
/*namespace cool_name\hw3\helpers;*/
	private $columnNames = [];
	protected $model;

	public function __construct()
	    {
	        $this->model = new Model();   
	    }


	public function populate_genre_dropdown() {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT * FROM genre");
		while($column = $this->model->fetch_column_names($result))
		{
			$this->columnNames[] = $column->name;
		}


	}

	public function generate_genre_dropdown() {
		if(is_array($this->columnNames))
		{
			foreach($this->columnNames as $names)
			{ 
				echo '<option value="'.$names.'">'.$names.'</option>';
			
			}
		}
	}

	public function generate_top_views() {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Title, Identifier FROM story ORDER BY Views DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}

	}

	public function generate_top_rated() {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Identifier, Title FROM ratings ORDER BY Sum_Of_Ratings / Num_Of_Ratings DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}
	}

	public function generate_newest() {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Identifier, Title FROM story ORDER BY Date DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}
	}
	
	public function generate_top_viewed_filtered_Text($text) {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Title, Identifier FROM story WHERE Title LIKE '%$text%' ORDER BY Views DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}
	}

	public function generate_top_rated_filtered_Text($text) {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Title, Identifier FROM ratings WHERE Title LIKE '%$text%' ORDER BY Sum_Of_Ratings / Num_Of_Ratings DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}
	}

	public function generate_newest_filtered_Text($text) {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT Title, Identifier FROM story WHERE Title LIKE '%$text%' ORDER BY Date DESC LIMIT 10");
		while($row = mysqli_fetch_assoc($result))
			{
				echo '<li><a href="read_a_story.php?title='.$row["Title"].'&identifier='.$row["Identifier"].'">'.$row["Title"].'</a></li>';
			}

}
?>