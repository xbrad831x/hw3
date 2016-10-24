<?php
require_once("../models/Model.php");
class Controller {
/*namespace cool_name\hw3\controllers;*/
	private $title;
	private $author;
	private $identifier;
	private $genre;
	private $text;
	protected $model;

	public function __construct() {
        $this->title = $_POST['title'];
        $this->author = $_POST['author'];
        $this->identifier = $_POST['identifier'];
        foreach($_POST['genre'] as $genre)
        {$this->genre[] = $genre;}
        $this->text = $_POST['writing'];
        $this->model = new Model();  
    }	

	public function put_in_db() {
		$this->model->db_connect();
		$this->model->sql_insert_story($this->identifier, $this->title, $this->author, $this->genre, $this->text);
		header("Location: ../views/Landing.php");
	}
}

$controller = new Controller();
$controller->put_in_db();
?>