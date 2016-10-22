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

	public function sql_insert_story() {


	}

}
?>