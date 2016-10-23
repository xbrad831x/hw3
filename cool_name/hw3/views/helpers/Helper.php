<?php
require_once("../models/Model.php");

class Helper {
/*namespace cool_name\hw3\helpers;*/
	private $columnNames = [];
	protected $model;

	public function __construct() {
	        $this->model = new Model();   
    }

	public function populate_genre_dropdown() {
		$this->model->db_connect();
		$result = $this->model->sql_query("SELECT * FROM genre");
		while($column = $this->model->fetch_column_names($result)) {
			$this->columnNames[] = $column->name;
		}
	}

	public function generate_genre_dropdown() {
		if(is_array($this->columnNames)) {
			foreach($this->columnNames as $names) { 
				echo '<option value="'.$names.'">'.$names.'</option>';
			}
		}
	}

}
?>